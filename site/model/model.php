<?php
/**
 * Created By PhpStorm
 * User: Benoit.PIERREHUMBERT
 * Date: 10.02.2020
 * Time: 14:24
 */
function getUsers()
{
    return json_decode(file_get_contents("model/dataStorage/users.json"),true);
}

function getChilds()
{
    $_SESSION['childs']=json_decode(file_get_contents("model/dataStorage/images.json"),true);
    return  $_SESSION['childs'];
}
function getBackup()
{
    return json_decode(file_get_contents("model/dataStorage/backup.json"),true);
}
function getMedia()
{
    return json_decode(file_get_contents("model/dataStorage/media.json"),true);
}

function putBackup($backup)
{
    file_put_contents('model/dataStorage/backup.json', json_encode($backup));
}
function getLog()
{
    return json_decode(file_get_contents("model/dataStorage/log.json"),true);
}

function putLog($log)
{
    file_put_contents('model/dataStorage/log.json', json_encode($log));
}
function putSave($save)
{
    file_put_contents('model/dataStorage/images.json', json_encode($save));
}
function putUpload($upload)
{
    file_put_contents('model/dataStorage/upload_temp.json', json_encode($upload));
}
function putMedia($upload)
{
    file_put_contents('model/dataStorage/media.json', json_encode($upload));
}

?>