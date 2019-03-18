<?php 

    include('../../setup/constants.php');
    include('../../setup/config.php');
    include('../../setup/utilsImage.php'); 

    $title = isset($_POST['title']) ? $_POST['title'] : null;
    $description = isset($_POST['description']) ? $_POST['description'] : null;
    $type = isset($_POST['type']) ? $_POST['type'] : null;
    $image = $_FILES['image'];

    if (!empty($title) && !empty($description)) {
        saveNew($title, $description, $type, $image);
    }

    /**
     * Permite guardar una nueva noticia con los datos recibidos
     * @param string $title
     * @param string $description
     * @param string $type
     * @param string $image
     * @return void
     */
    function saveNew($title, $description, $type, $image) {
        $nameImage = $image['size'] != 0 ? createNameImage($image, $title) : null;
        $query = "INSERT into news SET title = '$title', date= NOW(), description= '$description'";
        if (!empty($type)) {
            $query = $query.", fk_category = '$type'";
        }
        if ($nameImage) {
            $query = $query.", image = '$nameImage';"; 
        }
        global $cnx;
        $success = mysqli_query($cnx, $query);
        if($success && $nameImage != null) {
            savePic($image, $nameImage, "../../uploads");
        }
    }

    header("Location:../index.php");

?>