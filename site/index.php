<?php
/**
 * Created By PhpStorm
 * User: benoit.pierrehumbert  and simon.cuany
 * Date: 04.02.2020
 * Time: 15:57
 */
session_start();
require "controler/controler.php";
$errors=null;
$url =null;
if (isset($_GET['action'])){
    $action=$_GET['action'];
}
//--------------------------------------------


if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
    $url = "https://";
else
    $url = "http://";
// Append the host(domain name, ip) to the URL.
$url.= $_SERVER['HTTP_HOST'];

// Append the requested resource location to the URL
$url.= $_SERVER['REQUEST_URI'];


if (strpos($url, 'forum') !== false) {
    forum();
}
if (strpos($url, 'boutique') !== false) {
    boutique();
}

//------------------------------------------
if (isset($_GET['IDimage'])){
    $IDimage=$_GET['IDimage'];
}
if (isset($_GET['welcome'])){
    $welcome=$_GET['welcome'];
}else {
    $welcome='';
}
if (isset($_GET['errors'])){
    $errors=$_GET['errors'];
}
if (!isset($_SESSION['fail'])){
    $_SESSION['fail']=true;
}
//Set var for save -----------------------------------------
if (isset($_POST['meridien'])){
    $meridien=$_POST['meridien'];
}
if (isset($_POST['latitude'])){
    $latitude=$_POST['latitude'];
}
if (isset($_POST['longitude'])){
    $longitude=$_POST['longitude'];
}
if (isset($_POST['idplace'])){
    $idplace=$_POST['idplace'];
}
if (isset($_POST['idimage'])){
    $idimage=$_POST['idimage'];
}
if (isset($_POST['team'])){
    $team=$_POST['team'];
}
if (isset($_POST['Droit'])){
    $Droit=$_POST['Droit'];
}
if (isset($_POST['Slogan'])){
    $Slogan=$_POST['Slogan'];
}
if (isset($_POST['Pseudo'])){
    $Pseudo=$_POST['Pseudo'];
}
if (isset($_POST['Pays'])){
    $Pays=$_POST['Pays'];
}
if (isset($_POST['Ville'])){
    $Ville=$_POST['Ville'];
}
if (isset($_POST['Media'])){
    $Media=$_POST['Media'];
}
if (isset($_POST['Titre'])){
    $Titre=$_POST['Titre'];
}
if (isset($_POST['ecole'])){
    $ecole=$_POST['ecole'];
}
if (isset($_POST['Anneeprod'])){
    $Anneeprod=$_POST['Anneeprod'];
}
if (isset($_POST['desc'])){
    $desc=$_POST['desc'];
}
if (isset($_POST['newtitle'])){
    if ($_POST['newtitle']!='') {
        $_SESSION['newtitle'] = $_POST['newtitle'];
    }else{
        $_SESSION['newtitle']=null;
    }
}
//END set var for save -----------------------------------------
if (isset($action)) {
    switch ($action) {
        case 'home';
            home();
            break;
        case 'OTHER';
            OTHER();
            break;
         case 'credits';
            credits();
            break;
        case 'editchild';
            editchild($IDimage);
            break;
        case 'save';
            save($IDimage, $meridien, $latitude, $longitude, $idplace, $team, $Droit, $Slogan, $Pseudo, $Pays, $Ville, $Media, $Anneeprod, $desc, $Titre,$ecole);
            break;
        case 'showchilds';
            showchilds($welcome);
            break;
        case 'showBackup';
            showBackup();
            break;
        case 'showLog';
            showLog();
            break;
        case 'showchildsSearch';
            showchildsSearch();
            break;
        case 'GetData';
            GetData();
            break;
        case 'tryLogin';
            tryLogin();
            break;
        case 'disconnect';
            disconnect();
            break;
        case 'testhashed';
            testhashed();
            break;
        case 'easteregg';
            easteregg();
            break;
        case 'uploadfile';
            uploadfile($IDimage);
            break;
        case 'uploadimg';//marche pas en ligne
            uploadimg($IDimage);
            break;
        case 'uploadmedia';
            uploadmedia($IDimage,$errors);
            break;
        case 'uploadimage';
            uploadimage($IDimage);
            break;
        case 'forum';
            forum();
            break;
        case 'boutique';
            boutique();
            break;
        default:
            homepage();
            break;
    }
}else{
    homepage();
}
?>