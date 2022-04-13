</div>

<div class="parallax-container">
    <div class="parallax">
        <img src="images/accueil.png" alt="photo d'accueil"/>
    </div>
</div>

<div class="container">
    <h3>Blog</h3>
    <hr><br>

    <?php foreach($articles as $article){ ?>

        <div class="row">
            <div class="col s12 m12 l12">
                <h4><?= $article['title'] ?></h4>

                <div class="row">
                    <div class="col s12 m6 l8">
                        <p><?=substr(nl2br($article['content']),0,500) ?> ...</p>
                    </div>

                    <div class="col s12 m6 l4">
                        <img src="images/posts/<?= $article['image'] ?>" class="materialboxed responsive-img" alt="<?= $article['title'] ?>" >
                        <br>
                        <a class="btn light-blue waves-effect waves-light" href="article.php?id=<?= $article['id'] ?>">Voir l'article complet</a>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>