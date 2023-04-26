<?php
header('content-type:text/html;charset=utf-8');
//require_once("config.php");

if(isset($_GET['searchType']) ){
    $searchType = $_GET['searchType'];
    $searchType = trim($searchType);
}
if(isset($_GET['keyWord']) ){
    $keyWord = $_GET['keyWord'];
    $keyWord = trim($keyWord);
}
if(isset($_GET['inputType']) ){
    $inputType = $_GET['inputType'];
    $inputType = trim($inputType);
}
if(isset($_GET['species']) ){
    $species = $_GET['species'];
    $species = trim($species);
}
if(isset($_GET['method']) ){
    $method = $_GET['method'];
    $method = trim($method);
}

//var_dump($searchType);
//var_dump($keyWord);
//var_dump($inputType);
//var_dump($species);
//var_dump($method);

$key_arr = explode("_", $keyWord);
//var_dump($key_arr);

function file_get_contents_utf8($fn) {
     $content = file_get_contents($fn, TRUE);
      return mb_convert_encoding($content, 'UTF-8');
}


$file = "./mysql_file/mcs_baseinfo.txt";
if(!file_exists( $file )){
    var_dump("bu存在文件！！");
    return false;//判断文件是否存在
}else{
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
      $v = array_slice($v, 0, 9);
    }

    array_walk($final, 'foo', $kname);

//    var_dump($final);

    class containFilter_gene_ID {
            private $keyword;

            function __construct($keyword) {
                    $this->keyword = $keyword;
            }

            function isContainlty($i) {
                    $tmp1 = stripos($i['gene_ID'], $this->keyword);

                    return !($tmp1 === false);
            }
    }

    class containFilter_gene_symbol {
            private $keyword;

            function __construct($keyword) {
                    $this->keyword = $keyword;
            }

            function isContainlty($i) {
                    $tmp1 = stripos($i['gene_symbol'], $this->keyword);

                    return !($tmp1 === false);
            }
    }

    class containFilter_gene_uniprot {
            private $keyword;

            function __construct($keyword) {
                    $this->keyword = $keyword;
            }

            function isContainlty($i) {
                    $tmp1 = stripos($i['uniprot'], $this->keyword);

                    return !($tmp1 === false);
            }
    }

    class speciesFilter {
            private $keyword;

            function __construct($keyword) {
                    $this->keyword = $keyword;
            }

            function isContainlty($i) {
                    $tmp1 = stripos($i['species'], $this->keyword);

                    return !($tmp1 === false);
            }
    }

    class methodFilter {
            private $keyword;

            function __construct($keyword) {
                    $this->keyword = $keyword;
            }

            function isContainlty($i) {
                    $tmp1 = stripos($i['Experimental_Method'], $this->keyword);

                    return !($tmp1 === false);
            }
    }

//    var_dump("---------------------------");

    switch ($inputType) {
          case "symbol":

                  $final_res = [];

                  foreach ($key_arr as $a) {
//                        print($a);
                        $final_tmp = $final;
                        $final_tmp_symbol = array_filter($final_tmp, array(new containFilter_gene_symbol(trim($a)), 'isContainlty') ); // 非精确匹配，大小写不敏感
                        $final_tmp_symbol = array_values($final_tmp_symbol);

                        if($species != "All"){
                            $final_tmp_symbol = array_filter($final_tmp_symbol, array(new speciesFilter($species), 'isContainlty') ); // 非精确匹配，大小写不敏感
                            $final_tmp_symbol = array_values($final_tmp_symbol);
                        //        var_dump($final_tmp_symbol);
                        }

                        if($method != "All"){
                            $final_tmp_symbol = array_filter($final_tmp_symbol, array(new methodFilter($method), 'isContainlty') ); // 非精确匹配，大小写不敏感
                            $final_tmp_symbol = array_values($final_tmp_symbol);
                        //        var_dump($final_tmp_symbol);
                        }

//                        var_dump("---------------------------");
//                        var_dump($final_tmp_symbol);

                        $final_res = array_merge($final_res, $final_tmp_symbol);

                  }
//                  var_dump($final_res);

                break;

          case "uid":

                    $final_res = [];

                    foreach ($key_arr as $a) {
//                          print($a);
                          $final_tmp = $final;
                          $final_tmp_symbol = array_filter($final_tmp, array(new containFilter_gene_uniprot(trim($a)), 'isContainlty') ); // 非精确匹配，大小写不敏感
                          $final_tmp_symbol = array_values($final_tmp_symbol);

                          if($species != "All"){
                              $final_tmp_symbol = array_filter($final_tmp_symbol, array(new speciesFilter($species), 'isContainlty') ); // 非精确匹配，大小写不敏感
                              $final_tmp_symbol = array_values($final_tmp_symbol);
                          //        var_dump($final_tmp_symbol);
                          }

                          if($method != "All"){
                              $final_tmp_symbol = array_filter($final_tmp_symbol, array(new methodFilter($method), 'isContainlty') ); // 非精确匹配，大小写不敏感
                              $final_tmp_symbol = array_values($final_tmp_symbol);
                          //        var_dump($final_tmp_symbol);
                          }
//                          var_dump("---------------------------");
//                          var_dump($final_tmp_symbol);

                          $final_res = array_merge($final_res, $final_tmp_symbol);

                    }
//                    var_dump($final_res);

                break;

          case "eid":

                  $final_res = [];
                  foreach ($key_arr as $a) {
//                        print($a);
                        $final_tmp = $final;
                        $final_tmp_symbol = array_filter($final_tmp, array(new containFilter_gene_ID(trim($a)), 'isContainlty') ); // 非精确匹配，大小写不敏感
                        $final_tmp_symbol = array_values($final_tmp_symbol);

                          if($species != "All"){
                              $final_tmp_symbol = array_filter($final_tmp_symbol, array(new speciesFilter($species), 'isContainlty') ); // 非精确匹配，大小写不敏感
                              $final_tmp_symbol = array_values($final_tmp_symbol);
                          //        var_dump($final_tmp_symbol);
                          }

                          if($method != "All"){
                              $final_tmp_symbol = array_filter($final_tmp_symbol, array(new methodFilter($method), 'isContainlty') ); // 非精确匹配，大小写不敏感
                              $final_tmp_symbol = array_values($final_tmp_symbol);
                          //        var_dump($final_tmp_symbol);
                          }
//                          var_dump("---------------------------");
//                          var_dump($final_tmp_symbol);
                        $final_res = array_merge($final_res, $final_tmp_symbol);

                  }
//                  var_dump($final_res);

                break;

    }

    $json = json_encode($final_res, JSON_UNESCAPED_UNICODE);      //将得到的数据转换成json格式
    echo ('{"data":'.$json.'}'); //转换的json要以这种格式输出，才能被前台读取，不能直接输出,否则将报错，数据不能再表格中显示
}


?>