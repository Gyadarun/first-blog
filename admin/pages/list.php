<?php
if(admin()!=1){
    header("Location:index.php?page=dashboard");
}

?>
<h2>Listing des articles</h2>
<hr/>

<?php
// boucle sur les articles
$posts = get_posts();
foreach($posts as $post){
    ?>
    <!--  afficher titre plus icone cadenas si posted vaut 0 -->
    <div class="row">
        <div class="col s12">
            <h4><?= $post->title ?><?php echo ($post->posted == "0") ? "<i class='material-icons'>lock</i>" : "" ?></h4>
            <!-- aperçu -->
            <div class="row">
                <div class="col s12 m6 l8">
                    <?= substr(nl2br($post->content),0,1200) ?>...
                </div>
                <!--  image -->
                <div class="col s12 m6 l4">
                    <img src="../img/posts/<?= $post->image ?>" class="materialboxed responsive-img" alt="<?= $post->title ?>"/>
                    <br/><br/>
                    <!-- lien vers article complet -->
                    <a class="btn light-blue waves-effect waves-light" href="index.php?page=post&id=<?= $post->id ?>">Lire l'article complet</a>
                </div>
            </div>
        </div>
    </div>

    <?php
}