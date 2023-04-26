<?php
header('content-type:text/html;charset=utf-8');
include_once("ini_smarty.php");
require_once("config.php");

$type = $_GET['b_type'];

switch ($type) {
   case "bro_formula":
        $smarty->assign('b_type', $type);
        $smarty->display("browser_formula.html");

        break;

   case "bro_ingredient":
       $smarty->assign('b_type', $type);
       $smarty->display("browser_ingredient.html");

       break;
   case "bro_herb":
       $smarty->assign('b_type', $type);
       $smarty->display("browser_herb.html");

       break;
   }



?>