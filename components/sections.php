<?php switch($section):
    case 'home': 
        include('./modules/home.php'); 
        break;
    case 'login': 
        include('./modules/login.php'); 
        break;
    case 'register': 
        include('./modules/register.php'); 
        break;
    case 'reservation': 
        include('./modules/reservation.php'); 
        break;
    case 'news': 
        include('./modules/news.php'); 
        break;
    case 'detail': 
        include('./modules/detail.php'); 
        break;
    case 'info': 
        include('./modules/info.php'); 
        break;
    default:
        include('./modules/home.php');
endswitch;?>