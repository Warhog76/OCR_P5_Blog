</div>

<div class="parallax-container">
    <div class="parallax">
        <img src="../public/assets/images/accueil.png" alt="photo d'accueil"/>
    </div>
</div>

<div class="container">
    <h3>Blog</h3>
    <hr><br>

    <?php foreach($articles as $article){ ?>

        <div class="row">
            <div class="col s12 m12 l12">
                <h4><?= $article->getTitle() ?></h4>
                <h5><?= $article->getChapo() ?></h5>
                <h6 class="grey-text">Le <?= date("d-m-Y à H:i",strtotime($article->getDate()))?></h6>

                <div class="row">
                    <div class="col s12 m6 l8">
                        <p><?=substr(nl2br($article->getContent()),0,500) ?> ...</p>
                    </div>

                    <div class="col s12 m6 l4">
                        <img src="../public/assets/images/posts/<?= $article->getImage() ?>" class="materialboxed responsive-img" alt="<?= $article->getTitle() ?>" >
                        <br>
                        <a class="btn light-blue waves-effect waves-light" href="index.php?page=article&id=<?= $article->getId() ?>">Voir l'article complet</a>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>