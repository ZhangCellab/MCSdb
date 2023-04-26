<?php
header('content-type:text/html;charset=utf-8');
//require_once("config.php");

if(isset($_GET['browserSpe']) ){
    $browserSpe = $_GET['browserSpe'];
    $browserSpe = trim($browserSpe);
}
if(isset($_GET['browserMethod']) ){
    $browserMethod = $_GET['browserMethod'];
    $browserMethod = trim($browserMethod);
}

//var_dump($browserSpe);
//var_dump($browserMethod);


function file_get_contents_utf8($fn) {
     $content = file_get_contents($fn, TRUE);
      return mb_convert_encoding($content, 'UTF-8');
}

$file = "./mysql_file/mcs_baseinfo.txt";
if(!file_exists( $file )){
    var_dump("No file!");
    return false;//判断文件是否存在
}else{
//    var_dump("存在文件！！");
//    var_dump($type);

    $bSpecies="";
    switch ($browserSpe) {

            case "1":
                $bSpecies = "Arabidopsis thaliana";
                break;

            case "2":
               $bSpecies = "Human";
               break;

            case "3":
               $bSpecies = "Mouse";
               break;

            case "4":
               $bSpecies = "Rat";
               break;

            case "5":
               $bSpecies = "Yeast";
               break;

    }

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

    if($browserSpe=="all" & $browserSpe=="all"){

        $final_res = $final;

    }elseif($browserSpe=="all" & $browserSpe!="all"){


    }elseif($browserSpe!="all" & $browserSpe=="all"){


    }else{
        $final_res = array_filter($final, array(new speciesFilter($bSpecies), 'isContainlty') ); // 非精确匹配，大小写不敏感
        $final_res = array_values($final_res);

        $final_res = array_filter($final_res, array(new methodFilter($browserMethod), 'isContainlty') ); // 非精确匹配，大小写不敏感
        $final_res = array_values($final_res);
    }


    $json = json_encode($final_res, JSON_UNESCAPED_UNICODE);      //将得到的数据转换成json格式
    echo ('{"data":'.$json.'}'); //转换的json要以这种格式输出，才能被前台读取，不能直接输出,否则将报错，数据不能再表格中显示
}


?>