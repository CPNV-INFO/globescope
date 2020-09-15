<?php
if (isset($_FILES['media'])) {
    unset($_FILES['media']);
}
?>
<html>
<head>
    <title>Upload-Image</title>
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
        }
    </style>
    <link rel="icon" type="image/png" href="//cdn.icon-icons.com/icons2/665/PNG/512/earth_icon-icons.com_60279.png"/>
</head>
<body><?php if (isset($errors)) { ?>
    <script>alert(<?=$errors?>)</script>
<?php } ?>
<h1>Merci de donner un fichier qui ne dépasse pas 10 MB.</h1>
<form action="index.php?action=uploadfile&IDimage=<?= $IDimage ?>" method="POST" id="myForm" enctype="multipart/form-data">
    <input type="file" name="media" id="file"/><br>
    <label for="newtitle">Nouveau Titre (Si vide garde le titre du fichier)</label>
    <input name="newtitle" type="text">
    <button onclick="Filevalidation()">Envoyer</button>
    <br><br><br><a href="index.php?action=editchild&IDimage=<?= $IDimage ?>">Retour aux modifications l'enfant</a>
    <script>
        Filevalidation = () => {
            const fi = document.getElementById('file');
            // Check if any file is selected.
            if (fi.files.length > 0) {
                for (const i = 0; i <= fi.files.length - 1; i++) {

                    const fsize = fi.files.item(i).size;
                    const file = Math.round((fsize / 1024));
                    // The size of the file.
                    if (file >= 10240) {
                        alert(
                            "Le fichier est trop gros, merci de choisir un fichier de moins de 10 Mb ( "+file/1000+" Mb )" );
                        window.open("index.php?action=uploadmedia&IDimage=<?= $IDimage ?>");
                        window.close();
                    } else {
                        document.getElementById("myForm").submit();
                    }
                }
            }
        }
    </script>

</form>

</body>
</html>
