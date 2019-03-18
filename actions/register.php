<?php

    include('../setup/constants.php');
    include('../setup/config.php');
    include('../setup/utilsImage.php'); 

    $params = sanitizeFields($_POST, $_FILES['pic']);

    session_start();

    $error = validateFields($params);

    if (!empty($error)) {
        $_SESSION['ERR_REGISTER'] = $error;
        header('location:../index.php?section=register');
    } else {
        $_SESSION['ERR_REGISTER'] = null;
        if (userNotExists($params)) {
            saveUser($params);
            header('location:../index.php?section=login');
        } else {
            $_SESSION['ERR_REGISTER'] = 'Ya existe un usuario registrado con ese email';
            header('location:../index.php?section=register');
        }
    }

    /**
     * Permite sanitizar todos los campos recibidos del formulario, si no existen, se setean null
     * @param Array $fields
     * @return Array
     */
    function sanitizeFields($fields, $pic) {
        return array(
            'email' => isset($fields['email']) ? $fields['email'] : null,
            'password' => isset($fields['password']) ? $fields['password'] : null,
            'name' =>  isset($fields['name']) ? $fields['name'] : null,
            'pic' => $pic
        );
    }

    /**
     * Permite validar los campos recibidos
     * @param Array $params
     * @param Array $user
     * @return boolean
     */
    function validateFields($params) {
        $msg = '';
        $pic = $params['pic'];
        if (empty($params['email']) || !preg_match(REGEX_EMAIL_REGISTER, $params['email'])) {
            $msg = $msg.'El email ingresado no es válido <br/>';
        }
        if (empty($params['password']) || !preg_match(REGEX_PASSWORD_REGISTER, $params['password'])) {
            $msg = $msg.'La contraseña mínimo 6 caracteres <br/>';
        }
        if (empty($params['name']) || !preg_match(REGEX_NAME_REGISTER, $params['name'])) {
            $msg = $msg.'El nombre mínimo 3 carácteres <br/>';
        }
        if ($pic['size'] !=0) {
            $nameFile = $pic['name'];
            if (!preg_match(REGEX_PIC_REGISTER, $nameFile)) {
                $msg = $msg.'La foto no cumple el formato permitido jpg, jpeg, png <br/>';
            }
        }
        return $msg;
    }

    /**
     * Permite verificar si ya existe un usuario con ese email elegido
     * @param Array $params
     * @return boolean
     */
    function userNotExists($params) {
        $passwordEncript = md5($params['password']);
        $email = $params['email'];
        $query = "SELECT * FROM user WHERE password = '$passwordEncript' AND  email = '$email' LIMIT 1; ";
        global $cnx;
        mysqli_query($cnx, $query);
        return mysqli_affected_rows($cnx) == 0;
    }
   
    /**
     * Permite realizar un insert en la tabla "user" , tambien agrega si existe la imagen, en la ubicación de uploads
     * sólo se sube si se realizó correctamente el insert
     * @param Array $params
     * @return void
     */
    function saveUser($params) {
        $pic = $params['pic'];
        $email = $params['email'];
        $name = $params['name'];
        $password = $params['password'];
        $nameImage = $pic['size'] != 0 ? createNameImage($params['pic'], $name) : null;
        $passwordEncript = md5($password);
        $query = "INSERT INTO user SET email = '$email', password = '$passwordEncript', name = '$name', type= 'user'";
        if ($nameImage) {
            $query = $query.", pic = '$nameImage';"; 
        }
        global $cnx;
        $success = mysqli_query($cnx, $query);
        if ($success && $nameImage != null) {
            savePic($pic, $nameImage, "../uploads");
        }
    }

?>