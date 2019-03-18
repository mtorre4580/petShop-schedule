<?php

    include('../setup/constants.php');
    include('../setup/config.php');

    $params = sanitizeFields($_POST);

    $user = getUser();

    if (validateFields($params, $user)) {
        header('location:../index.php?section=reservation');
    } else {
        saveReservation($params, $user);
        header("location:filterReservations.php?date=".$params['date']);
    }

    /**
     * Permite sanitizar todos los campos recibidos del formulario, si no existen, se setean null
     * @param Array $fields
     * @return Array
     */
    function sanitizeFields($fields) {
        return array(
            'type' => isset($fields['type']) ? $fields['type'] : null,
            'date' => isset($fields['date']) ? $fields['date'] : null,
            'hour' => isset($fields['hour']) ? $fields['hour'] : null
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
    function validateFields($params, $user) {
        return empty($params['type']) || empty($user) || empty($params['date']) || empty($params['hour']);
    }

    /**
     * Permite guardar el registro de una reserva de un usuario en particular, hace el insert en la tabla "reservation"
     * @param Array $params
     * @param Array $user
     * @return void
     */
    function saveReservation($params, $user) {
        $type = $params['type'];
        $date = $params['date'];
        $hour = $params['hour'];
        $idUser = $user['id'];
        $query = "INSERT INTO reservation SET date = STR_TO_DATE('$date', '%d/%m/%Y'), hour = '$hour', fk_user = '$idUser', type ='$type';";
        global $cnx;
        mysqli_query($cnx, $query);
    }
    
?>