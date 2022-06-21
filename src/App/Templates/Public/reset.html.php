<div class="row">
    <div class="col l4 m6 s12 offset-l4 offset-m3">
        <div class="card-panel">
            <div class="row">
                <div class="col s6 offset-s3">
                    <img src="../public/assets/images/admin.png" alt="Modérateur" width="100%"/>
                </div>
            </div>
            <h4 class="center-align">Nouveau mot de passe</h4>

            <?php

            if($session->read('errorMsg')){
                ?>
                <div class="card red">
                    <div class="card-content white-text">
                        <?= $session->get('errorMsg') . "<br/>"; ?>
                    </div>
                </div>
                <?php $session->delete('errorMsg');


            }elseif ($session->read('successMsg')){ ?>
                <div class="card green">
                    <div class="card-content white-text">

                        <?= $session->get('successMsg') . "<br/>"; ?>
                    </div>
                </div>
                <?php $session->delete('successMsg');

            }?>

            <form method="post">
                <input type="hidden" id="csrf_token" name="csrf_token" value="<?= $session->get('csrf_token') ?>">
                <div class="row">
                    <div class="input-field col s12">
                        <input type="password" id="password" name="password" required/>
                        <label for="password">Mot de passe</label>
                    </div>
                    <div class="input-field col s12">
                        <input type="password" id="password_confirm" name="password_confirm" required/>
                        <label for="password_confirm">Confirmez votre mot de passe</label>
                    </div>
                    <div style="text-align: center;">
                        <button type="submit" name="submit" class="btn waves-effect waves-light light-blue">
                            <i class="material-icons left">perm_identity</i>
                            Réinitialiser mon mot de passe
                        </button>
                    </div>
                </div>

            </form>
        </div>

    </div>
</div>