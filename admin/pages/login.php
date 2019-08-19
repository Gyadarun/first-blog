<?php
    // Si déjà connecté en tant qu'admin, redirection auto vers la page de gestion
    if(isset($_SESSION['admin'])){
        header("Location:index.php?page=dashboard");
    }
?>

<div class="row">
    <div class="col l4 m6 s12 offset-l4 offset-m3">
        <div class="card-panel">
            <div class="row">
                <div class="col s6 offset-s3">
                   
                </div>
            </div>

            <h4 class="center-align">Se connecter</h4>
            
            <?php
                // Vérification en cas de tentative de connexion
                if(isset($_POST['submit'])){
                    // $con = new mysqli('localhost', 'root', '', 'blog');
                    $con = new mysqli('amaurylfdv1984.mysql.db', 'amaurylfdv1984', 'letaPiss84', 'amaurylfdv1984');
                    $errors = [];
                    $email = $con->real_escape_string($_POST['email']);
                    $password = $con->real_escape_string($_POST['password']);

                    $sql = $con->query("SELECT id, password FROM admins WHERE email = '$email'");
                   
                    if ($sql->num_rows > 0) {
                        $data = $sql->fetch_array();
                        if (password_verify($password, $data['password'])) {
                            // Ok, renvoi vers la page de gestion
                            $_SESSION['admin'] = $email;
                            header("Location:index.php?page=dashboard");
                        } else
                            $errors['exist']  = "Cet administrateur n'existe pas";
                    } else
                     $errors['empty'] = "Tous les champs n'ont pas été remplis!";
                     // Affichage erreurs
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
                    }
                }
            ?>
            <!-- formulaire de connexion -->
            <form method="post">
                <div class="row">
                    <div class="input-field col s12">
                        <input type="email" id="email" name="email"/>
                        <label for="email">Adresse email</label>
                    </div>

                    <div class="input-field col s12">
                        <input type="password" id="password" name="password"/>
                        <label for="password">Mot de passe</label>
                    </div>
                </div>

                <center>
                    <button type="submit" name="submit" class="waves-effect waves-light btn light-blue">
                        <i class="material-icons left">perm_identity</i>
                        Se connecter
                    </button>   
                </center>




            </form>

        </div>
    </div>
</div>