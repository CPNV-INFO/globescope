<?php
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>
<!DOCTYPE html>
<html>
<head>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/pomme.css">
    <title><?=$title?></title>
    <link rel="stylesheet" href="css/cssinhtml.css">
    <link rel="icon" type="image/png" href="//cdn.icon-icons.com/icons2/665/PNG/512/earth_icon-icons.com_60279.png" />
    <script type="text/javascript" src="js/editchild.js"></script>
</head>

<body>
<a class="backup" target="_blank" href="index.php?action=showBackup"><button class="btn btn-primary">Backup</button></a>
<a class="log" target="_blank" href="index.php?action=showLog"><button class="btn btn-primary">Log</button></a>
<a href="index.php?action=disconnect"><button class="btn btn-danger">Déconnexion</button></a>
<a class="homegb2" href="index.php?action=showchilds&welcome=no"><button class="btn btn-success">Accueil</button></a>

<?= $content?>

<script src="js/searchChild2.js"></script>
<script src="js/childClicked2.js"></script>
</body>
</html>