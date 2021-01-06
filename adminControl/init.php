<?php

include 'conect.php';

//routes
$tpl = 'include/templete/'; //templete directory
$css = 'layout/css/';
$js = 'layout/js/';
$ven = 'layout/vendor/';
$font = 'layout/font/';
$fun = 'include/functions/';



//------------------
include $tpl . "header.inc.php";
include $fun . "fun.php";

//to include in all pages navabar Except log & create
if (!isset($nonavbar)) {
    include $tpl . "navbar.php";
}
?>