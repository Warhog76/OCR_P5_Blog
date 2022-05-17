<div class="container">

<h2>Tableau de bord</h2>

<h4>Commentaires non lus</h4>

<table>
    <thead>

    <th>Commentaire</th>
    <th>Actions</th>

    </thead>

    <tbody>

    <?php
    if(!empty($commentaires)) {
        foreach($commentaires as $commentaire){
            ?>

            <tr id="commentaire_ <?= $commentaire->getId() ?>">

                <td><?= substr($commentaire->getComment(),0,100) ?> ...</td>
                <td>
                    <a href="#" id="<?= $commentaire->getId() ?>" class="btn-floating btn-small waves-effect waves-light green see_comment">
                        <i class="material-icons">done</i></a>
                    <a href="#" id="<?= $commentaire->getId() ?>" class="btn-floating btn-small waves-effect waves-light red delete_comment">
                        <i class="material-icons">delete</i></a>
                    <a href="#comment_<?= $commentaire->getId() ?>" class="btn-floating btn-small waves-effect waves-light blue modal-trigger">
                        <i class="material-icons">more_vert</i></a>

                    <div class="modal" id="comment_<?= $commentaire->getId() ?>">
                        <div class="modal-content">

                            <p>Commentaire posté par
                                <strong><?= $commentaire->getName() . " (" . $commentaire->getEmail() . ")</strong><br/>Le " . date("d/m/Y à H:i", strtotime($commentaire->getDate())) ?>
                            </p>
                            <hr/>
                            <p><?= nl2br($commentaire->getComment()) ?></p>
                        </div>
                        <div class="modal-footer">
                            <a href="#" id="<?= $commentaire->getId() ?>" class="modal-action modal-close waves-effect waves-green btn-flat see_comment">
                                <i class="material-icons">done</i></a>
                            <a href="#" id="<?= $commentaire->getId() ?>" class="modal-action modal-close waves-effect waves-red btn-flat delete_comment">
                                <i class="material-icons">delete</i></a>
                        </div>
                    </div>
                </td>

            </tr>
            <?php
        }
    }else{
        ?>
        <tr>
            <td></td>
            <td style="text-align: center;">Aucun commentaire à valider</td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>
</div>