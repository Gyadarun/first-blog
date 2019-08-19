<?php

    if(admin()!=1){
        header("Location:index.php?page=dashboard");
    }


    $post = get_post();
    // redirection si pas d'article correspondant
    if($post == false){
        header("Location:index.php?page=error");
    }

?>
    <div class="parallax-container">
        <div class="parallax">
            <img src="../img/posts/<?= $post->image ?>" alt="<?= $post->title ?>"/>
        </div>
    </div>
    <div class="container">

    <?php
        // verification sur le submit
        if(isset($_POST['submit'])){
            // variables et tableau errors
            $title = htmlspecialchars(trim($_POST['title']));
            $content = htmlspecialchars(trim($_POST['content']));
            $posted = isset($_POST['public']) ? "1" : "0";
            $errors = [];
            // vérification sur champs titre et contenu
            if(empty($title) || empty($content)){
                $errors['empty'] = "Veuillez remplir tous les champs";
            }
            // affichage des erreurs s'il y en a
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
                // validation de l'edition de l'article
                edit($title,$content,$posted,$_GET['id']);
                ?>
                    <script>
                        window.location.replace("index.php?page=post&id=<?= $_GET['id'] ?>");
                    </script>
                <?php
            }


        }


    ?>
    </div>

    <!-- formulaire d'edtion d'un article -->
    <form method="post">
        <div class="row">
            <!-- titre -->
            <div class="input-field col s12">
                <input type="text" name="title" id="title" value="<?= $post->title ?>"/>
                <label for="title">Titre de l'article</label>
            </div>
            <!-- contenu -->
            <div class="input-field col s12">
                <textarea id="content" name="content" class="materialize-textarea"><?= $post->content ?></textarea>
                <label for="content">Contenu de l'article</label>
            </div>
            <!-- switch pour visible pour tout le monde ou non -->
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
            <!-- validation -->
            <div class="col s6 right-align">
                <br/><br/>
                <button type="submit" class="btn" name="submit">Modifier l'article</button>

            </div>


        </div>



    </form>