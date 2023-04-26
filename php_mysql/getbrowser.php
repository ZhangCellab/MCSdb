<?php
header('content-type:text/html;charset=utf-8');
include_once("ini_smarty.php");
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

$smarty->assign('browserSpe', $browserSpe);
$smarty->assign('browserMethod', $browserMethod);
$smarty->display("browseResult.html");

?>