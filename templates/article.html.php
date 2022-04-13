</div>
    <div class="parallax-container">
        <div class="parallax">
            <img src="images/posts/<?= $article['image'] ?>" alt="<?= $article['title'] ?>"/>
        </div>
    </div>
    <div class="container">

        <h2><?= $article['title'] ?></h2>
        <h6>Par <?= $article['name'] ?> le <?= date("d/m/Y à H:i", strtotime($article['date'])) ?></h6>
        <p><?= nl2br($article['content']); ?></p>
    </div>

<div class="container">
    <hr>

    <?php if (count($commentaires) === 0) : ?>

        <h4>Il n'y a pas encore de commentaires pour cet article... SOYEZ LE PREMIER!</h4>

    <?php else : ?>

        <h3>Il y a déjà <?= count($commentaires) ?> commentaires : </h3>

        <?php foreach ($commentaires as $commentaire) : ?>

            <h4>Commentaire de <?= $commentaire['name'] ?></h4>
            <small>Le <?= $commentaire['date'] ?></small>
            <blockquote>
                <em><?= $commentaire['comment'] ?></em>
            </blockquote>

        <?php endforeach ?>

    <?php endif ?>
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