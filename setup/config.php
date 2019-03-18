<?php

    //Configuración inicial de la app
    $cnx = mysqli_connect(HOST, USER, PASS, BD);
    mysqli_set_charset($cnx, ENCODE_UTF8);
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $sections = array('home' => 'Inicio', 'news' => 'Noticias', 'reservation' => 'Reservar', 'info' => 'Acerca del sitio');
    session_start();

?>