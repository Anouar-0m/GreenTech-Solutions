<?php
get_header();
?>
<main>
    <?php 
    //on verifie s'il y a des articles à afficher  
    if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="article">
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <p><?php the_excerpt(); ?></p>
                
            </div>
        <?php endwhile; else : ?>
            <p>Aucun article trouvé.</p>
    <?php endif; ?>
<?php
get_footer();
?>