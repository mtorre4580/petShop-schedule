<?php
    include('../../setup/constants.php');
    include('../../setup/config.php');

    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;

    $error = validateEmailPassword($email, $password);

    if (!empty($error)) {
        $_SESSION['ERR_LOGIN_PANEL'] = $error;
        header('location:../index.php?section=login');
    } else {
        $_SESSION['ERR_LOGIN_PANEL'] = null;
        $user = loginUser($email, $password);
        if ($user) {
            $_SESSION['USER_LOGGED'] = $user;
            header('location:../index.php');
        } else {
            $_SESSION['ERR_LOGIN_PANEL'] = 'Los datos ingresados no son correctos';
            header('location:../index.php?section=login');
        }
    }

    /**
     * Permite validar los campos de email y password
     * @param string $email
     * @param string $password
     * @return string
     */
    function validateEmailPassword($email, $password) {
        $msg = '';
        if (empty($email) || !preg_match(REGEX_EMAIL_REGISTER, $email)) {
            $msg = $msg.'El email ingresado no es válido <br/>';
        }
        if (empty($password) || !preg_match(REGEX_PASSWORD_REGISTER, $password)) {
            $msg = $msg.'La contraseña mínimo 6 caracteres <br/>';
        }
        return $msg;
    }

    /**
     * Permite obtener si existe el usuario admin...
     * @param string $email
     * @param string $password
     * @return Array
     */
    function loginUser($email, $password) {
        $passwordEncript = md5($password);
        $query = "SELECT id, email, name, IFNULL(pic ,'not_image.png') as pic, type FROM user WHERE email = '$email' and password = '$passwordEncript' and type = 'admin' LIMIT 1;";
        global $cnx;
        $result = mysqli_query($cnx, $query);
        if (mysqli_affected_rows($cnx) != 0) {
            return mysqli_fetch_assoc($result);
        }
        return null;
    }

?>