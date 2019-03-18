<?php

    include('../setup/constants.php');
    include('../setup/config.php');

    $params = sanitizeFields($_POST);

    session_start();

    $error = validateFields($params);

    if (!empty($error)) {
        $_SESSION['ERR_LOGIN'] = $error;
        header('location:../index.php?section=login');
    } else {
        $_SESSION['ERR_LOGIN'] = null;
        $user = loginUser($params);
        if ($user) {
            $_SESSION['USER_LOGGED'] = $user;
            header('location:../index.php?section=home');
        } else {
            $_SESSION['ERR_LOGIN'] = 'Los datos ingresados no son correctos';
            header('location:../index.php?section=login');
        }
    }
    
    /**
     * Permite sanitizar todos los campos recibidos del formulario, si no existen, se setean null
     * @param Array $fields
     * @return Array
     */
    function sanitizeFields($fields) {
        return array(
            'email' => isset($fields['email']) ? $fields['email'] : null,
            'password' => isset($fields['password']) ? $fields['password'] : null,
        );
    }

    /**
     * Permite validar los campos recibidos
     * @param Array $params
     * @return string
     */
    function validateFields($params) {
        $msg = '';
        if (empty($params['email']) || !preg_match(REGEX_EMAIL_REGISTER, $params['email'])) {
            $msg = $msg.'El email ingresado no es válido <br/>';
        }
        if (empty($params['password']) || !preg_match(REGEX_PASSWORD_REGISTER, $params['password'])) {
            $msg = $msg.'La contraseña mínimo 6 caracteres <br/>';
        }
        return $msg;
    }

    /**
     * Permite obtener si existe el usuario, con la info...
     * @param Array $params
     * @return Array 
     */
    function loginUser($params) {
        $email = $params['email'];
        $passwordEncript = md5($params['password']);
        $query = "SELECT id, email, name, IFNULL(pic ,'not_image.png') as pic, type FROM user WHERE email = '$email' and password = '$passwordEncript' LIMIT 1;";
        global $cnx;
        $result = mysqli_query($cnx, $query);
        if (mysqli_affected_rows($cnx) != 0) {
            return mysqli_fetch_assoc($result);
        }
        return null;
    }

?>