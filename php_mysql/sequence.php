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
//      var_dump(array_slice($v, 0, 1));
//      $v = array_slice($v, 0, 9);
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

$res_tmp = array_filter($seq_info, array(new containFilter_seq($dataIndex), 'isContainlty') ); // 非精确匹配，大小写不敏感
$res_tmp = array_values($res_tmp);

$smarty->assign('myUniID',$dataIndex);
$smarty->assign('sequence',$res_tmp);
$smarty->display('sequence.html');


?>