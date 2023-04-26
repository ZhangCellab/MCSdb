<?php
header('content-type:text/html;charset=utf-8');
include_once("ini_smarty.php");

if(isset($_GET['id']) ){
    $dataIndex = $_GET['id'];
}

function file_get_contents_utf8($fn) {
     $content = file_get_contents($fn, TRUE);
      return mb_convert_encoding($content, 'UTF-8');
}

function foo(&$v, $k, $kname) {
  $v = array_combine($kname, $v);
//      $v = array_slice($v, 0, 9);
}


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

$res_tmp = array_filter($complex_file_info, array(new containFilter_complex($dataIndex), 'isContainlty') ); // 非精确匹配，大小写不敏感
$res_tmp = array_values($res_tmp);

//var_dump($res_tmp);

$smarty->assign('ID', $res_tmp[0]["complexID"]);
$smarty->assign('species', $res_tmp[0]["species"]);
$smarty->assign('MCS', $res_tmp[0]["MCS"]);
$smarty->assign('subunitNumber', $res_tmp[0]["subunitNumber"]);
$smarty->assign('complex', $res_tmp[0]["complex"]);
$smarty->assign('complex_info', $res_tmp);

$smarty->display("detailComplex.html");

?>