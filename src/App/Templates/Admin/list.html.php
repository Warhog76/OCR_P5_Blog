<div class="container">

<h2>Liste des articles</h2>
<hr>

<?php
    foreach($articles as $article){
?>

    <div class="row">
        <div class="col s12 m12 l12">
            <h4><?= $article->getTitle() ?> <?php echo($article->getPosted() == "0") ? "<i class='material-icons'>lock</i>" : "" ?> </h4>

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

<?php
}
?>
</div>
