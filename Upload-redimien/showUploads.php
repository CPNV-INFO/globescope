<?php
/**
 * Created By PhpStorm
 * User: benoit.pierrehumbert and simon.cuany
 * Date: 04.02.2020
 * Time: 15:49
 */
ob_start();
?>
<img src="uploads/<?= $file_name?>" style="text-align: center" width="400px" alt="image Uploadée">
<div style="position: absolute;left: 42%;top: 42%;background-color: violet;border-radius: 8px;width: 450px;height: 300px">
    <h1><a href="index.php?action=redmi3size&name=<?= $file_name?>"><button>Redimensionner l'image</button></a></h1>
</div>
<?php
$content = ob_get_clean();
require "gabarit.php";
?>
