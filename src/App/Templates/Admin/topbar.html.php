<nav class="grey darken-1">
    <div class="container">
        <div class="nav-wrapper">

            <a href="#" data-target="mobile-menu" class="sidenav-trigger"><i class="material-icons">menu</i></a>

            <a href="index.php?page=dashboard" class="brand-logo">Frelsi.com</a>

            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li class="<?php echo ($page=="dashboard")?"active" : "";?>"> <a href="index.php?page=dashboard"><i class="material-icons">dashboard</i></a> </li>
                <li class="<?php echo ($page=="write")?"active" : "";?>"> <a href="index.php?page=write"><i class="material-icons">edit</i></a> </li>
                <li class="<?php echo ($page=="list")?"active" : "";?>"> <a href="index.php?page=list"><i class="material-icons">view_list</i></a> </li>
                <li><a href="../public/index.php?page=home">Quitter</a></li>
                <li><a href="index.php?page=logout">Déconnexion</a></li>
            </ul>

            <ul class="sidenav" id="mobile-menu">
                <li class="<?php echo ($page=="dashboard")?"active" : "";?>"> <a href="index.php?page=dashboard">Tableau de bord</a> </li>
                <li class="<?php echo ($page=="write")?"active" : "";?>"> <a href="index.php?page=write">Publier</a> </li>
                <li class="<?php echo ($page=="list")?"active" : "";?>"> <a href="index.php?page=list">Liste des articles</i></a> </li>
                <li><a href="../public/index.php?page=home">Quitter</a></li>
                <li><a href="index.php?page=logout">Déconnexion</a></li>
            </ul>
        </div>
    </div>
</nav>