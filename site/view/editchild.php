<?php
/**
 * Created By PhpStorm
 * User: simon.cuany and benoit.pierrehumbert
 * Date: 13.02.2020
 * Time: 11.19
 */
$title = "Modifications";
ob_start();
?>
<button id="UnlockallCMD" class="UnlockallCMD btn btn-danger">UnlockAll</button>
<h1 align="center">Modifier les infos</h1><br>


<table  border="1" align="center" class="table-edit">
    <thead>
    <th class="center">
        Méridien / Latitude / Longitude
    </th>
    <th class="center">
        IDPlace
    </th>
    <th class="center">
        IDImage
    </th>
    <th class="center">
        Pseudo
    </th>
    <th class="center">
        Droit
    </th>
    <th class="center">
        Slogan
    </th>
    <th class="center">
        Équipe
    </th>
    <th class="center">
       Pays
    </th>
    <th class="center">
       Ville
    </th>
    <th class="center">
        Média
    </th>
    <th class="center">
        Année-production
    </th>
    <th class="center">
        École
    </th>
    <th class="center">
        Titre
    </th>
    <th class="center">
        Résumé
    </th>
    </thead  align="center">
    <tbody align="center">
    <?php

    foreach ($childs as $child) {
        if ($child['IDImage'] == $_SESSION['idchild']) {
            $_SESSION['valuelat']        = $child['lat'];
            $_SESSION['valuemer']        = $child['mer'];
            $_SESSION['valuelon']        = $child['lon'];
            $_SESSION['valueidplace']    = $child['IDPlace'];
            $_SESSION['valueidimage']    = $child['IDImage'];
            $_SESSION['valuepseudo']     = $child['Pseudo'];
            $_SESSION['valuedroit']      = $child['Droit'];
            $_SESSION['valueslogan']     = $child['Slogan'];
            $_SESSION['valueteam']       = $child['Team'];
            $_SESSION['valueville']      = $child['Ville'];
            $_SESSION['valuespays']      = $child['Pays'];
            $_SESSION['valuemedia']      = $child['Media'];
            $_SESSION['valuetitre']      = $child['Titre'];
            $_SESSION['valueanneeprod']  = $child['Anneeprod'];
            $_SESSION['valuedesc']       = $child['desc'];
            $_SESSION['valueecole']       = $child['ecole'];
            $_SESSION['backupnull']=[
                "lat"=>$_SESSION['valuelat'],
                "mer"=>$_SESSION['valuemer'],
                "lon"=>$_SESSION['valuelon'],
                "IDPlace"=>$_SESSION['valueidplace'],
                "IDImage"=>$_SESSION['valueidimage']
            ];
        }
    }
    ?>
   
            <tr>
                <td>
                    <p><?= $_SESSION['valuemer'] ?> / <?=  $_SESSION['valuelat'] ?> / <?= $_SESSION['valuelon'] ?> </p>
                </td>
                <td>
                    <p><?=  $_SESSION['valueidplace'] ?></p>
                </td>
                <td>
                    <p><?=$_SESSION['valueidimage']  ?></p>
                </td>
                <td>
                    <p><?=  $_SESSION['valuepseudo'] ?></p>
                </td>
                <td>
                    <p><?= $_SESSION['valuedroit']  ?></p>
                </td>
                <td>
                    <p>
                        <?=  $_SESSION['valueslogan'] ?>
                    </p>
                </td>
                <td>
                    <p><?= $_SESSION['valueteam']  ?></p>
                </td>
                <td>
                    <p><?= $_SESSION['valuespays'] ?></p>
                </td>
                <td>
                    <p><?= $_SESSION['valueville'] ?></p>
                </td>
                <td>
                    <p><?= $_SESSION['valuemedia'] ?></p>
                </td>
                <td>
                    <p><?= $_SESSION['valueanneeprod'] ?></p>
                </td>
                <td>
                    <p><?= $_SESSION['valueecole'] ?></p>
                </td>
                <td>
                    <p><?= $_SESSION['valuetitre'] ?></p>
                </td>
                <td>
                    <p><?php echo substr($_SESSION['valuedesc'], 0,25)  ?></p>
                </td>

            </tr>

    </tbody>
</table>

<br>
<form method="post" id="formedit" action="index.php?action=save">
    <table align="center" class="table" style="width: 80%">
        <tr>
            <td class="form-group">
                <label for="meridien">Méridien</label>
                <input name="meridien" value="<?= $_SESSION['valuemer'] ?>" type="text" disabled class="form-control" id="meridien">
            </td>
            <td class="form-group">
                <label for="latitude">Latitude</label>
                <input name="latitude" value="<?= $_SESSION['valuelat'] ?>" type="text" disabled class="form-control" id="latitude" >
            </td>
            <td class="form-group">
                <label for="longitude">Longitude</label>
                <input name="longitude" value="<?= $_SESSION['valuelon'] ?>" type="text" disabled class="form-control" id="longitude">
            </td>
        </tr>
        <tr>
            <td class="form-group">
                <label for="idplace">IDplace</label>
                <input name="idplace" value="<?= $_SESSION['valueidplace'] ?>" type="text" disabled class="form-control" id="idplace">
            </td>
            <td class="form-group">
                <label for="idimage">IDimage</label>
                <input name="idimage" value="<?= $_SESSION['valueidimage'] ?>" type="text" disabled class="form-control" id="idimage" >
            </td>
            <td class="form-group">
                <label for="team">Team</label>
                <input name="team" value="<?= $_SESSION['valueteam'] ?>" type="text" id="team" class="form-control">
            </td>
        </tr>
        <tr>
            <td class="form-group">
                <label for="Droit">Droit</label>
                <input name="Droit" value="<?= $_SESSION['valuedroit'] ?>" type="text" id="Droit" class="form-control">

            </td>
            <td class="form-group">
                <label for="Slogan">Slogan</label>
                <input name="Slogan" value="<?= $_SESSION['valueslogan'] ?>" type="text" class="form-control" id="Slogan">
            </td>
            <td class="form-group">
                <label for="Pseudo">Pseudo</label>
                <input name="Pseudo" value="<?= $_SESSION['valuepseudo'] ?>" class="form-control" type="text" id="Pseudo" >
            </td>
        </tr>
        <tr>
            <td class="form-group">
                <label for="Pays">Pays</label>
                <input name="Pays" value="<?= $_SESSION['valuespays'] ?>" class="form-control" type="text" id="Pays" >
            </td>

            <td class="form-group">
                <label for="Ville">Ville</label>
                <input name="Ville" value="<?= $_SESSION['valueville'] ?>" class="form-control" type="text" id="Ville" >
            </td>
            <td class="form-group">
                <label for="ecole">École</label>
                <input name="ecole" value="<?= $_SESSION['valueecole'] ?>" class="form-control" type="text" id="ecole" >
            </td>

        </tr>
        <tr>
            <td class="form-group">
                <label for="Anneeprod">Année de production</label>
                <input name="Anneeprod" value="<?= $_SESSION['valueanneeprod'] ?>" class="form-control" type="text" id="Anneeprod" >
            </td>
            <td class="form-group">
                <label for="Titre">Titre du média</label>
                <input name="Titre" value="<?= $_SESSION['valuetitre'] ?>" class="form-control" type="text" id="Titre" >
            </td>
            <td class="form-group">
                <label for="Media">Média</label>
                <input name="Media" value="<?= $_SESSION['valuemedia'] ?>" class="form-control" type="text" id="Media txt_uploadway" >
                <?php if ($_SESSION['valuemedia']==''){
                    echo "<a href=\"index.php?action=uploadmedia&IDimage=".$_SESSION['valueidimage']."\"><span class='cmd_uploadway'>Upload</span></a>";
                }else{
                    echo "<a href=\"index.php?action=editchild&IDimage=".$_SESSION['valueidimage']."\" id=\"cmd_uploadway\"><span class='cmd_uploadway'>Upload</span></a>";
                }?>
                <a href="<?= $_SESSION['valuemedia'] ?>" class="link Apercu" target="_blank">Aperçu</a>
            </td>
        </tr>
        <tr>
            <td class="form-group">
                <label for="Desc">Description</label>
                <textarea style="resize: none" rows="8" maxlength="1000" class="form-control" name="desc" id="Desc" form="formedit"><?= $_SESSION['valuedesc'] ?></textarea>
            </td>
        </tr>
    </table>
    <div class="buttonEdit">
        <img src="images/400-500/<?= $_SESSION['valueidimage'] ?>.jpg" width="15%" style="margin-top: -30px" alt="Images id : <?= $_SESSION['valueidimage'] ?>"><br><br>
        <a href="index.php?action=uploadimg&IDimage=<?= $_SESSION['valueidimage'] ?>" target="_blank">Remplacer l'image</a>
        <button id="Save" type="submit" class="btn btn-success">Sauvegarder</button>
    </div>
</form>
<br>


    <?php
$content = ob_get_clean();
require_once 'gabarit2.php';
?>
