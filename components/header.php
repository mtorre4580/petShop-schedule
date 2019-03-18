<?php
    $userLogged = isset($_SESSION['USER_LOGGED']) ? $_SESSION['USER_LOGGED'] : null;
?>
<header>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark scrolling-navbar">
        <h1 class="navbar-brand"><a style="color: #fafafa" href="index.php">Lo que el perro se llevó</a></h1>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarLoQueElPerroSeLlevo">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarLoQueElPerroSeLlevo">
            <ul class="navbar-nav mr-auto">
                <?php foreach($sections as $sec => $link): ?>
                    <li <?php echo $section == $sec ? ' class="nav-item active" ' : ' class="nav-item"' ?>>
                        <a class="nav-link" href="index.php?section=<?php echo $sec ;?>"> <?php echo $link; ?> </a>
                    </li>
                <?php endforeach; ?>
            </ul>
            <ul class="navbar-nav nav-flex-icons">
                <?php if($userLogged != null) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="actions/logout.php"><i class="fas fa-paw"></i> <?php echo $userLogged['email']; ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="actions/logout.php"><i class="fas fa-sign-out-alt"></i>Salir</a>
                    </li>
                <?php else: ?>
                    <li <?php echo $section == 'login' ? ' class="nav-item active" ' : ' class="nav-item"' ?>>
                        <a class="nav-link" href="index.php?section=login"><i class="fa fa-user"></i> Iniciar sesión</a>
                    </li>
                    <li <?php echo $section == 'register' ? ' class="nav-item active" ' : ' class="nav-item"' ?>>
                        <a class="nav-link" href="index.php?section=register">Registrarse</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
</header>