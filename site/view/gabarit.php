<?php
    header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    //line: 224 //<p class="search-help">Recherchez par pays, ville, droit, école, équipe…</p>
?>
<!DOCTYPE html>
<html>
<head>
    <title>Globe Virtuel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="css/Loginstyle.css">
    <link rel="stylesheet" href="css/style.css?d=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/sideBarStyle.css?d=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/searchBar.css?d=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/searchResults.css?d=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/helpStyle.css?d=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/progressBar.css?d=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/cssinhtml.css">
    <link rel="icon" type="image/png" href="//cdn.icon-icons.com/icons2/665/PNG/512/earth_icon-icons.com_60279.png"/>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="js/Loginstyle.js"></script>
    <script src="js/Media.js"></script>
    <script src="https://kit.fontawesome.com/62d62738cd.js" cros sorigin="anonymous"></script>



</head>

<body class="bodyglob">

<div id="login" class="modal" style="  overflow: hidden;">

    <form class="modal-content animate" action="index.php?action=tryLogin" method="post">
        <div class="imgcontainer">
            <span onclick="document.getElementById('login').style.display='none'" class="close" title="Close Modal">&times;</span>
            <img src="images/avatar.png" alt="Avatar" class="avatar">
        </div>

        <div class="container">
            <label for="uname"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="username" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" required>

            <button type="submit">Login</button>
        </div>


    </form>
</div>


<div class="test">

    <?= $content ?>


</div>
<span><img id="helpButton" class="GUI" src="images/questionMark.png"><span
            class="help-text GUI">Comment ça marche ?</span></span>
<div id="Help" class="GUI">
    <div id="box">
        <div id="header">
            <h3 class="aide" a href="">Comment ça marche?</h3>
        </div>
        <p id="closeHelp" class="closeButton" onclick="closeHelp()">X</p>
        <div id="direction">
            <p id="aideDeplacementSouris">Faites tourner le globe en maintenant le clic gauche de la souris.</p>
        </div>
        <div id="Aidereste" class="Aide">
            <p id="aideZoom">Utilisez les touches +/- ou la molette de souris pour zoomer et dézoomer.</p>

            <p id="aideAgrandirImage">Cliquez sur l’image pour l’agrandir et afficher ses informations.</p>

            <p id="aideRecherche">Cherchez une photo et ses informations en insérant un mot-clé dans l’outil de
                recherche : pays, ville, droit, équipe, pseudo, école, enquête, classe…</p>
        </div>
    </div>
    <div id="creditBox">
        <div id="header">
            <h3 class="credit" a href="">Credit</h3>
        </div>
        <p id="closeCredit" class="closeButton" onclick="closeHelp()">X</p>
        <!-- Groupe 1.0 -->
        <img id="imageGroupe" src="images/photoGroupe.png" alt="Development Group">
        <div id="Groupe">
            <p id="groupeMembresContenu"></p>
        </div>
        <!-- Groupe 2.0 -->
        <img id="imageGroupe" src="images/PhotoGroupe2.0.jpg" alt="Development Group">
        <div id="Groupe">
            Benoit Pierrehumbert, Kevin Vaucher, Simon Cuany
        </div>
        <div class="languageSelect">
            <span id="creditSpan" onclick="aideFr()">Help</span>
        </div>
    </div>
</div>

<div class="zoom GUI">
    <span style="color: white;font-size: 19px;"><i id="iconPlus" onclick="alert('Nous travaillons toujours dessus...')" style="cursor: pointer;" class="fas fa-plus-circle fa-2x"></i></span><br>
    <span style="color: white;font-size: 19px"><i id="iconMinus" onclick="alert('Nous travaillons toujours dessus...')" style="cursor: pointer;" class="fas fa-minus-circle fa-2x"></i></span>
</div>

<div id="sideBar" class=" GUI" style="height: 560px">
    <p id="closeSideBar" class="closeButton">X</p>
    <div class="loader" id="imageLoader"></div>
    <div id="onClickDetails" style="overflow-y: scroll; height:550px;">
        <img style="margin-top: 450px;width:340px;height:425px;" id="childImage">
        <a class="return-button" id="returnButton" target="_blank">Retour</a>
        <span id="separator"></span>


        <div id="description">
            <table class="tablehome-infos" id="tbl_details">

                <tr>
                    <td width="25%">Pseudo</td>
                    <td width="70%">
                        <span id="childPseudo">-</span>
                    </td>
                </tr>

                <tr>
                    <td>Média</td>
                    <td>
                        <a class="medialink" target="_blank" id="childMedia"></a>
                    </td>
                </tr>
                <tr>
                    <td>Année</td>
                    <td><span id="childAnneeprod">-</span></td>
                </tr>
                <tr>
                    <td>Id Place</td>
                    <td><span id="childIDPlace">-</span></td>
                </tr>
                <tr>
                    <td>Télécharger les posters</td>
                    <td><a href="/boutique" target="_blank">Poster personnalisé</a></td>
                </tr>
                <tr><td colspan="2"><textarea disabled name="desc" id="childDesc" cols="45" rows="4"></textarea></td></tr>
                <tr>

                <?php if ($_SESSION['fail'] == false) {
                    echo "<td><h6 class=\"infosuppleft\" align=\"left\"><a class='GoToChild' id=\"childEdit\" target=\"_blank\">Modifier</a></h6></td>";
                } ?>
                </tr>
            </table>
            <?php if ($_SESSION['fail'] == false) {
                echo "";
            } ?>
        </div>

    </div>
    <div id="onSearchDetails" class="flexContainer">
        <h1>Resultat de la recherche</h1>

    </div>
</div>

<span id="showSearch"></span>

<div id="searchBar" class="GUI">
    <div class="help-tip">
        <p>Recherchez par pays, ville, droit, équipe, pseudo, école, numéro de l'enfant</p><!-- prendre celui qui est dqns cm cq marche -->
    </div>
    <input type="text" id="searchText" placeholder="Recherchez par pays, ville, droit...">
    <span id="searchButton">Rechercher</span>
    </input>


    <div id="onDynamicSearch">

    </div>
</div>

<div>
    <?php if (isset($_SESSION['username'])) {
        echo "<a href=\"index.php?action=disconnect\"><button class=\"disconnect-cmd\">Déconnexion</button></a>";
    } ?>
    <a href="https://www.edm.ch/fr/sensibilisation"><img src="images/logo_EDM.png" class="logo_edm"
                                                         alt="Logo d'Enfants du monde" width="200px"></a>
</div>
<div id="loading">
    <p>Chargement...</p>
    <a href="index.php?action=easteregg" target="_blank">
        <div class="w3-light-grey w3-round-xlarge">
            <div id="progress_bar" class="w3-blue w3-round-xlarge" style="width:0%;height: 5px;margin-top: -20px; cursor: default;"></div>
        </div>
    </a>

</div>

<script src="js/three.min.js"></script>

<script src="js/three/loaders/DDSLoader.js"></script>
<script src="js/loader.js"></script>
<script src="js/searchChild.js"></script>
<script src="js/childClicked.js"></script>
<script src="js/Tween.js"></script>
<script src="js/three/controls/OrbitControls.js"></script>
<div class="pop-up">

</div>


<script type="application/x-glsl" id="sky-vertex">
varying vec2 vUV;

void main() {
    vUV = uv;
    vec4 pos = vec4(position, 1.0);
    gl_Position = projectionMatrix * modelViewMatrix * pos;
}


</script>
<script type="application/x-glsl" id="sky-fragment">
uniform sampler2D texture;
varying vec2 vUV;

void main() {
    vec4 sample = texture2D(texture, vUV);
    gl_FragColor = vec4(sample.xyz, sample.w);
}


</script>


<script src="js/globescope.js"></script>
<script src="js/Login.js"></script>


</body>
</html>