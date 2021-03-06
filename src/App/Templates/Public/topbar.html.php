<nav class="grey darken-1">
    <div class="container">
        <div class="nav-wrapper">

            <a href="#" data-target="mobile-menu" class="sidenav-trigger"><i class="material-icons">menu</i></a>

            <a href="index.php?page=home" class="brand-logo">Frelsi.com</a>

            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li class=""> <a href="index.php?page=home">Accueil</a> </li>
                <li class=""> <a href="index.php?page=blog">Blog</a> </li>
                <li class=""> <a href="index.php?page=contact">Contact</a></li>
                <?php if($session->read('user_function') == 'Admin' || $session->read('user_function') == 'User' ){ ?>
                <li class=""><a href="index.php?page=account"><i class="material-icons">account_circle</i></a></li>
                <?php }?>
                <?php if($session->read('user_function') == null ){ ?>
                <li class=""> <a href="index.php?page=login">Se connecter</a></li>
                <?php }elseif($session->read('user_function') == 'Admin' || $session->read('user_function') == 'User' ){?>
                    <li><a href="index.php?page=logout">Déconnexion</a></li>
                <?php }?>
            </ul>

            <ul class="sidenav" id="mobile-menu">
                <li class=""> <a href="index.php?page=home">Accueil</a> </li>
                <li class=""> <a href="index.php?page=blog">Blog</a> </li>
                <li class=""> <a href="index.php?page=contact">Contact</a></li>
                <?php if($session->read('user_function') == 'Admin' || $session->read('user_function') == 'User' ){ ?>
                <li class=""><a href="index.php?page=account">Mon compte<i class="medium material-icons">account_circle</i></a></li>
                <?php }?>
                <?php if($session->read('user_function') == null ){ ?>
                    <li class=""> <a href="index.php?page=login">Se connecter</a></li>
                <?php }elseif($session->read('user_function') == 'Admin' || $session->read('user_function') == 'User' ){?>
                    <li><a href="index.php?page=logout">Déconnexion</a></li>
                <?php }?>
            </ul>
        </div>
    </div>
</nav>