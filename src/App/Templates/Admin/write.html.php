<div class="container">

<h2>Publier un article</h2>

    <?php use App\Repositories\Session;

    Session::read('errorMsg');
    Session::read('successMsg');

    if(isset($_SESSION['errorMsg'])){
        ?>
        <div class="card red">
            <div class="card-content white-text">
                <?= $_SESSION['errorMsg'] . "<br/>"; ?>
            </div>
        </div>
        <?php unset($_SESSION['errorMsg']);


    }elseif (isset($_SESSION['successMsg'])){ ?>
        <div class="card green">
            <div class="card-content white-text">

                <?= $_SESSION['successMsg'] . "<br/>"; ?>
            </div>
        </div>
        <?php unset($_SESSION['successMsg']);

    }?>

<form method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="input-field col s12">
            <input type="text" name="title" id="title"/>
            <label for="title">Titre de l'article</label>
        </div>

        <div class="input-field col s12">
            <input type="text" name="chapo" id="chapo"/>
            <label for="title">Chapo de l'article</label>
        </div>

        <div class="input-field col s12">
            <textarea name="content" id="content" class="materialize-textarea"></textarea>
            <label for="content">Contenu de l'article</label>
        </div>
        <div class="col s12">
            <div class="file-field input-field">
                <div class="btn">
                    <span>Image de l'article</span>
                    <input type="file" name="image"/>
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate col s10" type="text">
                </div>
            </div>
        </div>

        <div class="col s6">
            <p>Public</p>
            <div class="switch">
                <label>
                    Non
                    <input type="checkbox" name="public"/>
                    <span class="lever"></span>
                    Oui
                </label>
            </div>
        </div>

        <div class="col s6 right-align">
            <br/><br/>
            <button class="btn" type="submit" name="submit">Publier</button>
        </div>
    </div>
</form>

</div>