<?php
header('content-type:text/html;charset=utf-8');
include_once("ini_smarty.php");
//require_once("config.php");

if(isset($_GET['searchType_msc']) ){
    $searchType = $_GET['searchType_msc'];
    $searchType = trim($searchType);
}

//var_dump($searchType);
//var_dump($keyWord);
//var_dump($inputType);
//var_dump($species);
//var_dump($method);

switch ($searchType) {
   case "exact_search":
//        var_dump("exact_search");

        if(isset($_GET['Keyword']) ){
            $keyWord = $_GET['Keyword'];
            $keyWord = trim($keyWord);
        }
        if(isset($_GET['exact_search_type']) ){
            $inputType = $_GET['exact_search_type'];
            $inputType = trim($inputType);
        }
        if(isset($_GET['exact_search_species']) ){
            $species = $_GET['exact_search_species'];
            $species = trim($species);
        }
        if(isset($_GET['exact_search_method']) ){
            $method = $_GET['exact_search_method'];
            $method = trim($method);
        }

        $smarty->assign('searchType', $searchType);
        $smarty->assign('keyWord', $keyWord);
        $smarty->assign('inputType', $inputType);
        $smarty->assign('species', $species);
        $smarty->assign('method', $method);
        $smarty->display("exact_search_res.html");

        break;

   case "batch_search":
//       var_dump("batch_search");

       if(isset($_GET['targetinput']) ){
            $keyWord = $_GET['targetinput'];
            $keyWord = trim($keyWord);
       }
       if(isset($_GET['inputType']) ){
           $inputType = $_GET['inputType'];
           $inputType = trim($inputType);
       }
       if(isset($_GET['batch_search_species']) ){
           $species = $_GET['batch_search_species'];
           $species = trim($species);
       }
       if(isset($_GET['batch_search_method']) ){
           $method = $_GET['batch_search_method'];
           $method = trim($method);
       }

       $key_arr = explode("\n", $keyWord);
       $keyWord = implode("_", $key_arr);

//       var_dump($keyWord);
//       var_dump($inputType);
//       var_dump($species);
//       var_dump($method);

       $smarty->assign('searchType', $searchType);
       $smarty->assign('keyWord', trim($keyWord));
       $smarty->assign('species', $species);
       $smarty->assign('method', $method);
       $smarty->assign('inputType', $inputType);
       $smarty->display("batch_search_res.html");
//       $smarty->display("test.html");

       break;

    case "quick_search":
        if(isset($_GET['Keyword']) ){
            $keyWord = $_GET['Keyword'];
            $keyWord = trim($keyWord);
        }
        $inputType="Protein symbol";
        $species="All";
        $method="All";

        $smarty->assign('searchType', $searchType);
        $smarty->assign('keyWord', $keyWord);
        $smarty->assign('inputType', $inputType);
        $smarty->assign('species', $species);
        $smarty->assign('method', $method);
        $smarty->display("exact_search_res.html");

       break;

   }

?>