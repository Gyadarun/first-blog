<?php
//vérification de la connexion sinon envoi sur la page de login
if(hasnt_password() == 1){
    header("Location:index.php?page=password");
}

?>

<h2>Tableau de bord</h2>
<div class="row">

    <?php
        // déclaration de tableaux
        $tables = [
            "Publications"      =>  "posts",
            "Commentaires"      =>  "comments"
            
        ];

        $colors = [
            "posts"     =>  "green",
            "comments"  =>  "red"
            
        ];

    ?>


    <?php
        // boucle sur le tableau tables
        foreach($tables as $table_name => $table){
            ?>
                <!-- affichage de cartes avec nom, couleur et nombre d'entrée-->
                <div class="col l4 m6 s12">
                    <div class="card">
                        <div class="card-content <?= getColor($table,$colors) ?> white-text">
                            <span class="card-title"><?= $table_name ?></span>
                            <?php $nbrInTable = inTable($table); ?>
                            <h4><?= $nbrInTable[0] ?></h4>
                        </div>
                    </div>
                </div>
            <?php
        }

    ?>


</div>

<h4>Commentaires non lu</h4>
<?php
    $comments = get_comments();
?>
<table>
    <thead>
        <tr>
            <th>Article</th>
            <th>Commentaire</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // affichage des commentaires non lu s'il y en a
        if(!empty($comments)) {
           // boucle sur les commentaires
            foreach ($comments as $comment) {
                ?>
                <!-- id -->
                <tr id="commentaire_<?= $comment->id ?>">
                    <!--  titre -->
                    <td><?= $comment->title ?></td>
                    <!--  aperçu -->
                    <td><?= substr($comment->comment, 0, 100); ?>...</td>
                    <td>
                        <!-- validation à lu -->
                        <a href="#" id="<?= $comment->id ?>"
                           class="btn-floating btn-small waves-effect waves-light green see_comment"><i
                                class="material-icons">done</i></a>
                        <!-- suppression -->
                        <a href="#" id="<?= $comment->id ?>"
                           class="btn-floating btn-small waves-effect waves-light red delete_comment"><i
                                class="material-icons">delete</i></a>
                        <!-- voir en entier -->
                        <a href="#comment_<?= $comment->id ?>"
                           class="btn-floating btn-small waves-effect waves-light blue modal-trigger"><i
                                class="material-icons">more_vert</i></a>
                        <!-- Fenêtre qui affiche l'article en entier -->
                        <div class="modal" id="comment_<?= $comment->id ?>">
                            <div class="modal-content">
                                <h4><?= $comment->title ?></h4>

                                <p>Commentaire posté par
                                    <strong><?= $comment->name . " (" . $comment->email . ")</strong><br/>Le " . date("d/m/Y à H:i", strtotime($comment->date)) ?>
                                </p>
                                <hr/>
                                <p><?= nl2br($comment->comment) ?></p>

                            </div>
                            <!-- bouton supprimer dans la fenêtre -->
                            <div class="modal-footer">
                                <a href="#" id="<?= $comment->id ?>"
                                   class="modal-action modal-close waves-effect waves-red btn-flat delete_comment"><i
                                        class="material-icons">delete</i></a>
                                <!-- bouton valider dans la fenêtre -->
                                <a href="#" id="<?= $comment->id ?>"
                                   class="modal-action modal-close waves-effect waves-green btn-flat see_comment"><i
                                        class="material-icons">done</i></a>
                            </div>


                        </div>


                    </td>
                </tr>

            <?php
            }
        }else{
            ?>
                <!-- Lorsque aucun commentaire non lu -->
                <tr>
                    <td></td>
                    <td><center>Aucun commentaire à valider</center></td>
                </tr>
            <?php
        }
        ?>
    </tbody>
</table>