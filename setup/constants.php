<?php

    //Constantes de la app
    define('WEBSITE','Lo que el perro se llevó');
    define('HOST','localhost');
    define('USER','root');
    define('PASS','');
    define('BD','dw3_torre_matias');
    define('ENCODE_UTF8','utf8');
    define('REGEX_NAME_REGISTER', '/^([a-z]|\.|\ ){3,}$/i');
    define('REGEX_EMAIL_REGISTER', '/[a-z|0-9]{3,8}@{1}[a-z|0-9]{1,8}\.(com|ar)$/i');
    define('REGEX_PASSWORD_REGISTER', '/^([a-z | 0-9]|\.){6,}$/i');
    define('REGEX_PIC_REGISTER', '/\.(jpg|jpeg|png)$/');
    define('REGEX_PIC_SPACES','/[\W\d]/');
    define('REGEX_MULTIPLE_SPACES','/-{2,}/');
    define('REGEX_PNG','/png/i');
    define('REGEX_JPG_JPEG','/jpg|jpeg/i');
    define('REGEX_COMMENT', '/^([a-z | 0-9]|\.){3,}$/i');
    define('HOURS', array('9 - 11','11 - 13','13 - 15','15 - 17','17 - 19','19 - 20:30'));

?>

