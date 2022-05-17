<div class="parallax-container">
    <div class="parallax">
        <img src="../public/assets/images/accueil.png" alt="photo d'accueil"/>
    </div>
</div>

<div class="container">

    <h3>Derniers articles</h3>
    <hr><br>

    <div class="row">
        <?php foreach($articles as $article){ ?>

            <div class="col l6 m6 s12">

                <div class="card">
                    <div class="card-content">
                        <h5 class="grey-text text-darken-2"><?= $article->getTitle() ?></h5>
                        <h6 class="grey-text">Le <?= date("d-m-Y à H:i",strtotime($article->getDate()))?> par <?= $article->getWriter() ?></h6>
                    </div>

                    <div class="card-image">
                        <img src="../public/assets/images/posts/<?= $article->getImage() ?>" alt="<?= $article->getTitle() ?>">
                    </div>

                    <div class="card-content">
                        <span class="card-title activator grey-text text-darken-a"><i class="material-icons right">more_vert</i></span>
                        <a href="index.php?page=article&id=<?= $article->getId() ?>">"Voir l'article complet"</a>
                    </div>

                    <div class="card-reveal">
                        <span class="card-title activator grey-text text-darken-a"><?= $article->getTitle() ?><i class="material-icons right">close</i></span>
                        <p><?= substr(nl2br($article->getContent()),0,500) ?> ...</p>
                    </div>
                </div>
            </div>

            <?php
        }
        ?>
    </div>
</div>