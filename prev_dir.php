<?php
/**
 * Created by PhpStorm.
 * User: ivanu
 * Date: 01.02.2017
 * Time: 0:43
 */
session_start();
if($_SESSION['dir_home']!="E:\\XAMPP01\\htdocs\\File_server\\file_download") {
    $re = '/(.*)\\\\/';
    preg_match($re, $_SESSION['dir_home'], $matches);
    $_SESSION["dir_home"]=$matches[1];
    echo "true";
}
else{
    echo "false";
}