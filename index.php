<?php
    include 'functions/main-functions.php';
    // redirection vers page correspondante, sinon page erreur, sinon home par defaut
    $pages = scandir('pages/');   
    if(isset($_GET['page']) && !empty($_GET['page'])){
        if(in_array($_GET['page'].'.php',$pages)){
            $page = $_GET['page'];
        }else{
            $page = "error";
        }
    }else{
        $page = "home";
    }
    // Si la fonction lié est la page existe, on la charge
    $pages_functions = scandir('functions/');
    if(in_array($page.'.func.php',$pages_functions)){
        include 'functions/'.$page.'.func.php';
    }

?>


<!DOCTYPE html>
<html>
    <head>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>
        <title>Bienvenue sur mon blog</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
        
    <body>
        <?php
            include "body/topbar.php";
        ?>
        <div class="container">
            <?php
                include 'pages/'.$page.'.php';
            ?>
        </div>


        <!--Import jQuery before materialize.js-->
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="js/materialize.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
        <?php
            // Charger le script js pour l'effet parrallax d'une page article
            $pages_js = scandir('js/');
            if(in_array($page.'.func.js',$pages_js)){
                ?>
                    <script type="text/javascript" src="js/<?= $page ?>.func.js"></script>
                <?php
            }

        ?>

    </body>
</html>