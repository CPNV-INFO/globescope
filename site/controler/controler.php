<?php
/**
 * Created By PhpStorm
 * User: benoit.pierrehumbert and simon.cuany
 * Date: 06.02.2020
 * Time: 10:44
 */
require_once 'model/model.php';

// This file contains nothing but functions
function home()
{
    require_once 'view/home.php';
}

//function for one time task
function OTHER(){
    $childs=getChilds();
    $compteur=0;
    foreach ($childs as $child){
            $save[$compteur] = [
                "IDPlace" => $child["IDPlace"],
                "IDImage" => $child["IDImage"],
                "mer" => $child["mer"],
                "lat" => $child["lat"],
                "lon" => $child["lon"],
                "Pseudo" => $child["Pseudo"],
                "Droit" => $child["Droit"],
                "Slogan" => $child["Slogan"],
                "Team" => "",
                "ImageOK" => $child["ImageOK"],
                "Pays" => $child["Pays"],
                "Ville" => $child["Ville"],
                "Media" => $child["Media"],
                "Titre" => $child["Titre"],
                "Anneeprod" => $child["Anneeprod"],
                "ecole" => $child["ecole"],
                "desc" => $child["desc"]
            ];

        $compteur++;
    }
    //putSave($save);
}

//function for alert text or variables
function alert($text){
    echo "<script>alert('".$text."')</script>";
}

//function for credits
function credits()
{
    require_once 'view/Credits.php';
}

//function for disconnect
function disconnect()
{

    unset($_SESSION['username']);
    $_SESSION['fail'] = true;
    require_once 'view/home.php';
}

//funtcion for test
function testhashed()
{
    $_SESSION['hash'] = $_POST['testhash'];
    require_once 'view/testhash.php';
}

//function for login
function tryLogin()
{
    $users = getUsers();
    $username = $_POST['username'];
    $password = $_POST['password'];
    unset($_SESSION['username']);

    foreach ($users as $user) {
        if (($username == $user['username']) && ($password == password_verify($password, $user['password']))) {
            $_SESSION['username'] = $username;//a röussi
        }
    }
    if (isset($_SESSION['username'])) {//si a reussi
        $_SESSION['fail'] = false;//resusi
        require_once 'view/succeslogin.php';
    } else {
        $_SESSION['fail'] = true;//pas susi
        require_once 'view/home.php';
    }
}

function showchilds($welcome)
{

    if (isset($_SESSION['username']) == true) {
        $childs = getChilds();
        require_once 'view/showchilds.php';
    } else {
        $_SESSION['flashmessage'] = "Pas touche !";
        require 'view/home.php';
    }

}

function showBackup()
{

    if (isset($_SESSION['username']) == true) {
        $childs = getBackup();
        require_once 'view/showbackup.php';
    } else {
        $_SESSION['flashmessage'] = "Pas touche !";
        require 'view/home.php';
    }

}

function showLog()
{

    if (isset($_SESSION['username']) == true) {
        $log = getLog();
        require_once 'view/showlog.php';
    } else {
        $_SESSION['flashmessage'] = "Pas touche !";
        require 'view/home.php';
    }

}

function GetData()
{
    //Get JSON Params

    $obj = json_decode($_POST["x"], false);
    $data = json_decode(file_get_contents('model/dataStorage/images.json'), true); // by default, return everything as an associative array
    $query = "";
    if (isset($_POST['Mode'])) {
        $mode = $_POST["Mode"];

        if ($mode == "search") {
            $pattern = "/{$obj->Pseudo}/i";

            $res = [];
            foreach ($data as $image)
                if (preg_match($pattern, $image['Pseudo'])) { // match
                    $res[] = $image;
                } else if (preg_match($pattern, $image['Slogan'])) {
                    $res[] = $image;
                } else if (preg_match($pattern, $image['Droit'])) {
                    $res[] = $image;
                } else if (preg_match($pattern, $image['Pays'])) {
                    $res[] = $image;
                } else if (preg_match($pattern, $image['Ville'])) {
                    $res[] = $image;
                } else if (preg_match($pattern, $image['Team'])) {
                    $res[] = $image;
                } else if (preg_match($pattern, $image['ecole'])) {
                    $res[] = $image;
                }else if (preg_match($pattern, $image['IDPlace'])){
                    $res[] = $image;
                }
        } else if ($mode == "click") {
            foreach ($data as $key => $image) {
                if ($image['IDPlace'] == $obj->ID) // found it
                {
                    $res = $image;
                    break; // no need to continue
                }
            }
        } else if ($mode == "load") {
            $res = $data;
        } else {
            $res = null;
        }
    }
    echo json_encode($res);

}

function easteregg()
{
    require 'view/easteregg.php';
}

function showchildsSearch()
{

    if (isset($_SESSION['username']) == true) {
        $searchText = "/" . $_POST['searchText'] . "/i";
        $childs = getChilds();
        $compteur = -1;
        foreach ($childs as $child) {
            $compteur++;
            $in = false;
            $inIDImage = false;
            $inIDPlace = false;
            $inmer = false;
            $inlat = false;
            $inlon = false;
            $inPseudo = false;
            $inDroit = false;
            $inSlogan = false;
            $inTeam = false;
            $inPays = false;
            $inVille = false;
            $inEcole = false;

            if ($_POST['searchText'] == $child['mer']) {
                $in = true;
                $inmer = true;
                $sort = "a";
            }
            if ($_POST['searchText'] == $child['lat']) {
                $in = true;
                $inlat = true;
                $sort = "b";
            }
            if ($_POST['searchText'] == $child['lon']) {
                $in = true;
                $inlon = true;
                $sort = "c";
            }
            if ($_POST['searchText'] == $child['IDPlace']) {
                $in = true;
                $inIDPlace = true;
                $sort = "d";
            }
            if ($_POST['searchText'] == $child['IDImage']) {
                $in = true;
                $inIDImage = true;
                $sort = "e";
            }
            if (preg_match($searchText, $child['Pseudo'])) {
                $in = true;
                $inPseudo = true;
                $sort = "f";
            }
            if (preg_match($searchText, $child['Droit'])) {
                $in = true;
                $inDroit = true;
                $sort = "g";
            }
            if (preg_match($searchText, $child['Slogan'])) {
                $in = true;
                $inSlogan = true;
                $sort = "h";
            }
            if (preg_match($searchText, $child['Team'])) {
                $in = true;
                $inTeam = true;
                $sort = "i";
            }
            if (preg_match($searchText, $child['Pays'])) {
                $in = true;
                $inPays = true;
                $sort = "j";
            }
            if (preg_match($searchText, $child['Ville'])) {
                $in = true;
                $inVille = true;
                $sort = "k";
            }
            if (preg_match($searchText, $child['ecole'])) {
                $in = true;
                $inEcole = true;
                $sort = "l";
            }
            if ($in == true) {
                $search[] = ["id" => $compteur,
                    "searchText" => $_POST['searchText'],
                    "IDPlace" => $child['IDPlace'],
                    "inIDPlace" => $inIDPlace,
                    "inIDImage" => $inIDImage,
                    "inmer" => $inmer,
                    "inlat" => $inlat,
                    "inlon" => $inlon,
                    "inPseudo" => $inPseudo,
                    "inDroit" => $inDroit,
                    "inSlogan" => $inSlogan,
                    "inTeam" => $inTeam,
                    "inPays" => $inPays,
                    "inVille" => $inVille,
                    "inEcole" => $inEcole,
                    "sort" => $sort,
                    "IDImage" => $child['IDImage'],
                    "mer" => $child['mer'],
                    "lat" => $child['lat'],
                    "lon" => $child['lon'],
                    "Pseudo" => $child['Pseudo'],
                    "Droit" => $child['Droit'],
                    "Slogan" => $child['Slogan'],
                    "Team" => $child['Team'],
                    "Pays" => $child['Pays'],
                    "Ville" => $child['Ville'],
                    "Media" => $child['Media'],
                    "Titre" => $child['Titre'],
                    "ecole" => $child['ecole'],
                    "Anneeprod" => $child['Anneeprod'],
                    "desc" => $child['Desc']
                ];
            }
        }
        require_once 'view/showchildsSearch.php';
    } else {
        $_SESSION['flashmessage'] = "Pas touche !";
        require 'view/home.php';
    }
}

function editchild($IDimage)
{
    if (isset($_SESSION['username']) == true) {
        $_SESSION['idchild'] = $IDimage;
        $childs = getChilds();
        require_once 'view/editchild.php';
    } else {
        $_SESSION['flashmessage'] = "Pas touche !";
        require 'view/home.php';
    }


}

function backup()
{
    $backup = getBackup();
    $backup[] = [
        "IDPlace" => $_SESSION['valueidplace'],
        "IDImage" => $_SESSION['valueidimage'],
        "mer" => $_SESSION['valuemer'],
        "lat" => $_SESSION['valuelat'],
        "lon" => $_SESSION['valuelon'],
        "Pseudo" => $_SESSION['valuepseudo'],
        "Droit" => $_SESSION['valuedroit'],
        "Slogan" => $_SESSION['valueslogan'],
        "Team" => $_SESSION['valueteam'],
        "ImageOK" => "VRAI",
        "Pays" => $_SESSION['valuespays'],
        "Ville" => $_SESSION['valueville'],
        "Media" => $_SESSION['valuemedia'],
        "Titre" => $_SESSION['valuetitre'],
        "Anneeprod" => $_SESSION['valueanneeprod'],
        "desc" => $_SESSION['valuedesc'],
        "ecole" => $_SESSION['ecole'],
        "date" => strtotime("now")
    ];
    putBackup($backup);
}

function save($IDimage, $meridien, $latitude, $longitude, $idplace, $team, $Droit, $Slogan, $Pseudo, $Pays, $Ville, $Media, $Anneeprod, $desc, $Titre, $ecole)
{
    if (isset($_SESSION['username']) == true) {
        backup();
        $save = getChilds();
        $compteur = 0;
        if ($meridien == null) {
            $meridien = $_SESSION['backupnull']['mer'];
        }
        if ($latitude == null) {
            $latitude = $_SESSION['backupnull']['lat'];
        }
        if ($longitude == null) {
            $longitude = $_SESSION['backupnull']['lon'];
        }
        if ($idplace == null) {
            $idplace = $_SESSION['backupnull']['IDPlace'];
        }
        if ($IDimage == null) {
            $IDimage = $_SESSION['backupnull']['IDImage'];
        }
        foreach ($save as $element) {
            if ($IDimage == $element['IDImage']) {
                $save[$compteur] = [
                    "IDPlace" => $idplace,
                    "IDImage" => $IDimage,
                    "mer" => $meridien,
                    "lat" => $latitude,
                    "lon" => $longitude,
                    "Pseudo" => $Pseudo,
                    "Droit" => $Droit,
                    "Slogan" => $Slogan,
                    "Team" => $team,
                    "ImageOK" => "VRAI",
                    "Pays" => $Pays,
                    "Ville" => $Ville,
                    "Media" => $Media,
                    "Titre" => $Titre,
                    "Anneeprod" => $Anneeprod,
                    "ecole" => $ecole,
                    "desc" => $desc,
                ];
            }
            $compteur++;
        }
        putSave($save);
        $childs = $save;
        echo "<script>alert('Sauvegarde réussie !')</script>";
        require_once 'view/editchild.php';

    } else {
        $_SESSION['flashmessage'] = "Pas touche !";
        require 'view/home.php';
    }
}

function homepage()
{
    require_once 'view/Homepage.php';
}

function boutique()
{
    $_SESSION["indexBoutique"]="us";
    require_once 'boutique/index.php';
}

function forum()
{
    require_once 'forum/index.php';
}

function uploadmedia($IDimage,$errors)
{
    require_once 'view/uploadmedia.php';
}

function uploadimg($IDimage)
{
    require_once 'view/uploadimage.php';
}

function uploadfile($IDimage)
{
    if (isset($_FILES['media'])) {
        $errors = null;
        $file_name = $_FILES['media']['name'];
        $file_size = $_FILES['media']['size'];
        $file_tmp = $_FILES['media']['tmp_name'];
        $file_type = $_FILES['media']['type'];
        $file_ext = strtolower(end(explode('.', $_FILES['media']['name'])));
        $file_title = substr($_FILES['media']['name'], 0, -strlen($file_ext) - 1);

        if ($file_size > 10485760) {
            $errors = 'Le fichier ne doit pas dépasser 10 MB';
        }
        var_dump($_SESSION['valuemedia']);
        unlink($_SESSION['valuemedia']);
        if (empty($errors) == true) {
            $backup = getBackup();//making a backup of média
            $backup[] = [
                "IDPlace" => "-",
                "IDImage" => $IDimage,
                "mer" => "-",
                "lat" => "-",
                "lon" => "-",
                "Pseudo" => "-",
                "Droit" => "-",
                "Slogan" => "-",
                "Team" => "-",
                "ImageOK" => "-",
                "Pays" => "-",
                "Ville" => "-",
                "ecole" => "-",
                "Media" => $_SESSION['valuemedia'],
                "Titre" => $_SESSION['valuetitre'],
                "Anneeprod" => "-",
                "desc" => "-",
                "date" => strtotime("now")
            ];
            putBackup($backup);
            //log
            $log = getLog();
            $log[] = [
                "before" => $_SESSION['valuetitre'],
                "after" => $file_title,
                "what" => "Changing Media upload : $file_name",
                "IDimages" => $IDimage,
                "state" => "Success",
                "date" => strtotime("now")
            ];
            putLog($log);

            $compteur = 0;
            $childs = getChilds();
            $save = $childs;
            foreach ($childs as $child) {
                if ($IDimage == $child['IDImage']) {
                    var_dump($_SESSION['newtitle']);
                    if (isset($_SESSION['newtitle'])) {
                        echo "<script>alert('Le Titre du fichier a été changer avec succès !')</script>";
                        $valuetitle = $_SESSION['newtitle'];
                    } else {
                        $valuetitle = $file_title;
                    }

                    $save[$compteur] = [
                        "IDPlace" => $_SESSION['valueidplace'],
                        "IDImage" => $_SESSION['valueidimage'],
                        "mer" => $_SESSION['valuemer'],
                        "lat" => $_SESSION['valuelat'],
                        "lon" => $_SESSION['valuelon'],
                        "Pseudo" => $_SESSION['valuepseudo'],
                        "Droit" => $_SESSION['valuedroit'],
                        "Slogan" => $_SESSION['valueslogan'],
                        "Team" => $_SESSION['valueteam'],
                        "ImageOK" => "VRAI",
                        "Pays" => $_SESSION['valuespays'],
                        "Ville" => $_SESSION['valueville'],
                        "Media" => "media/" . $IDimage . "." . $file_ext,
                        "Titre" => $valuetitle,
                        "Anneeprod" => $_SESSION['valueanneeprod'],
                        "desc" => $_SESSION['valuedesc'],
                    ];
                }
                $compteur++;
            }
            putSave($save);
            move_uploaded_file($file_tmp, "media/" . $IDimage . "." . $file_ext);
            //write in uploads file
            $uploads = getMedia();
            $uploads[] = [
                "IDimage" => $IDimage,
                "path" => "media/" . $IDimage . "." . $file_ext,
                "ext" => $file_ext];
            putMedia($uploads);
            echo "<script>window.open('index.php?action=editchild&IDimage=".$IDimage."');</script>";
        } else {

            //log
            $log = getLog();
            $log[] = [
                "before" => "-",
                "after" => "-",
                "what" => "Changing Media upload : $file_name",
                "IDimages" => $IDimage,
                "state" => "Fail",
                "date" => strtotime("now")
            ];
            putLog($log);
            uploadmedia($IDimage,$errors);
        }
    }
}//upload for media function

function uploadimage($IDimage)
{
    if (isset($_FILES['image'])) {
        $errors = array();
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $file_ext = strtolower(end(explode('.', $_FILES['image']['name'])));
        $expensions = array("jpeg", "jpg", "png");

        if (in_array($file_ext, $expensions) === false) {
            $errors[] = "Le format n'est pas reconnu, merci de choisir un fichier en .JPEG ou .PNG.";
        }

        if ($file_size > 83886080) {
            $errors[] = 'Le fichier ne doit pas dépasser 8 MB';
        }

        if (empty($errors) == true) {
            $name_dst = $IDimage . "." . $file_ext;
            move_uploaded_file($file_tmp, "model/uploads/temp/" . $file_name);
            rename("model/uploads/temp/" . $file_name, 'model/uploads/temp/' . $name_dst);
            //write in uploads file
            $uploads[0] = [
                "name" => $file_name,
                "size" => $file_size,
                "tmp" => $file_tmp,
                "type" => $file_type,
                "ext" => $file_ext];
            putUpload($uploads);
            redmi3size($file_name, $IDimage, $file_ext);
        } else {
            echo "<script>alert(" . $errors . ")</script>";
            editchild($IDimage);
        }
    }
}//upload img for redim function

function resize_img($image_path, $image_dest, $new_width, $new_height, $size, $qualite)
{
    /** Ce code à été copier du site http://www.frederic-gerard.com/scripts/script-php-pour-redimentionner-une-image-en-conservant-les-proportions.html
     * Il a été adapter pour correspondre a nos besoin.
     *
     * Fonction qui permet de redimensionner une image en conservant les proportions
     * @param string $image_path Chemin de l'image
     * @param string $image_dest Chemin de destination de l'image redimentionnée (si vide remplace l'image envoyée)
     * @param integer $max_size Taille maximale en pixels
     * @param integer $qualite Qualité de l'image entre 0 et 100
     * @param string $type 'auto' => prend le coté le plus grand
     *                             'width' => prend la largeur en référence
     *                             'height' => prend la hauteur en référence
     * @return string              'success' => redimentionnement effectué avec succès
     *                             'wrong_path' => le chemin du fichier est incorrect
     *                             'no_img' => le fichier n'est pas une image
     *                             'resize_error' => le redimensionnement a échoué
     */
    // Vérification que le fichier existe
    if (!file_exists($image_path)):
        $_SESSION['errors_redi'][] = 'Wrong_path';
    endif;

    if ($image_dest == ""):
        $image_dest = $image_path;
    endif;
    // Extensions et mimes autorisés
    $extensions = array('jpg', 'jpeg', 'png', 'gif');
    $mimes = array('image/jpeg', 'image/gif', 'image/png');

    // Récupération de l'extension de l'image
    $tab_ext = explode('.', $image_path);
    $extension = strtolower($tab_ext[count($tab_ext) - 1]);

    // Récupération des informations de l'image
    $image_data = getimagesize($image_path);

    // Si c'est une image envoyé alors son extension est .tmp et on doit d'abord la copier avant de la redimentionner
    if ($extension == 'tmp' && in_array($image_data['mime'], $mimes)):
        copy($image_path, $image_dest);
        $image_path = $image_dest;

        $tab_ext = explode('.', $image_path);
        $extension = strtolower($tab_ext[count($tab_ext) - 1]);
    endif;

    // Test si l'extension est autorisée
    if (in_array($extension, $extensions) && in_array($image_data['mime'], $mimes)):

        // On stocke les dimensions dans des variables
        $img_width = $image_data[0];
        $img_height = $image_data[1];

        //Création de la ressource pour la nouvelle image
        $dest = imagecreatetruecolor($new_width, $new_height);

        // En fonction de l'extension on prépare l'iamge
        switch ($extension) {
            case 'jpg':
            case 'jpeg':
                $src = imagecreatefromjpeg($image_path); // Pour les jpg et jpeg
                break;

            case 'png':
                $src = imagecreatefrompng($image_path); // Pour les png
                break;
        }

        // Création de l'image redimentionnée
        if (imagecopyresampled($dest, $src, 0, 0, 0, 0, $new_width, $new_height, $img_width, $img_height)):
            switch ($size) {
                case 64:
                case 128:
                    $extension_img = "png";
                    break;
                case 400:
                    $extension_img = "jpg";
                    break;
                default:
                    $extension_img = "jpg";
                    break;
            }
            // On remplace l'image en fonction de l'extension
            switch ($extension) {
                case 'jpg':
                    $lengthName = strlen($image_dest);
                    $image_dest = substr_replace($image_dest, '.' . $extension_img, $lengthName - 4);
                    imagejpeg($dest, $image_dest, $qualite); // Pour les jpg
                    break;
                case 'jpeg':
                    $lengthName = strlen($image_dest);
                    $image_dest = substr_replace($image_dest, '.' . $extension_img, $lengthName - 4);
                    imagejpeg($dest, $image_dest, $qualite); // Pour les  jpeg
                    break;

                case 'png':
                    $lengthName = strlen($image_dest);
                    $image_dest = substr_replace($image_dest, '.' . $extension_img, $lengthName - 4);
                    imagepng($dest, $image_dest, $qualite); // Pour les png
                    break;

            }

            return 'success';

        else:
            $_SESSION['errors_redi'][] = 'resize_error';
        endif;

    else:
        $_SESSION['errors_redi'][] = 'no_img';
    endif;
}//fonction de redimensionement

function fct_redim($size, $rep_size, $name_dst, $IDimage)
{
    $rep_Dst = 'images/' . $rep_size . '/';
    $img_Dst = $IDimage . ".png";
    $img_Src = $name_dst;
    $rep_Src = 'model/uploads/temp/';
    $image_path = $rep_Src . $img_Src;
    $image_dest = $rep_Dst . $img_Dst;
    switch ($size) {
        case 64:
            $new_width = 64;
            $new_height = 64;
            break;
        case 128:
            $new_width = 128;
            $new_height = 128;
            break;
        case 400:
            $new_width = 400;
            $new_height = 500;
            break;
        default:
            $new_width = 400;
            $new_height = 500;
            break;
    }//set var $Wmax, $Hmax
    $result = resize_img($image_path, $image_dest, $new_width, $new_height, $size, $qualite = 93);
    //rename ($rep_Dst.$name, $rep_Dst.$name_dst);
    if ($result != 'success') {
        return 'fail';
    } else {
        return 'success';
    }
}//fonction pour le redimensionement 64*64

function fct_redim2($size, $rep_size, $name_dst, $IDimage)
{
    $rep_Dst = 'images/' . $rep_size . '/';
    $img_Dst = $IDimage . ".png";
    $img_Src = $name_dst;
    $rep_Src = 'model/uploads/temp/';
    $image_path = $rep_Src . $img_Src;
    $image_dest = $rep_Dst . $img_Dst;
    switch ($size) {
        case 64:
            $new_width = 64;
            $new_height = 64;
            break;
        case 128:
            $new_width = 128;
            $new_height = 128;
            break;
        case 400:
            $new_width = 400;
            $new_height = 500;
            break;
        default:
            $new_width = 400;
            $new_height = 500;
            break;
    }//set var $Wmax, $Hmax
    $result = resize_img($image_path, $image_dest, $new_width, $new_height, $size, $qualite = 93);
    //rename ($rep_Dst.$name, $rep_Dst.$name_dst);
    if ($result != 'success') {
        return 'fail';
    } else {
        return 'success';
    }
}//fonction pour le redimensionement 128*128

function fct_redim3($size, $rep_size, $name_dst, $IDimage)
{
    $rep_Dst = 'images/' . $rep_size . '/';
    $img_Dst = $IDimage . ".jpg";
    $img_Src = $name_dst;
    $rep_Src = 'model/uploads/temp/';
    $image_path = $rep_Src . $img_Src;
    $image_dest = $rep_Dst . $img_Dst;
    switch ($size) {
        case 64:
            $new_width = 64;
            $new_height = 64;
            break;
        case 128:
            $new_width = 128;
            $new_height = 128;
            break;
        case 400:
            $new_width = 400;
            $new_height = 500;
            break;
        default:
            $new_width = 400;
            $new_height = 500;
            break;
    }//set var $Wmax, $Hmax
    $_SESSION['errors_redi'][] = $image_path;
    $result = resize_img($image_path, $image_dest, $new_width, $new_height, $size, $qualite = 93);

    if ($result != 'success') {
        return 'fail';
    } else {
        return 'success';
    }
}//fonction pour le redimensionement 400*500

function redmi3size($name, $IDimage, $file_ext)
{
    unset($_SESSION['errors_redi']);
    $name_dst = $IDimage . "." . $file_ext;

    //64*64
    $rep_size = "64-64";
    $size = 64;
    $redi64 = fct_redim($size, $rep_size, $name_dst, $IDimage);//doit etre = à "success" si non le redimensionnement n'a pas marcher

    //128*128
    $rep_size = "128-128";
    $size = 128;
    $redi128 = fct_redim2($size, $rep_size, $name_dst, $IDimage);//doit etre = à "success" si non le redimensionnement n'a pas marcher

    //400*500
    $rep_size = "400-500";
    $size = 400;
    $redi400 = fct_redim3($size, $rep_size, $name_dst, $IDimage);//doit etre = à "success" si non le redimensionnement n'a pas marcher

    $temp_img = "model/uploads/temp/" . $name;
    unlink($temp_img);
    //on verifie si les 3 redimentionnement se sont bien déroulé.
    if (($redi64 == "success") && ($redi128 == "success") && ($redi400 == "success")) {
        $log = getLog();
        $log[] = [
            "before" => "",
            "after" => "",
            "what" => "Changing Image : IDimages = " . $name,
            "IDimages" => $IDimage,
            "state" => "Success",
            "date" => strtotime("now")
        ];
        putLog($log);
        require_once 'view/succes.php';
    } else {
        $log[] = [
            "before" => "",
            "after" => "",
            "what" => "Changing Image : IDimages = " . $name,
            "IDimages" => $IDimage,
            "state" => "Fail",
            "date" => strtotime("now")
        ];

        require_once 'view/fail.php';
    }
}//fonction pour redimensioner en 3 tailles distinctes

/* log date heure: Modif: avant vs après/ si upload: nom fichier + ou save
Format :
$log=getLog();
$log[]=[
    "before"=>"",
    "after"=>"",
    "what"=>"Changing Image : IDimages = ".$name,
    "IDimages"=>$name,
    "state"=>"success",
    "date"=>strtotime("now")
];
putLog($log);

*/

?>