<?php
    $userLogged = isset($_SESSION['USER_LOGGED']) ? $_SESSION['USER_LOGGED'] : null;
    $err = isset($_SESSION['ERR_MY_ACCOUNT']) ? $_SESSION['ERR_MY_ACCOUNT'] : null;
    $success = isset($_SESSION['SUCCESS_MY_ACCOUNT']) ? $_SESSION['SUCCESS_MY_ACCOUNT'] : null;
    if (!$userLogged) {
        header('location:./index.php?section=login');
    }
?>
<section>
    <div class="jumbotron jumbotron-fluid jumbotron_register primary-color text-white">
        <div class="container">
            <h2 class="h2-reponsive mb-4 mt-2 font-bold">Mi cuenta</h2>
            <p class="lead">Podrás modificar tus datos personales</p>
        </div>
    </div>
    <div class="container">
        <h3>Modificar contraseña</h3>
        <?php if ($success): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $success ?>
            </div>
        <?php endif; ?>
        <form id="form-my-account" style="padding:20px" method="POST" action="actions/changePassword.php">
            <div class="md-form">
                <input type="password" placeholder="Ingrese su contraseña actual" name="old_password" id="old_password" class="form-control" />
                <label for="old_password">Contraseña actual</label>
            </div>
            <div class="md-form">
                <input type="password" placeholder="Ingrese su nueva contraseña" name="new_password" id="new_password" class="form-control" />
                <label for="old_password">Contraseña nueva</label>
            </div>
            <div>
                <p id="errFormComment" class="invalid"><?php echo $err ?></p>
            </div>
            <div class="text-center mt-4">
                <button class="btn btn-primary mt-1">Confirmar<i class="fa fa-sign-in ml-1"></i></button>
            </div>
        </form>
    </div>
</section>