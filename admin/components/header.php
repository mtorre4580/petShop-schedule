<header>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark scrolling-navbar" style="background-color:#4285F4;margin-bottom:1em;">
        <h1 class="navbar-brand"><a style="color: #fafafa" href="../index.php">Lo que el perro se llevó</a></h1>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarLoQueElPerroSeLlevo">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarLoQueElPerroSeLlevo">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active"><a class="nav-link" href="index.php">Noticias</a></li>
            </ul>
            <ul class="navbar-nav nav-flex-icons">
                <li class="nav-item user__admin__logged"><span><i class="fas fa-paw"></i> <?php echo $userLogged['email']; ?></span></li>
                <li class="nav-item">
                    <a class="nav-link" href="actions/logout.php"><i class="fas fa-sign-out-alt"></i>Salir</a>
                </li>
            </ul>
        </div>
    </nav>
</header>