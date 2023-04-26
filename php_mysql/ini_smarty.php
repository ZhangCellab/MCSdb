<?php
header('content-type:text/html;charset=utf-8');
/**
file ini_smarty.php smarty对象的实例化及初始化文件
*/
//1.使用绝对路径加载smarty类文件
//define("ROOT",str_replace("\\","/",dirname(_FILE_)).'/')
//require  ROOT.'libs/Smarty.class.php';

//1.使用相对路径加载smarty类文件
include_once("../smarty/Smarty.class.php");
//实例化smarty
$smarty = new Smarty();

//模板文件存放目录
$smarty->template_dir = "../templates/";
//编译过的模板文件存放目录
$smarty->compile_dir = "../templates_c/";
//模板配置文件存放目录
//$smarty->config_dir = '/web/www.mydomain.com/smarty/guestbook/configs/';
//缓存文件存放目录
//$smarty->cache_dir = '/web/www.mydomain.com/smarty/guestbook/cache/';
//模板语言中左右结束符
$smarty->left_delimiter = '<{';
$smarty->right_delimiter = '}>';

?>