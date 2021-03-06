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

        <h2><?= $article->getTitle() ?></h2><hr>
        <h4><?= $article->getChapo() ?></h4><br>
        <h6>Par <?= $article->getWriter() ?> le <?= date("d/m/Y à H:i", strtotime($article->getDate())) ?></h6><br>
        <p><?= nl2br($article->getContent()); ?></p>
    </div>

<div class="container">
    <hr>

    <?php if (count($commentaires) === 0) : ?>

        <h4>Il n'y a pas encore de commentaires pour cet article... SOYEZ LE PREMIER!</h4>

    <?php else : ?>

        <h3>Il y a déjà <?= count($commentaires) ?> commentaires : </h3>

        <?php foreach ($commentaires as $commentaire) : ?>

            <h4>Commentaire de <?= $commentaire->getName() ?></h4>
            <small>Le <?= $commentaire->getDate() ?></small>
            <blockquote>
                <em><?= $commentaire->getComment() ?></em>
            </blockquote>

        <?php endforeach ?>

    <?php endif ?>
</div>

<?php if($session->read('user_function') == '') { ?>
    <div class="container">
    <hr>
    <h5>Vous devez vous connecter pour laisser un commentaire.</h5>
    </div>

<?php
}elseif($session->read('user_function') == 'User'){ ?>

<div class="container">
    <hr>
    <h4>Commenter :</h4>

    <form method="post">
        <input type="hidden" id="csrf_token" name="csrf_token" value="<?= $session->read('csrf_token') ?>">
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

<?php }?>