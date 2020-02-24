<?php
/**
 * Created By PhpStorm
 * User: simon.cuany
 * Date: 13.02.2020
 * Time: 11.19
 */

ob_start();
?>
<h1 align="center">Afficher les enfants</h1>
<form action="">
    <label for="test">Latitude</label>
    <input type="radio" id="test" name="Recherche">
    <label for="test">Longitude</label>
    <input type="radio" id="test" name="Recherche">
    <label for="test">Meridien</label>
    <input type="radio" id="test" name="Recherche">
    <label for="test">id image</label>
    <input type="radio" id="test" name="Recherche">
</form>

<table class="table" border="1"  align="center">
    <thead>
    <th>
        Latitude / Longitude / Meridien
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
        Origine
    </th>
    <th>
        Modifier
    </th>
    </thead  align="center">
    <tbody  align="center">

        <?php
         foreach ($childs as $child) {

        ?>
    <tr>
            <td>
                <p><?= $child['lat'] ?> /  <?= $child['lon'] ?> / <?= $child['mer'] ?></p>
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
                <p><?= $child['Droit'] ?></p>
            </td>
            <td>
                <p>
                    <?= $child['Slogan'] ?>
                </p>
            </td>
            <td>
                <p><?= $child['Provenance'] ?></p>
            </td>
            <td>
                <button><a href="index.php?action=editchild&IDimage=<?= $child['IDImage'] ?>">Modifier</a></button>
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
?>
