<?php 
    include('../setup/constants.php' );
    include('../setup/config.php' );
    $section = isset($_GET['section']) ? $_GET['section'] : 'news';
    $userLogged =  isset($_SESSION['USER_LOGGED']) ? $_SESSION['USER_LOGGED'] : null;
?>
<!DOCTYPE HTML>
<html lang="es-AR">
    <head>
        <meta charset="UTF-8">
        <title>Panel Admin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="../libs/font-awesome/css/fontawesome-all.min.css" />
        <link rel="stylesheet" href="../libs/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" href="../libs/mdbootstrap/css/mdb.min.css" />
        <link rel="stylesheet" href="../css/main.css" />
    </head>
    <body> 
        <?php if($userLogged != null && $userLogged['type'] == 'admin') : ?>
            <?php include('components/header.php') ?>
            <?php include('components/sections.php') ?>
        <?php else: ?>
            <?php include('modules/login.php'); ?>
        <?php endif; ?>
        <script src="../libs/jquery/jquery.min.js"></script>
        <script src="../libs/popper/popper.min.js"></script>
        <script src="../libs/bootstrap/js/bootstrap.min.js"></script>
        <script src="../libs/mdbootstrap/js/mdb.min.js"></script>
        <script src="../libs/gijgo/js/gijgo.min.js"></script>
        <script src="../js/script.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.6/css/gijgo.min.css" rel="stylesheet" />
    </body>
</html>