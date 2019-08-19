<?php
// redirection vers la page erreur si pas de correspondance
$post = get_post();
if($post == false){
    header("Location:index.php?page=error");
}else{
    ?>
       <!--  sinon, affichage de l'article -->
        </div>
    <div class="parallax-container">
        <div class="parallax">
            <img src="img/posts/<?= $post->image ?>" alt="<?= $post->title ?>"/>
        </div>
    </div>
        <div class="container">

            <h2><?= $post->title ?></h2>
            <h6>Par <?= $post->name ?> le <?= date("d/m/Y à H:i", strtotime($post->date)) ?></h6>
            <p><?= nl2br($post->content); ?></p>
    <?php
}
?>

            <hr>
            <!-- affichage commentaire(s) ou message par défaut-->
            <h4>Commentaires:</h4>
            <?php
                $responses = get_comments();
                if($responses != false){
                    foreach($responses as $response){
                        ?>
                            <blockquote>
                                <strong><?= $response->name ?> (<?= date("d/m/Y", strtotime($response->date)) ?>)</strong>
                                <p><?= nl2br($response->comment); ?></p>
                            </blockquote>
                        <?php
                    }
                }else echo "Aucun commentaire n'a été publié... Soyez le premier!";
            ?>

            <h4>Commenter:</h4>
            <!-- Vérifications en cas de tentative de poster un commentaire -->
            <?php
                // Création de variables qui correspondent aux champs du form + tableau errors pour contenir les eventuelles erreurs à afficher
                if(isset($_POST['submit'])){
                    $name = htmlspecialchars(trim($_POST['name']));
                    $email = htmlspecialchars(trim($_POST['email']));
                    $comment = htmlspecialchars(trim($_POST['comment']));
                    $errors = [];
                    // Vérification que les champs sont bien rempli
                    if(empty($name) || empty($email) || empty($comment)){
                        $errors['empty'] = "Tous les champs n'ont pas été remplis";
                    }else{
                    // Vérification sur le mail
                        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                            $errors['email'] = "L'adresse email n'est pas valide";
                        }
                    }

                    // Si erreur(s), on affiche
                    if(!empty($errors)){
                        ?>
                            <div class="card red">
                                <div class="card-content white-text">
                                    <?php
                                        foreach($errors as $error){
                                            echo $error."<br/>";
                                        }
                                    ?>
                                </div>
                            </div>
                        <?php
                    }else{
                    // sinon on valide et insère en bdd via la fonction comment
                        comment($name,$email,$comment);
                        ?>
                            <!-- redirection vers la page -->
                            <script>
                                window.location.replace("index.php?page=post&id=<?= $_GET['id'] ?>");
                            </script>
                        <?php
                    }

                }

            ?>
            <!-- formulaire pour commenter un article -->
            <form method="post">
                <div class="row">
                    <div class="input-field col s12 m6">
                        <input type="text" name="name" id="name"/>
                        <label for="name">Nom</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input type="email" name="email" id="email"/>
                        <label for="email">Adresse email</label>
                    </div>
                    <div class="input-field col s12">
                        <textarea name="comment" id="comment" class="materialize-textarea"></textarea>
                        <label for="comment">Commentaire</label>
                    </div>

                    <div class="col s12">
                        <button type="submit" name="submit" class="btn red waves-effect">
                            Commenter ce post
                        </button>
                    </div>
                </div>
            </form>