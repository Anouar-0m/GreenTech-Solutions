<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Header -->
<header class="site-header">
    <div class="container">
        <div class="logo">
            <h1>
                <a href="<?php echo esc_url(home_url('/')); ?>" style="color: white; text-decoration: none;">
                    🌱 <?php bloginfo('name'); ?>
                </a>
            </h1>
        </div>
        <nav class="main-nav">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'menu-principal',
                'menu_id'        => 'primary-menu',
                'container'      => false,
                'fallback_cb'    => false,
            ));
            ?>
        </nav>
    </div>
</header>

<?php 
// Hook personnalisé après le header
greentech_after_header(); 
?>
