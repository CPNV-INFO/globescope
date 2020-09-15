<?php
/**
 * Created By PhpStorm
 * User: simon.cuany and benoit.pierrehumbert
 * Date: 13.02.2020
 * Time: 11.19
 */
$title = "Error";
if ($_SESSION['fail'] == false) {
$title = "Affichage";
ob_start();
?>

<div id="searchbar">

    <form method="post" action="index.php?action=showchildsSearch" class="form-group formscs">
        <div class="input-group">
            <input class="form-control" type="text" name="searchText" value="" placeholder="Search"/>
            <div class="input-group-btn">
                <button class="btn btn-default" id="searchButton">
                    <i class="glyphicon glyphicon-search"></i>
                </button>
            </div>
        </div>
            <br>
            <a class="link" href="index.php?action=showchilds&welcome=no">Annuler la recherche.</a>
    </form>
</div>
<h1 style=" position: absolute ; left: 42%">Afficher les enfants</h1><br><br>
<h4 style="padding-left: 10px"> Rechercher par</h4>





<table class="table" border="1" align="center" style="border: #BCDC53">
    <thead class="fixedth">
    <th class="gradientSCS">
            <span>Meridien Latitude Longitude</span>
    </th>
    <th class="rouge">
        IDPlace
    </th>
    <th class="orange">
        IDImage
    </th>
    <th class="violet">
        Pseudo
    </th>

    <th class="bleu2">
        Droit
    </th>
    <th class="vert2">
        Slogan
    </th>
    <th class="jaune2">
        Team
    </th>
    <th class="violet2">
        École
    </th>
    <th class="orange2">
        Pays
    </th>
    <th class="rouge2" width="8%">
        Ville
    </th>
    <th class="bc-blanc" >
        Media
    </th>
    <th class="bc-blanc">
        Année
    </th>
    <th class="bc-blanc" >
        Résumé
    </th>
    <th class="bc-blanc">
        Modifier
    </th>
    </thead  align="center" >
    <tbody align="center">
    <?php
    if (isset($search)){
        function cmp($a, $b)
        {
            return strcmp($a["sort"], $b["sort"]);
        }

        usort($search, "cmp");
    foreach ($search as $child) {
        if ($child['inIDPlace']==true){$bc_color="rouge";}
        if ($child['inIDImage']==true){$bc_color="orange";}
        if ($child['inmer']==true){$bc_color="jaune";}
        if ($child['inlat']==true){$bc_color="vert";}
        if ($child['inlon']==true){$bc_color="bleu";}
        if ($child['inPseudo']==true){$bc_color="violet";}
        if ($child['inEcole']==true){$bc_color="violet2";}
        if ($child['inDroit']==true){$bc_color="bleu2";}
        if ($child['inSlogan']==true){$bc_color="vert2";}
        if ($child['inTeam']==true){$bc_color="jaune2";}
        if ($child['inPays']==true){$bc_color="orange2";}
        if ($child['inVille']==true){$bc_color="rouge2";}



        ?>
        <tr class="<?= $bc_color ?>">
            <td>
                <p><?= $child['mer'] ?> / <?= $child['lat'] ?> / <?= $child['lon'] ?></p>
            </td>
            <td>
                <p><?= $child['IDPlace'] ?></p>
            </td>
            <td>
                <p><?= $child['IDImage'] ?></p>
            </td>
            <td>
                <p><?= $child['Pseudo'] ?></p>
            </td>
            <td>
                <p><?php if ($child['Droit']!=''){echo substr($child['Droit'], 0,15)."<a href=\"index.php?action=editchild&IDimage=". $child['IDImage']."\" target=\"_blank\"><span class='moredesc'>...</span></a>"; } ?></p>
            </td>
            <td>
                <p><?php if ($child['Slogan']!=''){echo substr($child['Slogan'], 0,15)."<a href=\"index.php?action=editchild&IDimage=". $child['IDImage']."\" target=\"_blank\"><span class='moredesc'>...</span></a>"; } ?></p>
            </td>
            <td>
                <p><?= $child['Team'] ?></p>
            </td>
            <td>
                <p><?= $child['ecole'] ?></p>
            </td>
            <td>
                <p><?= $child['Pays'] ?></p>
            </td>
            <td>
                <p><?= $child['Ville'] ?></p>
            </td>
            <td>
                <p><?php if ($child['Media']!=''){echo substr($child['Media'], 0,15)."<a href=\"index.php?action=editchild&IDimage=". $child['IDImage']."\" target=\"_blank\"><span class='moredesc'>...</span></a>"; } ?></p>

            </td>
            <td>
                <p><?= $child['Anneeprod'] ?></p>
            </td>
            <td>
                <p><?php if ($child['desc']!=''){echo substr($child['desc'], 0,15)."<a href=\"index.php?action=editchild&IDimage=". $child['IDImage']."\" target=\"_blank\"><span class='moredesc'>...</span></a>"; } ?></p>
            </td>

            <td>
                <button class="btn btn-primary"><a
                            href="index.php?action=editchild&IDimage=<?= $child['IDImage'] ?>" target="_blank"
                            class="buttoneditshowchild">Modifier</a></button>
            </td>
        </tr><?php }}
    else{echo "<script>alert('Aucun résultat !')</script>";}?>

    </tbody>
    <?php
    $content = ob_get_clean();
    require_once 'gabarit2.php';
    } else {
        require 'home.php';
    }
    ?>
