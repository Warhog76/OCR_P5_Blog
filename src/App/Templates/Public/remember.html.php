
<div class="row">
    <div class="col l4 m6 s12 offset-l4 offset-m3">
        <div class="card-panel">
            <div class="row">
                <div class="col s6 offset-s3">
                    <img src="../public/assets/images/admin.png" alt="Administrateur" width="100%"/>
                </div>
            </div>

            <h4 class="center-align">Mot de passe oublié</h4>

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
                <div class="row">
                    <div class="input-field col s12">
                        <input type="email" id="email" name="email"/>
                        <label for="email">Adresse email</label>
                    </div>

                <div style="text-align: center;">
                    <button type="submit" name="submit" class="waves-effect waves-light btn light-blue">
                        <i class="material-icons left">perm_identity</i>
                        Envoyer
                    </button>
                    <br/>
                </div>
            </form>
        </div>
    </div>
</div>