<?php
/**
 * Created By PhpStorm
 * User: benoit.pierrehumbert and simon.cuany
 * Date: 04.02.2020
 * Time: 15:49
 */
ob_start();
?>
<img src="imgredi/<?= $file_name?>" style="text-align: center" width="400px" alt="image Uploadée">

<?php
$content = ob_get_clean();
require "gabarit.php";
?>
