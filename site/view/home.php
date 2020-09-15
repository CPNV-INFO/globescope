<?php
/**
 * Created By PhpStorm
 * User: benoit.pierrehumbert and simon.cuany
 * Date: 04.02.2020
 * Time: 15:49
 */
ob_start();

?>
<?php
if (isset($_SESSION['flashmessage'])){
    echo "<script>alert('".$_SESSION['flashmessage']."')</script>";
    unset($_SESSION['flashmessage']);
}
?>
<?php
$content = ob_get_clean();
require "gabarit.php";
?>
