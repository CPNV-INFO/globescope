<?php
require_once 'model.php';
function home(){
    require_once 'upload.php';
}
function upload(){
    var_dump($_FILES['image']);
    if(isset($_FILES['image'])){
        $uploads=getUploads();
        $errors= array();
        $file_name = $_FILES['image']['name'];
        $file_size =$_FILES['image']['size'];
        $file_tmp =$_FILES['image']['tmp_name'];
        $file_type=$_FILES['image']['type'];
        $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
        $expensions= array("jpeg","jpg","png");

        if(in_array($file_ext,$expensions)=== false){
            $errors[]="Le format n'est pas reconnu, merci de choisir un fichier en .JPEG ou .PNG.";
        }

        if($file_size > 8388608){
            $errors[]='Le fichier ne doit pas dépasser 4 MB';
        }

        if(empty($errors)==true){
            move_uploaded_file($file_tmp,"uploads/".$file_name);
            $lengthUP=count($uploads);
            $uploads[]=["id"=>$lengthUP+1,
                "name"=>$file_name,
                "size"=>$file_size,
                "tmp"=>$file_tmp,
                "type"=>$file_type,
                "ext"=>$file_ext];
            putUploads($uploads);
            require_once 'showUploads.php';
        }else{
            require_once 'home.php';
        }
    }
}
function redim2($size,$name)
{
    /**
     * Code Copier du site : https://codes-sources.commentcamarche.net/faq/881-php-redimensionner-image-picto-apres-upload
     */
// --------------------------------------------------------------------------------------------------
// fonction de REDIMENSIONNEMENT physique "proportionnel" et ENREGISTREMENT
// --------------------------------------------------------------------------------------------------
// retourne : 1 (vrai) si le redimensionnement et l enregistrement ont bien eu lieu, sinon rien (false)
// --------------------------------------------------------------------------------------------------
// La FONCTION : fct_redim_image($Wmax, $Hmax, $rep_Dst, $img_Dst, $rep_Src, $img_Src)
// Les paramètres :
// - $Wmax : LARGEUR maxi finale ----> ou 0 : largeur libre
// - $Hmax : HAUTEUR maxi finale ----> ou 0 : hauteur libre
// - $rep_Dst : répertoire de l image de Destination (déprotégé) ----> ou '' : même répertoire
// il faut s'assurer que les droits en écriture ont été donnés au dossier (chmod ou via logiciel FTP)
// - $img_Dst : NOM de l image de Destination ----> ou '' : même nom que l image Src
// - $rep_Src : répertoire de l image Source (déprotégé)
// - $img_Src : NOM de l image Source
// --------------------------------------------------------------------------------------------------
// si $rep_Dst = ''   : $rep_Dst=$rep_Src (même répertoire)
// si $img_Dst = '' : $img_Dst=$img_Src (même nom)
// Attention : si $rep_Dst='' ET $img_Dst='' : on écrase (remplace) l image source ($img_Src) !
// NB : $img_Dst et $img_Src doivent avoir la même extension (même type mime) !
// --------------------------------------------------------------------------------------------------
// 3 options :
// A- $Wmax != 0 et $Hmax != 0 : a LARGEUR maxi ET HAUTEUR maxi fixes
// B- si $Wmax = 0 : image finale a LARGEUR maxi fixe (hauteur libre)
// C- si $Hmax = 0 : image finale a HAUTEUR maxi fixe (largeur libre)
// --------------------------------------------------------------------------------------------------
// Extensions acceptees (traitees ici) : .jpg , .jpeg , .png
// Pour ajouter d autres extensions : voir la bibliothèque GD ou ImageMagick
// (GD) NE FONCTIONNE PAS avec les GIF ANIMES ou a fond transparent !
// --------------------------------------------------------------------------------------------------
// UTILISATION (exemple) :
// $redimOK = fct_redim_image(120,80,'reppicto/','monpicto.jpg','repimage/','monimage.jpg');
// if ($redimOK == 1) { echo 'Redimensionnement OK !';  }
// --------------------------------------------------------------------------------------------------
    switch ($size){
        case 64:
            $Wmax=64;
            $Hmax=64;
            break;
        case 128:
            $Wmax=128;
            $Hmax=128;
            break;
        case 400:
            $Wmax=400;
            $Hmax=500;
            break;
        default:
            $Wmax=400;
            $Hmax=500;
            break;
    }//set var $Wmax, $Hmax
    $rep_Dst='';
    $img_Dst='redi_';//.$size.'_'.$name
    $img_Src=$name;
    $rep_Src='uploads/';
    function fct_redim_image($Wmax, $Hmax, $rep_Dst, $img_Dst, $rep_Src, $img_Src)
    {
        // ------------------------------------------------------------------
        $condition = 0;
        // Si certains paramètres ont pour valeur '' :
        if ($rep_Dst == '') {
            $rep_Dst = $rep_Src;
        }  // (meme repertoire)
        if ($img_Dst == '') {
            $img_Dst = $img_Src;
        }  // (meme nom)
        if ($Wmax == '') {
            $Wmax = 0;
        }
        if ($Hmax == '') {
            $Hmax = 0;
        }
        // ------------------------------------------------------------------
        // si le fichier existe dans le répertoire, on continue...
        if (file_exists($rep_Src . $img_Src) && ($Wmax != 0 || $Hmax != 0)) {
            // ----------------------------------------------------------------
            // extensions acceptées :
            $ExtfichierOK = '" jpg jpeg png"';  // (l espace avant jpg est important)
            // extension
            $tabimage = explode('.', $img_Src);
            $extension = $tabimage[sizeof($tabimage) - 1];  // dernier element
            $extension = strtolower($extension);  // on met en minuscule
            // ----------------------------------------------------------------
            // extension OK ? on continue ...
            if (strpos($ExtfichierOK, $extension) != '') {
                // -------------------------------------------------------------
                // récupération des dimensions de l image Src
                $size = getimagesize($rep_Src . $img_Src);
                $W_Src = $size[0];  // largeur
                $H_Src = $size[1];  // hauteur
                // -------------------------------------------------------------
                // condition de redimensionnement et dimensions de l image finale
                // -------------------------------------------------------------
                // A- LARGEUR ET HAUTEUR maxi fixes
                if ($Wmax != 0 && $Hmax != 0) {
                    $ratiox = $W_Src / $Wmax;  // ratio en largeur
                    $ratioy = $H_Src / $Hmax;  // ratio en hauteur
                    $ratio = max($ratiox, $ratioy);  // le plus grand
                    $W = $W_Src / $ratio;
                    $H = $H_Src / $ratio;
                    $condition = ($W_Src > $W) || ($W_Src > $H);  // 1 si vrai (true)
                }
                // -------------------------------------------------------------
                // B- LARGEUR maxi fixe
                if ($Hmax != 0 && $Wmax == 0) {
                    $H = $Hmax;
                    $W = $H * ($W_Src / $H_Src);
                    $condition = $H_Src > $Hmax;  // 1 si vrai (true)
                }
                // -------------------------------------------------------------
                // C- HAUTEUR maxi fixe
                if ($Wmax != 0 && $Hmax == 0) {
                    $W = $Wmax;
                    $H = $W * ($H_Src / $W_Src);
                    $condition = $W_Src > $Wmax;  // 1 si vrai (true)
                }
                // -------------------------------------------------------------
                // on REDIMENSIONNE si la condition est vraie
                // -------------------------------------------------------------
                if ($condition == 1) {
                    // création de la ressource-image"Src" en fonction de l extension
                    // et on crée une ressource-image"Dst" vide aux dimensions finales
                    switch ($extension) {
                        case 'jpg':
                        case 'jpeg':
                            $Ress_Dst = ImageCreateTrueColor($W, $H);
                            $Ress_Src = imagecreatefromjpeg($rep_Src . $img_Src);
                            break;
                        case 'png':
                            $Ress_Dst = ImageCreateTrueColor($W, $H);
                            $Ress_Src = imagecreatefrompng($rep_Src . $img_Src);
                            // fond transparent (pour les png avec transparence)
                            imagesavealpha($Ress_Dst, true);
                            $trans_color = imagecolorallocatealpha($Ress_Dst, 0, 0, 0, 127);
                            imagefill($Ress_Dst, 0, 0, $trans_color);
                            break;
                    }
                    // ----------------------------------------------------------
                    // REDIMENSIONNEMENT (copie, redimensionne, ré-echantillonne)
                    ImageCopyResampled($Ress_Dst, $Ress_Src, 0, 0, 0, 0, $W, $H, $W_Src, $H_Src);
                    // ----------------------------------------------------------
                    // ENREGISTREMENT dans le répertoire (avec la fonction appropriée)
                    switch ($extension) {
                        case 'jpg':
                        case 'jpeg':
                            ImageJpeg($Ress_Dst, $rep_Dst . $img_Dst);
                            break;
                        case 'png':
                            imagepng($Ress_Dst, $rep_Dst . $img_Dst);
                            break;
                    }
                    // ----------------------------------------------------------
                    // libération des ressources-image
                    imagedestroy($Ress_Src);
                    imagedestroy($Ress_Dst);
                }
                // -------------------------------------------------------------
            }
        }
// --------------------------------------------------------------------------------------------------
        // retourne : 1 (vrai) si le redimensionnement et l enregistrement ont bien eu lieu, sinon rien (false)
        // si le fichier a bien été créé
        if ($condition == 1 && file_exists($rep_Dst . $img_Dst)) {
            return true;
        } else {
            return false;
        }
    }
    $worked=fct_redim_image($Wmax, $Hmax, $rep_Dst, $img_Dst, $rep_Src, $img_Src);
    if ($worked==true){
        require_once 'succes.html';
    }else{
        require_once 'fail.html';
    }
// --------------------------------------------------------------------------------------------------
}//fonction pour le redimensionement
function redim($size,$name){
    /**
     * Fonction qui permet de redimensionner une image en conservant les proportions
     * @param  string  $image_path Chemin de l'image
     * @param  string  $image_dest Chemin de destination de l'image redimentionnée (si vide remplace l'image envoyée)
     * @param  integer $max_size   Taille maximale en pixels
     * @param  integer $qualite    Qualité de l'image entre 0 et 100
     * @param  string  $type       'auto' => prend le coté le plus grand
     *                             'width' => prend la largeur en référence
     *                             'height' => prend la hauteur en référence
     * @return string              'success' => redimentionnement effectué avec succès
     *                             'wrong_path' => le chemin du fichier est incorrect
     *                             'no_img' => le fichier n'est pas une image
     *                             'resize_error' => le redimensionnement a échoué
     */

    function resize_img($image_path,$image_dest,$new_width,$new_height,$qualite = 100){

        // Vérification que le fichier existe
        if(!file_exists($image_path)):
            return 'wrong_path';
        endif;

        if($image_dest == ""):
            $image_dest = $image_path;
        endif;
        // Extensions et mimes autorisés
        $extensions = array('jpg','jpeg','png','gif');
        $mimes = array('image/jpeg','image/gif','image/png');

        // Récupération de l'extension de l'image
        $tab_ext = explode('.', $image_path);
        $extension  = strtolower($tab_ext[count($tab_ext)-1]);

        // Récupération des informations de l'image
        $image_data = getimagesize($image_path);

        // Si c'est une image envoyé alors son extension est .tmp et on doit d'abord la copier avant de la redimentionner
        if($extension == 'tmp' && in_array($image_data['mime'],$mimes)):
            copy($image_path,$image_dest);
            $image_path = $image_dest;

            $tab_ext = explode('.', $image_path);
            $extension  = strtolower($tab_ext[count($tab_ext)-1]);
        endif;

        // Test si l'extension est autorisée
        if (in_array($extension,$extensions) && in_array($image_data['mime'],$mimes)):

            // On stocke les dimensions dans des variables
            $img_width = $image_data[0];
            $img_height = $image_data[1];

            //Création de la ressource pour la nouvelle image
            $dest = imagecreatetruecolor($new_width, $new_height);

            // En fonction de l'extension on prépare l'iamge
            switch($extension) {
                case 'jpg':
                case 'jpeg':
                    $src = imagecreatefromjpeg($image_path); // Pour les jpg et jpeg
                    break;

                case 'png':
                    $src = imagecreatefrompng($image_path); // Pour les png
                    break;
            }

            // Création de l'image redimentionnée
            if(imagecopyresampled($dest, $src, 0, 0, 0, 0, $new_width, $new_height, $img_width, $img_height)):

                // On remplace l'image en fonction de l'extension
                switch($extension){
                    case 'jpg':
                    case 'jpeg':
                        imagejpeg($dest , $image_dest, $qualite); // Pour les jpg et jpeg
                        break;

                    case 'png':
                        imagepng($dest , $image_dest, $qualite); // Pour les png
                        break;

                }

                return 'success';

            else:
                return 'resize_error';
            endif;

        else:
            return 'no_img';
        endif;
    }
    $rep_Dst='imgredi/';
    $img_Dst='redi_';//.$size.'_'.$name
    $img_Src=$name;
    $rep_Src='uploads/';
    $image_path=$rep_Src.$img_Src;
    $image_dest=$rep_Dst.$img_Dst;
    switch ($size){
        case 64:
            $new_width=64;
            $new_height=64;
            break;
        case 128:
            $new_width=128;
            $new_height=128;
            break;
        case 400:
            $new_width=400;
            $new_height=500;
            break;
        default:
            $new_width=400;
            $new_height=500;
            break;
    }//set var $Wmax, $Hmax
    $result= resize_img($image_path,$image_dest,$new_width,$new_height,$qualite = 100);
    switch ($result){
        case 'success':
            require_once 'succes.html';
        break;
        case 'wrong_path':
            $error="wrong_path";
            require_once 'fail.php';
        break;
        case 'no_img':
            $error="no_img";
            require_once 'fail.php';
        break;
        case 'resize_error':
            $error="resize_error";
            require_once 'fail.php';
        break;
    }
}
?>
