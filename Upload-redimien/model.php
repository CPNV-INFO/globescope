<?php
/**
 * Created By PhpStorm
 * User: Benoit.PIERREHUMBERT
 * Date: 10.02.2020
 * Time: 14:24
 */
function getUploads()
{
    return json_decode(file_get_contents("uploads/uploads.json"),true);
}


function putUploads($uploads)
{
    file_put_contents('uploads/uploads.json', json_encode($uploads));
}

?>