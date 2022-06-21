<footer class="page-footer grey darken-1">

    <div class="container">
        <div class="row">

            <div class="col l6 s12">
                <h5 class="white-text">Location</h5>
                <p class="grey-text text-lighten-4">Rue de la ferme Dufresne<br>Bernieres, 76210<br>France.</p>
            </div>

            <div class="col l3 s12">
                <h5 class="white-text horizontal">Links</h5>
                <ul>
                    <li><a class="white-text" href="https://github.com/Warhog76">Github</a></li>
                    <li><a class="white-text" href="https://www.linkedin.com/in/nicolas-leduey-505a09166">LinkedIn</a></li>
                </ul>
            </div>

            <?php if($session->read('user_function') == 'Admin'){ ?>
            <div class="col l3 s12">
                <h5 class="white-text">Connect</h5>
                <ul>
                    <a class="btn-floating btn-medium waves-effect waves-light grey darken-3" href="index.php?page=dashboard"><i class="material-icons">computer</i></a>
                </ul>
            </div>
            <?php }?>
        </div>
    </div>

    <div class="footer-copyright grey darken-1">
        <div class="container">
            Made by <a class="white-text text-lighten-3" href="https://materializecss.com">Materialize</a>
        </div>
    </div>

</footer>