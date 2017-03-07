<?php
session_start();
if(isset($_POST['nameFile'])){
    rename($_SESSION["dir_home"]."\\".$_POST['nameFile'],$_SESSION["dir_home"]."\\".$_POST['newName']);
    echo "1";
}
