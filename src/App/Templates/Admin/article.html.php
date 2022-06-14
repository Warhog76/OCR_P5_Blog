</div>
<div class="parallax-container">
    <div class="parallax">
        <img src="../public/assets/images/posts/<?= $article->getImage() ?>" alt="<?= $article->getTitle() ?>"/>
    </div>
</div>

<div class="container">

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

    <form method="post">
        <div class="row">
            <div class="input-field col s12">
                <input type="text" name="title" id="title" value="<?= $article->getTitle() ?>"/>
                <label for="title">Titre de l'article</label>
            </div>

            <div class="input-field col s12">
                <input type="text" name="chapo" id="chapo" value="<?= $article->getChapo() ?>"/>
                <label for="title">Chapo de l'article</label>
            </div>

            <div class="input-field col s12">
                <textarea id="content" name="content" class="materialize-textarea"><?= $article->getContent() ?></textarea>
                <label for="content">Contenu de l'article</label>
            </div>

            <div class="col s6">
                <p>Public</p>
                <div class="switch">
                    <label>
                        Non
                        <input type="checkbox" id="public" name="public" <?php echo ($article->getPosted() == "1")?"checked" : "" ?>/>
                        <span class="lever"></span>
                        Oui
                    </label>
                </div>
            </div>

            <div class="col s6 right-align">
                <br/><br/>
                <button type="submit" class="btn" name="submit">Modifier l'article</button>
            </div>
        </div>
    </form>
</div>