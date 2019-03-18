<?php
    $invalidRequest = isset($_SESSION['ERR_REGISTER']) ? $_SESSION['ERR_REGISTER'] : null;
?>
<section>
    <div class="jumbotron jumbotron-fluid jumbotron_register primary-color text-white d-none d-sm-block">
        <div class="container">
            <h2 class="h2-reponsive mb-4 mt-2 font-bold">Bienvenido!</h2>
            <p class="lead">Registrate para poder reservar turnos desde nuestra página cortes o baños</p>
            <p>Enterate de las últimas novedades para tus mascotas</p>
        </div>
    </div>
</section>
<section class="container section_register">
    <div class="row">
        <div class="col-md-4">
            <img src="images/logo.jpg" class="img-fluid" alt="lo que el perro se llevo, almacen y spa para mascotas" />
        </div>
        <div class="col-md-8 d-flex flex-column justify-content-center">
            <form id="form_register" method="POST" action="actions/register.php" enctype="multipart/form-data">
                <h2 class="h2 text-center mb-4">Registrarse</h2>
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
                <div style="display:flex;justify-content:space-between">
                    <div class="md-form" style="width:75%; margin-right:5%">
                        <i class="fa fa-paw prefix"></i>
                        <input type="text" id="name" name="name" class="form-control" />
                        <label for="name">Nombre Mascota</label>
                    </div>
                    <div style="width:20%;display:flex;justify-content:center;align-items:center;flex-wrap:wrap">
                        <label for="pic" class="btn light-green btn-small" style="border:0;display:flex;justify-content:center;align-items:center">
                            <input id="pic" type="file" style="display:none;" class="form-control" name="pic" />
                            <i class="fa fa-image" style="text-align:center;font-size: 2em"></i>
                        </label>
                        <span style="color:#757575">Subir Foto</span>
                    </div>
                </div>
                <div>
                    <p id="errFormRegister" class="invalid"><?php echo $invalidRequest ?></p>
                </div>
                <div class="text-center mt-4">
                    <button class="btn light-green" type="submit">Registrarse</button>
                </div>
            </form>
        </div>
    </div>
</section>