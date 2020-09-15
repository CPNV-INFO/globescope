<?php
if (isset($_FILES['image'])){
    unset($_FILES['image']);
}
?>
<html>
<head>
    <title>Upload-Image</title>
    <style>
        body{
            font-family: 'Open Sans', sans-serif;
        }
    </style>
    <link rel="icon" type="image/png" href="//cdn.icon-icons.com/icons2/665/PNG/512/earth_icon-icons.com_60279.png" />
</head>
<body>

<h1>Merci de donner une image en .jpg ou .jpeg ou .png.</h1>
<h2>L'image doit avoir une taille de: 400px/500px (largeur/hauteur) </h2>
<form action="index.php?action=uploadimage&IDimage=<?= $IDimage?>" method="POST" enctype="multipart/form-data">
    <input type="file" name="image" />
    <input type="submit"/>
</form>
</body>
</html>
