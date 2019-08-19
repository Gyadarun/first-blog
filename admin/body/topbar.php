<nav class="light-green">
    <div class="container">
        <div class="nav-wrapper">
            <a href="index.php" class="brand-logo">Administration</a>
            <?php
            if($page != 'login' && $page != 'new' && $page != 'password'){
                ?>
                    <a href="#" data-activates="mobile-menu" class="button-collapse"><i class="material-icons">menu</i></a>

                    <ul class="right hide-on-med-and-down">
                        <li class="<?php echo ($page=="dashboard")?"active" : ""; ?>"><a href="index.php?page=dashboard"><i class="material-icons">dashboard</i></a></li>
                        <?php
                        // si l'utilisateur est admin on affiche ces liens
                        if(admin()==1){
                            ?>
                            <!-- lien vers page pour écrire un article -->
                            <li class="<?php echo ($page=="write")?"active" : ""; ?>"><a href="index.php?page=write"><i class="material-icons">edit</i></a></li>
                            <!-- lien vers page de listing des articles -->
                            <li class="<?php echo ($page=="list")?"active" : ""; ?>"><a href="index.php?page=list"><i class="material-icons">view_list</i></a></li>
                            <?php
                        }

                        ?>
                        <!-- Lien pour retourner vers "home" -->
                        <li><a href="../index.php?page=home">Quitter</a></li>
                        <!-- Lien pour déconnexion -->
                        <li><a href="index.php?page=logout">Déconnexion</a></li>

                    </ul>

                    <ul class="side-nav" id="mobile-menu">
                        <li class="<?php echo ($page=="dashboard")?"active" : ""; ?>"><a href="index.php?page=dashboard">Tableau de bord</a></li>
                        <?php
                         // si l'utilisateur est admin on affiche ces liens
                        if(admin()==1){
                            ?>
                                  <!-- lien vers page pour écrire un article mobile -->
                                <li class="<?php echo ($page=="write")?"active" : ""; ?>"><a href="index.php?page=write">Publier un article</a></li>
                                  <!-- lien vers page de listing des articles mobile -->
                                <li class="<?php echo ($page=="list")?"active" : ""; ?>"><a href="index.php?page=list">Listing des articles</a></li>
                            <?php
                        }

                        ?>
                        <!-- Lien pour retourner vers "home" mobile -->
                        <li><a href="../index.php?page=home">Quitter</a></li>
                        <!-- Lien pour deconnexion mobile -->
                        <li><a href="index.php?page=logout">Déconnexion</a></li>

                    </ul>
                <?php
            }
            ?>
        </div>
    </div>
</nav>
