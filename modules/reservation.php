<?php
    $reservations = isset($_SESSION['RESERVATIONS']) ? $_SESSION['RESERVATIONS'] : header("location:actions/filterReservations.php?date=".date('d/m/Y'));
    $userLogged = isset($_SESSION['USER_LOGGED']) ? $_SESSION['USER_LOGGED'] : null;
    $dateReservation = isset($_SESSION['LAST_RESERVATION_DATE']) ? $_SESSION['LAST_RESERVATION_DATE'] : date('d-m-Y');
?>
<div class="jumbotron jumbotron-fluid jumbotron_register primary-color text-white">
    <div class="container">
        <h2 class="h1-reponsive mb-4 mt-2 font-bold">Reservar</h2>
        <p class="lead">Podes realizar tu reserva de un turno online!</p>
        <p>Con nuestro nuevo sistema, ya no necesitas enviarnos un mensaje para reservar el turno, simplemente elige una fecha y realiza la reserva</p>
    </div>
    <form id="form_reservation" method="GET" action="actions/filterReservations.php">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="input_fecha">
                        <input type="text" id="datepicker" disabled value="<?php echo $dateReservation; ?>" /> 
                        <input id="date" type="hidden" name="date" />
                    </div>
                </div>
                <div class="col-md-8">
                    <button type="submit" class="btn light-green">Buscar</button>
                </div>
            </div>
        </div>
    </form>
</div>
<div>
    <?php foreach($reservations as $reservation): ?>
        <?php if($reservation['free']) : ?>
            <div class="container card_reserve">
                <div class="card_reserve_horario card_turno_libre">
                    <p><?php echo $reservation['hour']; ?> hs</p>
                </div>
                <div class="card-body card_reserve_contenido">
                    <?php if(empty($userLogged)) : ?>
                        <a href="index.php?section=login">Inicia sesión para reservar</a>
                    <?php else : ?>
                        <button type="button" class="btn btn-primary confirmReservation" 
                            data-toggle="modal" 
                            data-target="#confirmReservation" 
                            data-hour="<?php echo $reservation['hour']; ?>" 
                            data-date="<?php echo $reservation['date']; ?>">Reservar</button>
                    <?php endif; ?>
                </div>
            </div>
        <?php else: ?>
            <div class="container card_reserve">
                <div class="card_reserve_horario card_turno_ocupado">
                    <img src="uploads/<?php echo $reservation['pic']; ?>" class="img-fluid rounded-circle" alt="<?php echo $reservation['name']; ?>" />
                    <p><?php echo $reservation['hour']; ?> hs</p>
                </div>
                <div class="card-body card_reserve_contenido">
                    <p class="pb-2 pt-1 title_card_reserve"><i class="fa fa-paw"></i> <?php echo $reservation['name']; ?></p>
                    <p class="card-title subtitle_card_reserve"><?php echo $reservation['type']; ?></p>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>
<?php if(!empty($userLogged)): ?>
    <?php include("confirm.php"); ?>
<?php endif; ?>
