</div>

<div class="parallax-container">
    <div class="parallax">
        <img src="../public/assets/images/accueil.png" alt="photo d'accueil"/>
    </div>
</div>

<div class="container">

    <h3>Contact</h3>
    <hr><br>

    <form method="post">
        <div class="row">

            <div class="input-field col s12 m6">
                <input type="text" name="name" id="name"/>
                <label for="name">Nom</label>
            </div>

            <div class="input-field col s12 m6">
                <input type="email" name="mail" id="email"/>
                <label for="email">Adresse email</label>
            </div>

            <div class="input-field col s12">
                <input type="text" name="subject" id="subject"/>
                <label for="subject">Sujet</label>
            </div>

            <div class="input-field col s12">
                <textarea name="message" id="message" class="materialize-textarea"></textarea>
                <label for="message">Message</label>
            </div>

            <div class="col s12">
                <button type="submit" name="submit" class="btn btn light-blue waves-effect waves-light">
                    Envoyer
                </button>
            </div>
        </div>
    </form>

</div>