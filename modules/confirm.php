<div class="modal fade" id="confirmReservation" tabindex="-1" role="dialog" aria-labelledby="confirmReservation" aria-hidden="true">
    <div class="modal-dialog cascading-modal modal-avatar modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <img src="uploads/<?php echo $userLogged['pic']; ?>" alt="pic dog" class="rounded-circle img-responsive" />
            </div>
            <div class="modal-body text-center mb-1">
                <h3 class="mt-1 mb-2"><?php echo $userLogged['name']; ?></h3>
                <form method="POST" action="actions/confirmReservation.php">
                    <div class="md-form ml-0 mr-0">
                        <p style="text-align:left">Elige alguna opción</p>
                        <select class="form-control option__reservation" name="type">
                            <option>Baño</option>
                            <option>Corte</option>
                            <option>Baño y corte</option>
                        </select>
                        <input id="date_reservation" type="hidden" name="date" />
                        <input id="hour_reservation" type="hidden" name="hour" />
                    </div>
                    <div class="text-center mt-4">
                        <button class="btn btn-primary mt-1">Confirmar<i class="fa fa-sign-in ml-1"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
