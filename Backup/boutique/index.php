<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8"/>
	<title>Un Monde plus Juste</title>
 <meta name="viewport" content="width=device-width, initial-scale=1.0" />

 <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

 <link rel="stylesheet" href="boutique/style/classic/global.css">
 <link rel="stylesheet" media="(min-width: 993px)" href="style/classic/poster.css">
 <link rel="stylesheet" media="(min-width: 993px)" href="style/classic/poster_formulaire.css">

 <link rel="stylesheet" media="(max-width: 992px)" href="style/mobile/poster_mobile.css">
 <link rel="stylesheet" media="(max-width: 992px)" href="style/mobile/poster_formulaire_mobile.css">

 <link rel="stylesheet" href="style/style.css">
 <link rel="stylesheet" href="style/homepage.css">

 <script type="text/javascript" src="script/script.js"></script>
</head>

<body>
<?php
/**
 * est appelé lors de la validation d'un formulaire utilisant la méthode post
 */

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $data=lire();
    $exist = check($data,$_POST['EMAIL']);
    /** si la varable genre existe cela signifie que le formulaire est en mode création de compte */
    if(isset($_POST['GENRE'])){
        if($exist==-1){
            /** si l'email n'existe pas encore, ajoute les données à la liste existente */
            $data[] = array($_POST['GENRE'],$_POST['NOM'],$_POST['PRENOM'],$_POST['EMAIL'],$_POST['PAYS'],$_POST['NEWSLETTER'],date("d.m.y"));
        }else{
            /** si l'email existe, remplace les valeurs par des nouvelles si elles sont différentes */
            $data[$exist] = array($_POST['GENRE'],$_POST['NOM'],$_POST['PRENOM'],$_POST['EMAIL'],$_POST['PAYS'],$_POST['NEWSLETTER'],date("d.m.y"));
        }
        ecrire($data);
        /** fixe un identifiant à la session, qui lui permet d'éffectuer les téléchargement */
        $_SESSION["id"] = $_POST['EMAIL'];
        /** aucune erreur */
        $_SESSION["error"]="";
    }else{
        if($exist==-1){
            /** erreur : indique que l'email n'existe pas */
            $_SESSION["error"]= $_POST['EMAIL'];
        }else{
            /** fixe un identifiant à la session, qui lui permet d'éffectuer les téléchargement */
            $_SESSION["id"] = $_POST['EMAIL'];
            /** aucune erreur */
            $_SESSION["error"]="";
        }
    }
}


/**
 * recherche une adresse mail
 * @param $data array tableau 2D contenant la liste des personnes
 * @param $mail string l'adresse mail recherchée
 * @return int l'index ou ce trouve l'adresse mail, sinon -1 si le mail n'existe pas
 */
function check($data,$mail){
    for ($i = 1; $i <= count($data); $i++) {
        if($data[$i][3] == $mail){
            return($i);
        }
    }
    return(-1);
}

/**
 * lit le fichier contenant les coordonnées des personnes
 * @return array tableau 2D contenant la liste des personnes
 */
function lire() {
    $test;
    if (($handle = fopen('data.csv', 'r')) !== FALSE) {
        $nb = 1;
        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
            for ($i = 0; $i < count($data); $i++) {
            }
            $test[$nb] = array($data[$i - 7],$data[$i - 6],$data[$i - 5],$data[$i - 4],$data[$i - 3],$data[$i - 2], $data[$i - 1]);
            $nb++;
        }
        fclose($handle);
        return $test;
    }
}


/**
 * reécrit le fichier contenant les coordonnées des personnes en y apportant les modifications
 * @param $data array tableau 2D contenant la liste des personnes après modification
 */
function ecrire($data){
    $handle = fopen('data.csv', 'w');

    foreach ($data as $fields) {
        fputcsv($handle, $fields,";");
    }
    fclose($handle);
}
?>


  <!-- Vérifie sur un utilisateur est connecter ou si il y a une erreur à afficher-->
  <input type="hidden" id="identifiant" value=<?php if(isset($_SESSION["id"])){echo $_SESSION["id"];} ?> >

<header class="TEMPORAIRE">


    <div id=header-wrapper>
        <div class="container-fluid inner ">
            <div id=header-bg-internal>
                <div class="inner clearfix">
                    <div class="divtable">
                        <ul class="menuhomepage">
                            <li style="background-color: white"><a href="https://www.edm.ch/fr//"><img
                                            src="https://edm.mycpnv.ch/images/Logo_bleu_RGB.png" class="imgup"
                                            id="logoedm"> </a></li>
                            <li><a href="https://www.edm.ch/fr/">Home</a></li>
                            <li><a href="https://edm.mycpnv.ch/?action=home">Globe - EDM</a></li>
                            <li><a href="/boutique">Boutique</a></li>
                            <li><a href="https://edm.mycpnv.ch/forum/">Forum</a></li>
                            <li><a href="https://www.edm.ch/fr/sensibilisation/projet-enfants-reporters">Les droits de
                                    l'enfant</a></li>

                            <li><a href="https://www.edm.ch/fr/sensibilisation/projet-un-monde-plus-juste">Un Monde Plus
                                    Juste</a></li>
                            <li><a href="https://www.edm.ch/fr/media-publication">Les enquêtes</a></li>
                            <li><a href="https://www.edm.ch/fr/media-publication">Crédit</a></li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

</header>
<div id="corps_de_page_posters">
  <section id="titre_posters">
    <p id="titre_globe_usb">Posters du globe téléchargeables</p>
	<p class="sous_titre_glob_poster">Nous avons besoin de quelques informations personnelles afin de limiter la libre circulation de ces posters.</p>
  </section>
  <section id="section_posters">
    <div class="conteneur_posters">
      <div class="posters_telechargeables" id="poster_meridien">
        <div class="poster_inside">
          <img class="image_card_poster" src="../images/page_poster_pictures/image_card_meridien.png" alt="poster meridien">
        </div>
        <div class="poster_inside"><p class="titre_card_poster">Poster méridiens</p></div>
        <div class="poster_inside">
          <span>Date &nbsp;
            <select name="date" class="formulaire_poster" id="choix_poster_meridien_date" onchange="actualiser()">
              <!-- Affiche la liste des version qui est stockée-->

              <?php
              $dir = "poster_download_pictures/meridien/";
              if ($dh = opendir($dir))
              {
                  while (($file = readdir($dh)) !== false)
                  {
                      if($file != '.' && $file != '..')
                      {
                          echo '<option value="';
                          echo $file;
                          echo '">';
                          echo $file;
                          echo '</option>';
                      }
                  }
                  closedir($dh);
              }
              ?>
            </select>
          </span>
        </div>
        <div class="poster_inside">
          <span>Format &nbsp;
            <select name="format" class="formulaire_poster" id="choix_poster_meridien_taille" onchange="actualiser()">
              <option value="A4">A4</option>
              <option value="A3">A3</option>
              <option value="A2">A2</option>
              <option value="A1">A1</option>
              <option value="A0">A0</option>
            </select>
          </span>
        </div>
        <div class="poster_inside" id="bouton_poster_meridiens">
        </div>
      </div>
      <div class="posters_telechargeables" id="poster_ellipse">
        <div class="poster_inside">
          <img class="image_card_poster" src="../images/page_poster_pictures/image_card_ellipse.png" alt="poster meridien">
        </div>
        <div class="poster_inside"><p class="titre_card_poster">Poster ellipse</p></div>
        <div class="poster_inside">
          <span>Date &nbsp;
            <select name="date" class="formulaire_poster" id="choix_poster_ellipse_date" onchange="actualiser()">
            	<!-- Affiche la liste des version qui est stockée-->
                <?php
                $dir = "poster_download_pictures/ellipse";
                if ($dh = opendir($dir))
                {
                    while (($file = readdir($dh)) !== false)
                    {
                        if($file != '.' && $file != '..')
                        {
                            echo '<option value="';
                            echo $file;
                            echo '">';
                            echo $file;
                            echo '</option>';
                        }
                    }
                    closedir($dh);
                }
                ?>
            </select>
          </span>
        </div>
        <div class="poster_inside">
          <span>Format &nbsp;
            <select name="format" class="formulaire_poster" id="choix_poster_ellipse_taille" onchange="actualiser()">
                <option value="A4">A4</option>
              <option value="A3">A3</option>
              <option value="A2">A2</option>
              <option value="A1">A1</option>
              <option value="A0">A0</option>
            </select>
          </span>
        </div>
        <div class="poster_inside" id="bouton_poster_ellipse">
        </div>
      </div>
      <div class="posters_telechargeables" id="poster_personalise">
        <div class="poster_inside">
          <img class="image_card_poster" src="../images/page_poster_pictures/image_card_perso.png" alt="poster meridien">
        </div>
        <div class="poster_inside"><p class="titre_card_poster">Souvenir personnalisé</p></div>
        <div class="poster_inside"><span>Format A4 uniquement</span></div>
        <div class="poster_inside"><span id="card_poster_caractere_invisible">
          <form action="canvas_base.html" method="get">
          <span id="id_souvenir_perso">ID &nbsp</span><input type="number" name="id" value="0" min="0" width="100px" id="input_id_souvenir" disabled>
          <div class="poster_inside" id="bouton_poster_perso">
        </div>   
          </form></span></div>
        
      </div>
    </div>
  </section>

</div>

<div id="nouveauFormulaire"></div>

</body>
</html>