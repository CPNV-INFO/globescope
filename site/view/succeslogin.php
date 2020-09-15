<?php
/**
 * Created By PhpStorm
 * User: Benoit.PIERREHUMBERT and simon.cuany
 * Date: 11.02.2020
 * Time: 16:38
 */
ob_start();

if (isset($_SESSION['username'])) {
    ?>
    <script>window.open("index.php?action=showchilds")
    </script>
    <?php
}
$content = ob_get_clean();

require "gabarit.php";
?>