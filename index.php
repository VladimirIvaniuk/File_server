<?php
$dir_home="file_download";
if(!is_dir("$dir_home")){
    mkdir("$dir_home");
}
session_start();
$_SESSION["dir_home"]=$dir_home;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/Mystyle.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/animation.css">
    <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="functions.js"></script>
    <title>File Data</title>
</head>
<body>
<div class="row">
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div><a href="" class="navbar-brand">My_Files</a></div>
            </div>
            <form>
                <div class="collapse navbar-collapse" id="navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#" role="button" id="openFolder">Открыть</a></li>
                        <li><a href="#modal_upload" data-toggle="modal" id="upload">Загрузить<span class="sr-only"></span></a></li>
                        <li><a id="rename" href="#" data-toggle="modal" data-target="#renameModal">Переименовать<span class="sr-only"></span></a></li>
                        <li><a href="#">Удалить<span class="sr-only"></span></a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown">Дополнительно<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#" role="button" data-toggle="modal" data-target="#createFolder">Создать папку</a></li>
                                <li><a href="load.php">Скачать</a></li>
                                <li><a href="#" role="button">Переместить</a></li>
                                <li><a href="#">О программе</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </form>
        </div>
    </nav>
</div>

<!--Загрузить файл-->

<div id="modal_upload" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" action="upload.php">
            <!-- Заголовок модального окна -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Загрузите файл</h4>
                </div>
                <!-- Основное содержимое модального окна -->
                <div class="modal-body">

                        <input type="file" name="filename" size="10">

                </div>
                <!-- Футер модального окна -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <input class="btn" type="submit" value="Сохранить">
<!--                    <button type="button" class="btn btn-primary">Сохранить изменения</button>-->
                </div>
            </form>
        </div>
    </div>
</div>

<!--Переименовать файл-->
<div id="renameModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data">
                <!-- Заголовок модального окна -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Переименуйте файл</h4>
                </div>
                <!-- Основное содержимое модального окна -->
                <div class="modal-body">

                    <input type="text" name="newName" class="form-control">

                </div>
                <!-- Футер модального окна -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <button class="btn btn-primary" id="btnRename">Переименовать</button>
                    <!--                    <button type="button" class="btn btn-primary">Сохранить изменения</button>-->
                </div>
            </form>
        </div>

    </div>
</div>

<!--Создать папку-->

<div id="createFolder" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="Create_new_dir.php">
                <!-- Заголовок модального окна -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h1 class="modal-title" style="font-weight: bold">Создать папку</h1>
                </div>
                <!-- Основное содержимое модального окна -->
                <div class="modal-body">
                    <label>Введите название папки</label>
                    <input type="text" name="dir_new" class="form-control">
                </div>
                <!-- Футер модального окна -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <input class="btn" type="submit" value="Сохранить">
                </div>
            </form>
        </div>
    </div>
</div>

    <!-- Основной контент страницы -->
<div class="container" id="content">
    <div class="container">
        <div class="row">

            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Имя</th>
                    <th>Размер</th>
                    <th class="hidden-xs">Дата изменения</th>
                </tr>
                </thead>
                <tbody>
                <?php
                chdir($_SESSION["dir_home"]);
//                echo getcwd();
//                echo "<pre>";
//                print_r(scandir("."));
//                echo "</pre>";
                $i=0;

                foreach(scandir(".") as $item){
                    if($item!="."&& $item!=".."){$i++?>
                        <tr>
                            <td><?=$i;?></td>
                            <td class="<?php echo (is_file($item)?'icon_file':'icon_dir')?> search"><span><?=$item;?></span></td>
                            <td><?=filesize($item);?></td>
                            <td class="hidden-xs"><?=date("d/m/y H:i:s",filemtime($item));?></td>
                        </tr>
                    <?php }}?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Футер -->
<footer class="navbar navbar-inverse navbar-fixed-bottom">
    <div>
        <p class="page-header navbar-fixed-bottom">
            <button class="btn btn-sm btn-primary" id="btnBack">	&lt; Назад</button>
            <?php

            if(!isset($_SESSION["dir_home"])){
                $_SESSION["prev_dir"]="";
                $_SESSION["dir_home"]=getcwd()."\\file_download";
            }
            $string = str_replace("E:\\XAMPP01\\htdocs\\File_server\\file_download","Мой диск", $_SESSION["dir_home"]);
            echo str_replace("\\", " &gt; ",$string );
            ?>
        </p>
    </div>
</footer>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>
