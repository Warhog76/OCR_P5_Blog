<nav class="light-blue">
    <div class="container">
        <div class="nav-wrapper">

            <a href="#" data-target="mobile-menu" class="sidenav-trigger"><i class="material-icons">menu</i></a>

            <a href="index.php?page=home" class="brand-logo">NL-DEV</a>

            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li class="<?= ($page=="home")?"active" : "";?>"> <a href="index.php">Accueil</a> </li>
                <li class="<?= ($page=="blog")?"active" : "";?>"> <a href="blog.php">Blog</a> </li>
                <li class="<?= ($page=="contact")?"active" : "";?>"> <a href="contact.php">Contact</a></li>
            </ul>

            <ul class="sidenav" id="mobile-menu">
                <li class="<?= ($page=="home")?"active" : "";?>"> <a href="index.php">Accueil</a> </li>
                <li class="<?= ($page=="blog")?"active" : "";?>"> <a href="blog.php">Blog</a> </li>
                <li class="<?= ($page=="contact")?"active" : "";?>"> <a href="contact.php">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>