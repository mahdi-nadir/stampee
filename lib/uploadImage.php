<?php
    if (isset($_POST['submit']) && isset($_FILES['image'])) {
        if ($_FILES['image']['error'] === 4) {
            echo "<script>alert('L'image que vous avez sélectionnée n'existe pas!')</script>";
        } else {
            $image = $_FILES['image'];
            $image_name = $image['name'];
            $image_tmp_name = $image['tmp_name'];
            $image_size = $image['size'];
            $image_error = $image['error'];
            $image_type = $image['type'];
            $image_ext = explode('.', $image_name);
            $image_actual_ext = strtolower(end($image_ext));
            $allowed = array('jpg', 'jpeg', 'png');
            if (in_array($image_actual_ext, $allowed)) {
                if ($image_error === 0) {
                    if ($image_size < 1000000) {
                        $image_new_name = uniqid('', true) . "." . $image_actual_ext;
                        $image_destination = 'images/' . $image_new_name;
                        move_uploaded_file($image_tmp_name, $image_destination);
                        header("Location: index.php?uploadsuccess");
                    } else {
                        echo "<script>alert('Votre image est trop lourde!')</script>";
                    }
                } else {
                    echo "<script>alert('Il y a eu une erreur lors du téléchargement de votre image!')</script>";
                }
            } else {
                echo "<script>alert('Vous ne pouvez pas télécharger des fichiers de ce type!')</script>";
            }
            
        }
    } else {
        echo "<script>test2</script>";
    }
?>