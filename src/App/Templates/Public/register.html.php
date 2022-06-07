<div class="row">
    <div class="col l4 m6 s12 offset-l4 offset-m3">
        <div class="card-panel">
            <div class="row">
                <div class="col s6 offset-s3">
                    <img src="../public/assets/images/admin.png" alt="Modérateur" width="100%"/>
                </div>
            </div>
            <h4 class="center-align">Créer un compte</h4>

            <form method="post">
                <div class="row">
                    <div class="input-field col s12">
                        <input type="text" id="username" name="username" required/>
                        <label for="username">Nom d'utilisateur</label>
                    </div>
                    <div class="input-field col s12">
                        <input type="email" id="email" name="email"required/>
                        <label for="email">Adresse email</label>
                    </div>
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
                            S'inscrire
                        </button>
                        <br/><br/>
                        <a href="index.php?page=login">Déjà inscrit</a>
                    </div>
                </div>

            </form>
        </div>

    </div>
</div>