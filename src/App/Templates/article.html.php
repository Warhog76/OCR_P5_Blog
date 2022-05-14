</div>
    <div class="parallax-container">
        <div class="parallax">
            <img src="../public/assets/images/posts/<?= $article->getImage() ?>" alt="<?= $article->getTitle() ?>"/>
       </div>


    </div>
    <div class="container">

        <h2><?= $article->getTitle() ?></h2>
        <h6>Par <?= $article->getWriter() ?> le <?= date("d/m/Y à H:i", strtotime($article->getDate())) ?></h6>
        <p><?= nl2br($article->getContent()); ?></p>
    </div>

<div class="container">
    <hr>


        <?php foreach ($commentaires as $commentaire) : ?>

            <h4>Commentaire de <?= $commentaire->getName() ?></h4>
            <small>Le <?= $commentaire->getDate() ?></small>
            <blockquote>
                <em><?= $commentaire->getComment() ?></em>
            </blockquote>

        <?php endforeach ?>

</div>

<div class="container">
    <hr>
    <h4>Commenter :</h4>

    <form method="post">
        <div class="row">
            <div class="input-field col s12 m6">
                <input type="text" name="name" id="name"/>
                <label for="name">Nom</label>
            </div>
            <div class="input-field col s12 m6">
                <input type="email" name="email" id="email"/>
                <label for="email">Adresse email</label>
            </div>
            <div class="input-field col s12">
                <textarea name="comment" id="comment" class="materialize-textarea"></textarea>
                <label for="comment">Commentaire</label>
            </div>
            <div class="col s12">
                <button type="submit" name="submit" class="btn btn light-blue waves-effect waves-light">
                    Commenter ce post
                </button>
            </div>
        </div>
    </form>
</div>