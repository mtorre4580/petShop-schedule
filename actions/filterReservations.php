<?php

    include('../setup/constants.php');
    include('../setup/config.php');

    $date = isset($_GET['date']) ? $_GET['date'] : null;

    if ($date) {
        $_SESSION['RESERVATIONS'] = getReservationsByDate($date);
        $_SESSION['LAST_RESERVATION_DATE'] = $date;
    }

    header('location:../index.php?section=reservation');

    /**
     * Permite obtener todas las reservas que ya estan hechas en la fecha dada, como
     * tambien los turnos libres
     * @param Date $date
     * @return Array
     */
    function getReservationsByDate($date) {
        $reservationsDay = getAllReservations($date);
        return findFreeReservations($date, $reservationsDay);
    }

    /**
     * Permite obtener las reservas disponibles que existen en el día
     * @param Date $date
     * @return Array
     */
    function getAllReservations($date) {
        $query = "SELECT 
                        r.date, 
                        r.hour, 
                        r.type,
                        u.name, 
                        IFNULL(u.pic ,'not_image.png') as pic 
                        FROM reservation r JOIN user u ON u.id = r.fk_user WHERE r.date = STR_TO_DATE('$date', '%d/%m/%Y');";
        global $cnx;
        return mysqli_fetch_all(mysqli_query($cnx, $query), MYSQLI_ASSOC);
    }

    /**
     * Permite setear las reservas que estan libres, aca para no complicarla, me cree un array con los horarios
     * que manejan en el petshop, asi es mas fácil, osea, 9 a 11, 11 a 13, cada 2 hs más o menos se manejan...
     * Si justo ese horario esta libre, uso el flag free, para setearlo como ocupado y viceversa...
     * @param Date $date
     * @param Array $reservations
     * @return Array
     */
    function findFreeReservations($date, $reservations) {
        $avaliableReservations = array();
        foreach(HOURS as $hour) {
            $reservation = getReservation($hour, $reservations);
            if ($reservation) {
                $reservation['free'] = false;
            } else {
                $reservation = array(
                    'date' => $date,
                    'hour' => $hour,
                    'name' => null,
                    'free' => true
                );
            }
            array_push($avaliableReservations, $reservation);
        }
        return $avaliableReservations;
    }

    /**
     * Permite obtener la reserva según el horario...
     * @param string $hour
     * @param Array $reservations
     * @param Array
     */
    function getReservation($hour, $reservations) {
        foreach ($reservations as $r) {
            if ($r['hour'] === $hour) {
                return $r;
            }
        }
        return null;
    }

?>