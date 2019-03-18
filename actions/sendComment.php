<?php

    include('../setup/constants.php');
    include('../setup/config.php');

    $params = sanitizeFields($_POST);

    $user = getUser();

    session_start();

    if ($user) {
        $error = validateFields($params);
        if (!empty($error)) {
            $_SESSION['ERR_COMMENT'] = $error;
        } else {
            $_SESSION['ERR_COMMENT'] = null;
            saveComment($params, $user);
        }
        header("location:../index.php?section=detail&id=".$params['idNew']);
    } else {
        header('location:../index.php?section=login');
    }

    /**
     * Permite sanitizar todos los campos recibidos del formulario, si no existen, se setean null
     * @param Array $fields
     * @return Array
     */
    function sanitizeFields($fields) {
        return array(
            'comment' => isset($fields['comment']) ? $fields['comment'] : null,
            'idNew' => isset($fields['idNew']) ? $fields['idNew'] : null,
        );
    }
    
    /**
     * Permite obtener al usuario que esta logueado, toda la info que se guardó anteriormente en sesión
     * @return Array
     */
    function getUser() {
        return $_SESSION['USER_LOGGED'];
    }

    /**
     * Permite validar los campos recibidos
     * @param Array $params
     * @param Array $user
     * @return boolean
     */
    function validateFields($params) {
        $msg = '';
        if (empty($params['comment']) || !preg_match(REGEX_COMMENT, $params['comment']) || empty($params['idNew'])) {
            $msg = $msg.'El comentario debe poseer un mínimo de 3 caracteres <br/>';
        }
        return $msg;
    }

    /**
     * Permite realizar el insert en la tabla "comments"
     * @param Array $params
     * @param Array $user
     * @return void
     */
    function saveComment($params, $user) {
        $idUser = $user['id'];
        $idNew = $params['idNew'];
        $comment = $params['comment'];
        $query = "INSERT INTO comments SET fk_user='$idUser', date = NOW(), fk_new='$idNew', content='$comment';";
        global $cnx;
        mysqli_query($cnx, $query);
    }

?>