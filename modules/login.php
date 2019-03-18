<?php
    $invalidRequest = isset($_SESSION['ERR_LOGIN']) ? $_SESSION['ERR_LOGIN'] : null;
?>
<section>
    <div class="jumbotron jumbotron-fluid jumbotron_register primary-color text-white d-none d-sm-block">
        <div class="container">
            <h2 class="h2-reponsive mb-4 mt-2 font-bold">Hola otra vez!!</h2>
        </div>
    </div>
</section>
<section class="container section_register">
    <div class="row">
        <div class="col-md-4">
            <img src="images/logo.jpg" class="img-fluid" alt="lo que el perro se llevo, almacen y spa para mascotas" />
        </div>
        <div class="col-md-8 d-flex flex-column justify-content-center">
            <form id="form_login" method="POST" action="actions/login.php">
                <h2 class="h2 text-center mb-4">Iniciar sesión</h2>
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
        </div>
    </div>
</section>