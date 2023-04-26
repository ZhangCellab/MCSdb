<?php
header('content-type:text/html;charset=utf-8');
//require_once("config.php");

if(isset($_GET['res_flag']) ){
    $res_flag = $_GET['res_flag'];
    $res_flag = trim($res_flag);
}
if(isset($_GET['res_file']) ){
    $res_file = $_GET['res_file'];
    $res_file = trim($res_file);
}

$res_file = "../tmp/uploads/".$res_file;
//var_dump($res_file);
$final_res = array();

if($res_flag != "success"){
    $final_res = array();
}else{

    // 读取blast后的结果
    function file_get_contents_utf8($fn) {
         $content = file_get_contents($fn, TRUE);
          return mb_convert_encoding($content, 'UTF-8');
    }

    if(!file_exists( $res_file )){
        $final_res = array();
    }else{

        $content = file_get_contents_utf8($res_file);

        if(trim($content)==""){
            $final_res = array();
        }else{
            $rows = explode("\n", trim($content));
//            array_shift($rows);  # 此处blast结果没有表头，因此不需要shift第一行

            //var_dump($rows);

            $res_table = array();
            foreach($rows as $key){
                if(!$key) continue;
                else{
                    $col = explode("\t", $key);
                    $res_table[] = $col;
                }
            }
//            var_dump($res_table);
//            var_dump(sizeof($res_table));

            if(sizeof($res_table)==0){
                $final_res = array();
            }else{
                $info_blast = array_column($res_table, 1);
                $start_blast = array_column($res_table, 8);
                $end_blast = array_column($res_table, 9);
                $score_blast = array_column($res_table, 11);
//                var_dump($score_blast);
//              var_dump($info_blast);

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
                  $v = array_slice($v, 0, 9);
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

                $blast_index_tmp = 0;
                foreach($info_blast as $row){
                    $arr_tmp = explode('_', $row);
                    $id_tmp = $arr_tmp[0];
//                    var_dump($id_tmp);

                    $res_tmp = array_filter($final, array(new containFilter($id_tmp), 'isContainlty') ); // 非精确匹配，大小写不敏感
                    $res_tmp = array_values($res_tmp);
//                    var_dump($res_tmp);

                    if(sizeof($res_tmp)>0){
                        $array_score = array("bitscore"=>$score_blast[$blast_index_tmp]);
                        $res_tmp_score = array_merge($res_tmp[0], $array_score);

                        $array_score = array("start"=>$start_blast[$blast_index_tmp]);
                        $res_tmp_score = array_merge($res_tmp_score, $array_score);

                        $array_score = array("end"=>$end_blast[$blast_index_tmp]);
                        $res_tmp_score = array_merge($res_tmp_score, $array_score);
    //                    var_dump($res_tmp_score);

                        array_push($final_res, $res_tmp_score);
                    }

                    $blast_index_tmp = $blast_index_tmp + 1;

                }
//                var_dump($final_res);
            }
        }

    }

}
    $json = json_encode($final_res, JSON_UNESCAPED_UNICODE);      //将得到的数据转换成json格式
    echo ('{"data":'.$json.'}'); //转换的json要以这种格式输出，才能被前台读取，不能直接输出,否则将报错，数据不能再表格中显示



?>