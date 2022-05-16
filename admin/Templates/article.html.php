<?php
$post = get_post();

if($post == false){
    header("location:index.php?pages=error");
}?>

</div>
<div class="parallax-container">
    <div class="parallax">
        <img src="../images/posts/<?= $post->image ?>" alt="<?= $post->title ?>"/>
    </div>
</div>

<div class="container">
    <form method="post">
        <div class="row">
            <div class="input-field col s12">
                <input type="text" name="title" id="title" value="<?= $post->title ?>"/>
                <label for="title">Titre de l'article</label>
            </div>

            <div class="input-field col s12">
                <textarea id="content" name="content" class="materialize-textarea"><?= $post->content ?></textarea>
                <label for="content">Contenu de l'article</label>
            </div>

            <div class="col s6">
                <p>Public</p>
                <div class="switch">
                    <label>
                        Non
                        <input type="checkbox" name="public" <?php echo ($post->posted == "1")?"checked" : "" ?>/>
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