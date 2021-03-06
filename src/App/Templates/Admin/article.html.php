
</div>
<div class="parallax-container">
    <div class="parallax">
        <img src="../public/assets/images/posts/<?= $article->getImage() ?>" alt="<?= $article->getTitle() ?>"/>
    </div>
</div>

<div class="container">

<?php

if($session->read('errorMsg')){
    ?>
    <div class="card red">
        <div class="card-content white-text">
            <?= $session->read('errorMsg') . "<br/>"; ?>
        </div>
    </div>
    <?php $session->delete('errorMsg');


}elseif ($session->read('successMsg')){ ?>
    <div class="card green">
        <div class="card-content white-text">

            <?= $session->read('successMsg') . "<br/>"; ?>
        </div>
    </div>
    <?php $session->delete('successMsg');

}?>

    <form method="post">
        <div class="row">
            <div class="input-field col s12">
                <input type="text" name="title" id="title" value="<?= $article->getTitle() ?>"/>
                <label for="title">Titre de l'article</label>
            </div>

            <div class="input-field col s12">
                <input type="text" name="chapo" id="chapo" value="<?= $article->getChapo() ?>"/>
                <label for="chapo">Chapo de l'article</label>
            </div>

            <div class="input-field col s12">
                <textarea id="content" name="content" class="materialize-textarea"><?= $article->getContent() ?></textarea>
                <label for="content">Contenu de l'article</label>
            </div>

            <div class="input-field col s12">
                <input type="text" name="writer" id="writer" value="<?= $article->getWriter() ?>"/>
                <label for="writer">Auteur de l'article</label>
            </div>

            <div class="col s6 left-align">
                <br/><br/>
                <a class="btn red waves-effect waves-light" href="index.php?page=deleteArticle&id=<?= $article->getId() ?>">Supprimer l'article</a>
            </div>

            <div class="col s6 right-align">
                <br/><br/>
                <button type="submit" class="btn" name="submit">Modifier l'article</button>
            </div>
        </div>
    </form>
</div>