<h2>Blog</h2>

<?php
// affichage des articles de la page blog
$posts = get_posts();
foreach($posts as $post){
    ?>
    <!-- affichage du titre -->
    <div class="row">
        <div class="col s12 m12 l12">
            <h4><?= $post->title ?></h4>
            <!--  affichage aperçu de l'article-->
            <div class="row">
                <div class="col s12 m6 l8">
                    <?= substr(nl2br($post->content),0,1200) ?>...
                </div>
                <!-- image + lien vers l'article -->
                <div class="col s12 m6 l4">
                    <img src="img/posts/<?= $post->image ?>" class="materialboxed responsive-img" alt="<?= $post->title ?>"/>
                    <br/><br/>
                    <a class="btn red waves-effect waves-light" href="index.php?page=post&id=<?= $post->id ?>">Lire l'article complet</a>
                </div>
            </div>
        </div>
    </div>

    <?php
}
