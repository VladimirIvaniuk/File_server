<?php
session_start();
if(!empty($_FILES)){
    if(isset($_FILES["filename"])){
        if($_FILES['filename']['error']==UPLOAD_ERR_OK){
            $fname=$_FILES['filename']['name'];
            $src=$_FILES['filename']['tmp_name'];
            $upl_dir=$_SESSION["dir_home"]."\\$fname";
            move_uploaded_file($src,$upl_dir);
        }
    }
}
header("Location:index.php");