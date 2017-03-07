<?php
/**
 * Created by PhpStorm.
 * User: ivanu
 * Date: 31.01.2017
 * Time: 22:59
 */
session_start();
mkdir($_SESSION["dir_home"]."\\".$_POST['dir_new']);
header("Location:index.php");