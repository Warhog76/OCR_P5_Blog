<div class="container">

<h2>Liste des articles</h2>
<hr>

<?php

foreach($post as $article){

    ?>

    <div class="row">
        <div class="col s12 m12 l12">
            <h4><?= $article->title ?> <?php echo($article->posted == "0") ? "<i class='material-icons'>lock</i>" : "" ?> </h4>

            <div class="row">
                <div class="col s12 m6 l8">
                    <p><?=substr(nl2br($article->content),0,500) ?> ...</p>
                </div>

                <div class="col s12 m6 l4">
                    <img src="../images/posts/<?= $article->image ?>" class="materialboxed responsive-img" alt="<?= $article->title ?>" >
                    <br>
                    <a class="btn light-blue waves-effect waves-light" href="index.php?page=post&id=<?= $article->id ?>">Voir l'article complet</a>
                </div>

            </div>
        </div>
    </div>

    <?php
}
?>
</div>
