<?php 

    include('../../setup/constants.php');
    include('../../setup/config.php');
    $id = $_GET['id'];
    $c = "DELETE FROM news WHERE ID = '$id';";
    mysqli_query($cnx, $c);
    header("Location:../index.php");
?>


