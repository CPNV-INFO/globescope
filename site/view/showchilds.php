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

        <form method="post" action="index.php?action=showchildsSearch" class="form-group formshow">
            <div class="input-group">
                <input class="form-control" type="text" name="searchText" value=""/>
                <div class="input-group-btn">
                    <button class="btn btn-default" id="searchButton" >
                        <i class="glyphicon glyphicon-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <?php if ($welcome!='no'){echo"<script> alert(\"Bienvenue !\") </script>";}?>
    <h1 class="titleshowchild">Afficher les enfants</h1>
    <br>
    <table class="table" border="1" align="center" style="border: #BCDC53">
        <thead>
        <th width="220px">
            Meridien / Latitude  / Longitude
        </th>
        <th>
            IDPlace
        </th>
        <th>
            IDImage
        </th>
        <th>
            Pseudo
        </th>
        <th>
            Droit
        </th>
        <th>
            Slogan
        </th>
        <th>
            Team
        </th>
        <th>
            École
        </th>
        <th>
            Pays
        </th>
        <th>
            Ville
        </th>
        <th>
            Media
        </th>
        <th>
            Année-production
        </th>
        <th>
            Résumé
        </th>
        <th>
            Modifier
        </th>
        </thead  align="center" >
        <tbody align="center">

        <?php
        foreach ($childs as $child) {

            ?>
            <tr>
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
            </tr>

            <?php
        }
        ?>

        </tbody>
    </table>


    <?php
    $content = ob_get_clean();
    require_once 'gabarit2.php';
} else {
    require 'home.php';
}
?>
