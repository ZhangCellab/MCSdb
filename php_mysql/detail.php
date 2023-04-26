<?php
header('content-type:text/html;charset=utf-8');
include_once("ini_smarty.php");
require_once("config.php");

if(isset($_GET['id']) ){
    $dataIndex = $_GET['id'];
}

$file = "./mysql_file/mcs_baseinfo.txt";

if(!file_exists( $file )){

    var_dump("No file！！");
    return false;//判断文件是否存在

}else{

    function file_get_contents_utf8($fn) {
         $content = file_get_contents($fn, TRUE);
          return mb_convert_encoding($content, 'UTF-8');
    }

//    var_dump("存在文件！！");
//    var_dump($type);
    $content = file_get_contents_utf8($file);
    $rows = explode("\r\n", $content);
    array_shift($rows);

    foreach($rows as $key){
        if(!$key) continue;
        else{
            $col = explode("\t", $key);
            $final[] = $col;
        }
    }
//    var_dump($final);
//    echo gettype($final);

    $kname = array('MCS_ID', 'gene_ID', 'gene_symbol', 'uniprot', 'species', 'MCS', 'location', 'cell_line_tissue', 'Experimental_Method', 'complex', 'complex_ID', 'PMID', 'Description');

    function foo(&$v, $k, $kname) {
      $v = array_combine($kname, $v);
//      var_dump(array_slice($v, 0, 1));
//      $v = array_slice($v, 0, 9);
    }

    array_walk($final, 'foo', $kname);

//    var_dump($final);
    class containFilter {
            private $keyword;

            function __construct($keyword) {
                    $this->keyword = $keyword;
            }

            function isContainlty($i) {
                    $tmp1 = stripos($i['MCS_ID'], $this->keyword);

                    return !($tmp1 === false);
            }
    }

    $final_res = array_filter($final, array(new containFilter($dataIndex), 'isContainlty') ); // 非精确匹配，大小写不敏感
    $final_res = array_values($final_res);

//    var_dump($final_res);

    // 读取每个MCS蛋白的与之互作的蛋白信息，也就是complex
    $complex_flag = 0;
    $compond_flag = 0;
    $complex_id_raw = trim($final_res[0]['complex_ID']);
    $all_complex_info = array();
    $all_compond_info = array();

    if($complex_id_raw!="" & $complex_id_raw!="NA"){
        $complex_flag = 1;

        // 读入complex文件
        $content = file_get_contents_utf8("./mysql_file/complex_info.txt");
        $rows = explode("\r\n", $content);
        array_shift($rows);

        foreach($rows as $key){
            if(!$key) continue;
            else{
                $col = explode("\t", $key);
                $complex_file_info[] = $col;
            }
        }
//        var_dump($complex_file_info);
    //    echo gettype($complex_file_info);

        $kname = array('complexID', 'complex', 'subunitNumber', 'species', 'MCS', 'PMID', 'description', 'p_subunites', 'c_subunites');

        array_walk($complex_file_info, 'foo', $kname);

        class containFilter_complex {
                private $keyword;

                function __construct($keyword) {
                        $this->keyword = $keyword;
                }

                function isContainlty($i) {
                        $tmp1 = stripos($i['complexID'], $this->keyword);

                        return !($tmp1 === false);
                }
        }

        $complex_id_arr = explode("/", $complex_id_raw);
//        var_dump($complex_id_arr);

        foreach($complex_id_arr as $id){

            $id = trim($id);
//            var_dump($id);

            $res_tmp = array_filter($complex_file_info, array(new containFilter_complex($id), 'isContainlty') ); // 非精确匹配，大小写不敏感
            $res_tmp = array_values($res_tmp);
//            var_dump($res_tmp);
            array_push($all_complex_info, $res_tmp[0]);

        }

//        var_dump($all_complex_info);

//        $interactome_info = array();
//        foreach($all_complex_info as $tmp_p){
//            if(trim($tmp_p['p_subunites']) !=""){
////                var_dump(explode("|", trim($tmp_p['p_subunites'])));
//            }
//        }
//
//        $all_compond_complex = array();
//        foreach($all_complex_info as $tmp_p){
//            if(trim($tmp_p['c_subunites']) !=""){
//                array_push($all_compond_complex, explode("|", trim($tmp_p['c_subunites'])));
//            }
//        }
//
//        $echart_node_p = implode("|", array_filter(array_column($all_complex_info, 'p_subunites')));
//        $echart_node_c = implode("|", array_filter(array_column($all_complex_info, 'c_subunites')));
//        var_dump($echart_node_p);
//        var_dump($echart_node_c);
    }

    // reference的文献支持
    // var_dump(trim($final_res[0]['PMID']));
    // var_dump(trim($final_res[0]['Description']));

    $pmid_flag = 0;
    $doi_flag = 0;

    // 识别是否是doi号
    $pattern = '/^https:\/\/doi.org/';//需要转义/
    preg_match($pattern, trim($final_res[0]['PMID']), $match);

    if(sizeof($match)>0){
        $all_pmid_info = array(trim($final_res[0]['PMID'])=>trim($final_res[0]['Description']));

        $smarty->assign('doi_id', trim($final_res[0]['PMID']));
        $smarty->assign('doi_des', trim($final_res[0]['Description']));

        $doi_flag = 1;
        $pmid_flag = 1;

    }else{

        $pmid_arr = explode("/", trim($final_res[0]['PMID']));
    //        var_dump($pmid_arr);

        $description_arr = explode("/", trim($final_res[0]['Description']));
    //        var_dump($description_arr);

        $all_pmid_info = array_combine($pmid_arr, $description_arr);
    //        var_dump($all_pmid_info);

    //        var_dump(sizeof($all_pmid_info));

        if(sizeof($all_pmid_info)>0){
            $pmid_flag = 1;
        }

    }

//    var_dump($all_pmid_info);


    // 读取组织表达数据（human and mouse）
    $species = trim($final_res[0]['species']);
    $tissue_expr_flag = 0;
    $array_tissue=array();

    if($species=="Human"){

        $sql_tissue = "SELECT * FROM hpa_table WHERE Gene_entrez=";
        $gene_ID = trim($final_res[0]['gene_ID']);

        if($gene_ID != "" & $gene_ID != "NA"){
            $sql_tissue_tmp = $sql_tissue."'".$gene_ID."' order by NX DESC;";
            $db->query($sql_tissue_tmp);

            while ($row = $db->fetch_array()) {
                array_push($array_tissue, array('Tissue'=>$row['Tissue'],'NX'=>$row['NX']));
            }
        }else{
            $tissue_expr_flag = 0;
        }

        if(sizeof($array_tissue)>0){
            $array_tissue = json_encode($array_tissue);      //将得到的数据转换成json格式
            $tissue_expr_flag = 1;
        }else{
            $tissue_expr_flag = 0;
        }

    }elseif($species=="Mouse"){

        $sql_tissue = "SELECT * FROM mouse_tissue WHERE Gene_entrez=";
        $gene_ID = trim($final_res[0]['gene_ID']);

        if($gene_ID != "" & $gene_ID != "NA"){
            $sql_tissue_tmp = $sql_tissue."'".$gene_ID."' order by NX DESC;";
            $db->query($sql_tissue_tmp);

            while ($row = $db->fetch_array()) {
                array_push($array_tissue, array('Tissue'=>$row['Tissue'],'NX'=>$row['NX']));
            }
        }else{
            $tissue_expr_flag = 0;
        }

        if(sizeof($array_tissue)>0){
            $array_tissue = json_encode($array_tissue);      //将得到的数据转换成json格式
            $tissue_expr_flag = 1;
        }else{
            $tissue_expr_flag = 0;
        }

    }else{

        $tissue_expr_flag = 0;

    }

//    var_dump($array_tissue);

    // 寻找同源信息
    $content = file_get_contents_utf8("./mysql_file/homology.txt");
    $rows = explode("\r\n", $content);
    array_shift($rows);

    foreach($rows as $key){
        if(!$key) continue;
        else{
            $col = explode("\t", $key);
            $homo_file_info[] = $col;
        }
    }
//        var_dump($complex_file_info);
//    echo gettype($complex_file_info);

    $kname = array('uniprotID', 'eggNOG', 'HOGENOM', 'OrthoDB', 'TreeFam', 'GeneTree');

    array_walk($homo_file_info, 'foo', $kname);

    class containFilter_homo {
            private $keyword;

            function __construct($keyword) {
                    $this->keyword = $keyword;
            }

            function isContainlty($i) {
                    $tmp1 = stripos($i['uniprotID'], $this->keyword);

                    return !($tmp1 === false);
            }
    }

    $homo_flag = 0;
    $myUniID = trim($final_res[0]['uniprot']);
    $res_tmp = array_filter($homo_file_info, array(new containFilter_homo($myUniID), 'isContainlty') ); // 非精确匹配，大小写不敏感
    $res_tmp = array_values($res_tmp);

    function mytrim($str){
       $str_new = trim($str,";");
       return $str_new;
    }

    $homo_info = array_map("mytrim", $res_tmp[0]);

//    var_dump($homo_info);

    if(sizeof($homo_info)>0){
        $homo_flag = 1;
    }


   // uniprot 序列信息
    $content = file_get_contents_utf8("./mysql_file/seq.df.txt");
    $rows = explode("\r\n", $content);
    array_shift($rows);

    foreach($rows as $key){
        if(!$key) continue;
        else{
            $col = explode("\t", $key);
            $seq_info[] = $col;
        }
    }
//        var_dump($complex_file_info);
//    echo gettype($complex_file_info);

    $kname = array('uniprotID', 'seq');

    array_walk($seq_info, 'foo', $kname);

    class containFilter_seq {
            private $keyword;

            function __construct($keyword) {
                    $this->keyword = $keyword;
            }

            function isContainlty($i) {
                    $tmp1 = stripos($i['uniprotID'], $this->keyword);

                    return !($tmp1 === false);
            }
    }

    $seq_flag = 0;
    $myUniID = trim($final_res[0]['uniprot']);
    $res_tmp = array_filter($seq_info, array(new containFilter_seq($myUniID), 'isContainlty') ); // 非精确匹配，大小写不敏感
    $res_tmp = array_values($res_tmp);

    if(sizeof($res_tmp)>0){
        $seq_flag = 1;
    }

}

//var_dump($complex_id_raw);
//var_dump($all_complex_info);
//var_dump($all_compond_info);

$smarty->assign('MCS_id', trim($dataIndex));
$smarty->assign('gene_ID', trim($final_res[0]['gene_ID']));
$smarty->assign('gene_symbol', trim($final_res[0]['gene_symbol']));
$smarty->assign('uniprot', trim($final_res[0]['uniprot']));
$smarty->assign('species', trim($final_res[0]['species']));
$smarty->assign('MCS', trim($final_res[0]['MCS']));
$smarty->assign('location', trim($final_res[0]['location']));
$smarty->assign('species', trim($final_res[0]['species']));
$smarty->assign('cell_line_tissue', trim($final_res[0]['cell_line_tissue']));
$smarty->assign('Experimental_Method', trim($final_res[0]['Experimental_Method']));

$smarty->assign('complex_flag', $complex_flag);
$smarty->assign('compond_flag', $compond_flag);
$smarty->assign('complex_info', $all_complex_info);
$smarty->assign('compond_info', $all_compond_info);

$smarty->assign('all_pmid_info', $all_pmid_info);
$smarty->assign('pmid_flag', $pmid_flag);
$smarty->assign('doi_flag', $doi_flag);

$smarty->assign('tissue_expr_flag', $tissue_expr_flag);
$smarty->assign('array_tissue', $array_tissue);

$smarty->assign('homo_flag', $homo_flag);
$smarty->assign('homo_info', $homo_info);
$smarty->assign('seq_flag', $seq_flag);

$smarty->display("detail.html");


?>