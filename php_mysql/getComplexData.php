<?php
header('content-type:text/html;charset=utf-8');
include_once("ini_smarty.php");

if(isset($_GET['id']) ){
    $searchType = $_GET['searchType'];
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

//var_dump($complex_file_info);

$json = json_encode($complex_file_info, JSON_UNESCAPED_UNICODE);      //将得到的数据转换成json格式
echo ('{"data":'.$json.'}'); //转换的json要以这种格式输出，才能被前台读取，不能直接输出,否则将报错，数据不能再表格中显示

?>