<?php
get_header();
?>
<main>
    <?php 
    //on verifie s'il y a des articles à afficher  
    if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article class="article">
                <h2><?php the_title(); ?></h2>
                <?php the_content(); ?>
                
            </article>
        <?php endwhile; else : ?>
            <p>la page rechercher n'existe pas.</p>
    <?php endif; ?> 



</main>
<?php   
get_footer();   
?>