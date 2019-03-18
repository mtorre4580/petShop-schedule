<?php 
    include('../../setup/constants.php');
    include('../../setup/config.php');

    $title = isset($_POST['title']) ? $_POST['title'] : null;
    $description = isset($_POST['description']) ? $_POST['description'] : null;
    $type = isset($_POST['type']) ? $_POST['type'] : null;
    $id = isset($_POST['id']) ? $_POST['id'] : null;

    $query = "UPDATE news SET title = '$title', description='$description', fk_category='$type' WHERE  ID='$id';";

    mysqli_query($cnx, $query);

    header("Location: ../index.php?section=news");

?>