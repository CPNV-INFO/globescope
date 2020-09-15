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

        if($file_size > 83886080){
            $errors[]='Le fichier ne doit pas dépasser 8 MB';
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
            echo "<script>alert(".$errors.")</script>";
            require_once 'home.php';
        }
    }
}
function resize_img($image_path,$image_dest,$new_width,$new_height,$qualite = 100){
    /** Ce code à été copier du site http://www.frederic-gerard.com/scripts/script-php-pour-redimentionner-une-image-en-conservant-les-proportions.html
     * Il a été adapter pour correspondre a nos besoin.
     *
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
                    $lengthName=strlen($image_dest);
                    $image_dest=substr_replace($image_dest,".png",$lengthName-4);
                    imagejpeg($dest , $image_dest, $qualite); // Pour les jpg et jpeg
                    break;
                case 'jpeg':
                    $lengthName=strlen($image_dest);
                    $image_dest=substr_replace($image_dest,".png",$lengthName-5);
                    imagejpeg($dest , $image_dest, $qualite); // Pour les jpg et jpeg
                    break;

                case 'png':
                    $lengthName=strlen($image_dest);
                    $image_dest=substr_replace($image_dest,".png",$lengthName-4);
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
}//fonction de redimensionement
function fct_redim($size,$name,$rep_size){
    $rep_Dst='images/'.$rep_size.'/';
    $img_Dst=$name;
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
    if ($result!='success'){
        return 'fail';
    }else{
        return 'success';
    }
}//fonction pour le redimensionement 64*64
function fct_redim2($size,$name,$rep_size){
    $rep_Dst='images/'.$rep_size.'/';
    $img_Dst=$name;
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
    if ($result!='success'){
        return 'fail';
    }else{
        return 'success';
    }
}//fonction pour le redimensionement 128*128
function fct_redim3($size,$name,$rep_size){
    $rep_Dst='images/'.$rep_size.'/';
    $img_Dst=$name;
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
    if ($result!='success'){
        return 'fail';
    }else{
        return 'success';
    }
}//fonction pour le redimensionement 400*500
function redmi3size($name){
    //64*64
    $rep_size="64-64";
    $size=64;
    $redi64=fct_redim($size,$name,$rep_size);//doit etre = à "success" si non le redimensionnement n'a pas marcher

    //128*128
    $rep_size="128-128";
    $size=128;
    $redi128=fct_redim2($size,$name,$rep_size);//doit etre = à "success" si non le redimensionnement n'a pas marcher

    //400*500
    $rep_size="400-500";
    $size=400;
    $redi400=fct_redim3($size,$name,$rep_size);//doit etre = à "success" si non le redimensionnement n'a pas marcher

    //on verifie si les 3 redimentionnement se sont bien déroulé.
    if (($redi64=="success")&&($redi128=="success")&&($redi400=="success")){
        require_once 'succes.html';
    }else {
        require_once 'fail.html';
    }
}//fonction pour redimensioner en 3 taille distincte
?>
