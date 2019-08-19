<?php
if(admin()!=1){
    header("Location:index.php?page=dashboard");
}

?>

<h2>Poster un article</h2>

<?php
    // Si validation de publier
    if(isset($_POST['post'])){
        // déclaration des variables
        $title = htmlspecialchars(trim($_POST['title']));
        $content = htmlspecialchars(trim($_POST['content']));
        $posted = isset($_POST['public']) ? "1" : "0";
        // déclaration d'un tableau vide pour contenir les erreurs
        $errors = [];
        // vérification sur titre et contenu
        if(empty($title) || empty($content)){
            $errors['empty'] = "Veuillez remplir tous les champs";
        }
        // vérification du format d'image si il y en a
        if(!empty($_FILES['image']['name'])){
            $file = $_FILES['image']['name'];
            $extensions = ['.png','.jpg','.jpeg','.gif','.PNG','.JPG','.JPEG','.GIF'];
            $extension = strrchr($file,'.');
            // si l'extension du fichier est différente de ceux-là, ca ne passe pas
            if(!in_array($extension,$extensions)){
                $errors['image'] = "Cette image n'est pas valable";
            }
        }
        // affichage des erreurs si il y en a
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
           // insertion en bdd de l'article et de l'image
            post($title,$content,$posted);
            if(!empty($_FILES['image']['name'])){
                post_img($_FILES['image']['tmp_name'], $extension);
            }else{
            // retour à l'article
                $id = $db->lastInsertId();
                header("Location:index.php?page=post&id=".$id);
            }
        }
    }


?>

<!-- Formulaire de la page pour écrire et poster un article -->
<form method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="input-field col s12">
            <input type="text" name="title" id="title"/>
            <label for="title">Titre de l'article</label>
        </div>

        <div class="input-field col s12">
            <textarea name="content" id="content" class="materialize-textarea"></textarea>
            <label for="content">Contenu de l'article</label>
        </div>
        <!-- image de l'article à upload -->
        <div class="col s12">
            <div class="input-field file-field">
                <div class="btn col s2">
                    <span>Image de l'article</span>
                    <input type="file" name="image" class="col s12"/>
                </div>
                <input type="text" class="file-path col s10" readonly/>
            </div>
        </div>
        <!-- Article visible ou non pour les visiteurs une fois posté -->
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
            <button class="btn" type="submit" name="post">Publier</button>
        </div>

    </div>



</form>