<?php
    $invalidRequest = isset($_SESSION['ERR_LOGIN_PANEL']) ? $_SESSION['ERR_LOGIN_PANEL'] : null;
?>
<div class="jumbotron jumbotron-fluid jumbotron_register primary-color text-white">
    <div class="container">
        <h2 class="h2-reponsive mb-4 mt-2 font-bold">Panel de control</h2>
        <p class="lead">Iniciar sesión</p>
    </div>
</div>
<section style="padding:2em;">
    <form id="form_login_panel" method="POST" action="actions/login.php" >
        <div class="md-form">
            <i class="fa fa-envelope prefix"></i>
            <input type="text" id="email" name="email" class="form-control" />
            <label for="email">Email</label>
        </div>
        <div class="md-form">
            <i class="fa fa-lock prefix"></i>
            <input type="password" id="password" name="password" class="form-control" />
            <label for="password">Password</label>
        </div>
        <div>
            <p id="errFormLogin" class="invalid"><?php echo $invalidRequest ?></p>
        </div>
        <div class="text-center mt-4">
            <button class="btn light-green" type="submit">Acceder</button>
        </div>
    </form>
</section>