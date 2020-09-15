<?php
/**
 * Created By PhpStorm
 * User: benoit.pierrehumbert  and simon.cuany
 * Date: 04.02.2020
 * Time: 15:57
 */
session_start();
require "controler.php";
if (isset($_GET['action'])){
    $action=$_GET['action'];
}
//Set var for save -----------------------------------------
if (isset($_POST['image'])){
    $image=$_POST['image'];
}
if (isset($_GET['size'])){
    $size=$_GET['size'];
}
if (isset($_GET['name'])){
    $name=$_GET['name'];
}
if (isset($_GET['id'])){
    $id=$_GET['id'];
}

if (isset($action)) {
    switch ($action) {
        case 'home';
            home();
            break;
        case 'upload';
            upload();
            break;
        case 'redmi3size';
            redmi3size($name);
            break;
        default:
            home();
            break;
    }
}else{
    home();
}
?>