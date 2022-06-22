
</div>

<div class="parallax-container">
    <div class="parallax">
        <img src="../public/assets/images/accueil.png" alt="photo d'accueil"/>
    </div>
</div>

<div class="container">

    <h3>Mon compte </h3>

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
    <hr><br>

    <p>Vous pouvez, avec ce formulaire, modifier votre mot de passe.</p><br>

    <form method="post">
        <input type="hidden" id="csrf_token" name="csrf_token" value="<?= $session->read('csrf_token') ?>">
        <div class="row">
            <div class="input-field col s12">
                <input type="password" id="password" name="password" required/>
                <label for="password">Mot de passe</label>
            </div>
            <div class="input-field col s12">
                <input type="password" id="password_confirm" name="password_confirm" required/>
                <label for="password_confirm">Confirmez votre mot de passe</label>
            </div>
            <div>
                <button type="submit" name="submit" class="btn waves-effect waves-light light-blue">
                    <i class="material-icons left">perm_identity</i>
                    Valider
                </button>
                <br/>
            </div>
        </div>
    </form>

</div>