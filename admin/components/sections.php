<?php switch($section):
    case 'news': 
        include('./modules/news.php'); 
        break;
    case 'edit': 
        include('./modules/edit.php'); 
        break;
    case 'add': 
        include('./modules/add.php'); 
        break;
    default:
        include('./modules/news.php');
endswitch;?>