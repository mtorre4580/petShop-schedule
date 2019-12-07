<?php

    include('../setup/constants.php');
    include('../setup/config.php');

    $old_password = isset($_POST['old_password']) ? $_POST['old_password'] : null;
    $new_password = isset($_POST['new_password']) ? $_POST['new_password'] : null;

    $_SESSION['ERR_MY_ACCOUNT'] = null;
    $_SESSION['SUCCESS_MY_ACCOUNT'] = null;

    if (empty($old_password) || empty($new_password)) {
        $_SESSION['ERR_MY_ACCOUNT'] = 'Los campos de password no pueden ser vacíos';
        header('location:../index.php?section=my-account');
    } else {
        updatePassword($_SESSION['USER_LOGGED']['id'], $old_password, $new_password);
        header('location:../index.php?section=my-account');
    }

    /**
     * Permite actualizar la contraseña del usuario que esta logueado
     *  @param number $id_user
     *  @param string $old_password
     *  @param string $new_password
     */
    function updatePassword($id_user, $old_password, $new_password) {
        $old_passwordEncript = md5($old_password);
        $new_passwordEncript = md5($new_password);
        if (validateActualPassword($id_user, $old_passwordEncript)) {
            $query = "UPDATE user SET password='$new_passwordEncript' WHERE password='$old_passwordEncript' AND id='$id_user';";
            global $cnx;
            mysqli_query($cnx, $query);
            $_SESSION['SUCCESS_MY_ACCOUNT'] = 'Se ha modificado su contraseña correctamente!';
        } else {
            $_SESSION['ERR_MY_ACCOUNT'] = 'La contraseña actual no coincide';
        }
    }

    /**
     * Permite validar la contraseña actual que posee el usuario
     *  @param number $id_user
     *  @param string $old_password
     *  @return boolean
     */
    function validateActualPassword($id_user, $old_password) {
        $query = "SELECT COUNT(*) as count FROM user WHERE password='$old_password' AND id='$id_user'";
        global $cnx;
        $result = mysqli_query($cnx, $query);
        $row = mysqli_fetch_array($result);
        $count = $row['count'];
        return $count > 0;
    }

?>