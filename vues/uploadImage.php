<?php
    require 'connexion.php';
    if (isset($_POST['submit'])) {
        $file = $_FILES['image'];

        $fileName = $_FILES['image']['name'];
        $fileTmpName = $_FILES['image']['tmp_name'];
        $fileSize = $_FILES['image']['size'];
        $fileError = $_FILES['image']['error'];
        $fileType = $_FILES['image']['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png');

        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 10000) {
                    $fileNameNew = uniqid('');
                    $fileNameNew .= ".".$fileActualExt;
                    /* $fileDestination = 'ressources/css/accueil/img/'.$fileNameNew;
                    echo "done"; */
                    move_uploaded_file($fileTmpName, 'ressources/css/accueil/img/'.$fileDestination);
                    $query = "INSERT INTO image (img_principale, img_enc_id_ce) VALUES ('$fileNameNew', $_SESSION[enc_id])";
                    $result = mysqli_query($conn, $query);
                    header("Location: index.php?module=enchere&action=ajouter&image=$fileNameNew");
                } else {
                    echo "Votre fichier est trop gros!";
                }
            } else {
                echo "Il y a eu une erreur lors du téléchargement de votre fichier!";
            }
        } else {
            echo "Vous ne pouvez pas télécharger des fichiers de ce type!";
        }
    }
?>