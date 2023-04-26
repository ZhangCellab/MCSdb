<?php
header('content-type:text/html;charset=utf-8');
include_once("ini_smarty.php");
//require_once("config.php");

if(isset($_GET['searchType_msc']) ){
    $searchType = $_GET['searchType_msc'];
    $searchType = trim($searchType);
}

if(isset($_GET['queryFasta']) ){
    $queryFasta = $_GET['queryFasta'];
    $queryFasta = trim($queryFasta);
}

// 把用户输入的蛋白序列写入到文件中
$blast_search_path="../tmp/uploads/";
$user_file=md5(uniqid(microtime(true),true));
$fw1 = fopen($blast_search_path.$user_file."_input.fasta", "w");

$arr_query=explode("\n", $queryFasta);

foreach ($arr_query as $i){
   fwrite($fw1, $i."\n");
}
fclose($fw1);

//makeblastdb -in /data_home/web/mcsdb/php_mysql/seqDB/sequence_MCSID.fa -dbtype prot
$command = "/home/lty/ncbi-blast-2.13.0+/bin/blastp "."-query ".$blast_search_path.$user_file."_input.fasta"." -out ".$blast_search_path.$user_file."_out.txt"." -db /data_home/web/mcsdb/php_mysql/seqDB/sequence_MCSID.fa -outfmt 6 2>&1";
exec($command, $out, $status);

//var_dump($out);
//var_dump($status);
$res_flag = "";
$content_error = "";
$resArr = array();

if($status>0){

//    var_dump("Error");
//    var_dump("Error: ".implode(" ", $out));

    $res_flag = "error";
    $content_error = implode(" ", $out);

}else{

    // 删除输入文件，读取blast结果文件
    //if(file_exists($blast_search_path.$user_file."_input.fasta")){
    //	unlink($blast_search_path.$user_file."_input.fasta");
    //}

    function file_get_contents_utf8($fn) {
         $content = file_get_contents($fn, TRUE);
          return mb_convert_encoding($content, 'UTF-8');
    }

    if(!file_exists( $blast_search_path.$user_file."_out.txt" )){
        $res_flag = "no_result";
    }

    $content = file_get_contents_utf8($blast_search_path.$user_file."_out.txt");

    if(trim($content)==""){
        $res_flag = "no result";
    }else{
        $rows = explode("\n", trim($content));
//        array_shift($rows);

        //var_dump($rows);

        $res_table = array();
        foreach($rows as $key){
            if(!$key) continue;
            else{
                if(trim($key)!=""){
                    $col = explode("\t", $key);
                    $res_table[] = $col;
                }
            }
        }
//        var_dump($res_table);
//        var_dump(sizeof($res_table));

        if(sizeof($res_table)==0){
            $res_flag = "no result";
        }else{
            $res_flag = "success";
            $info_blast = array_column($res_table, 1);
        //  var_dump($info_blast);

        //  读入MCS基本信息
        //  var_dump("存在文件！！");
        //  var_dump($type);
            $file = "./mysql_file/mcs_baseinfo.txt";
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


            foreach($info_blast as $row){
                $arr_tmp = explode('_', $row);
                $id_tmp = $arr_tmp[0];
                //var_dump($arr_tmp);
                //var_dump($id_tmp);

                $res_tmp = array_filter($final, array(new containFilter($id_tmp), 'isContainlty') ); // 非精确匹配，大小写不敏感
                $res_tmp = array_values($res_tmp);
                if(sizeof($res_tmp)>0){
                        array_push($resArr, $res_tmp[0]);
                }
                //var_dump($res_tmp);

            }
//            var_dump($resArr);
        }
    }

}

$res_file = "";
$res_file = $user_file."_out.txt";
//
//var_dump($res_flag);
//var_dump($res_file);

$smarty->assign('res_flag', $res_flag);
$smarty->assign('res_file', $res_file);
$smarty->display("blast_search_res.html");

//// 传输结果至前端
//$jsonUrl = '{"txtUrl":"./tmp/uploads/'. $user_folder .'/res.txt","pdfUrl":"./tmp/uploads/'. $user_folder .'/res.pdf"'. ', "report_content":"'. $report_content. '", "table_res":"'.$user_folder.'"}';
//
//
////var_dump($jsonUrl);
//echo ('{"resultURL":'.$jsonUrl.'}'); //转换的json要以这种格式输出，才能被前台读取，不能直接输出,否则将报错，数据不能再表格中显示


//exec("whoami 2>&1", $output, $status);
//var_dump($output);
//var_dump($status);



//var_dump($searchType);
//var_dump($keyWord);
//var_dump($inputType);
//var_dump($species);
//var_dump($method);



?>