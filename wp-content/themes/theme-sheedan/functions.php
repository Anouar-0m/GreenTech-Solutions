<?php 

/**
 * Enqueue styles for the theme.
 */

function tresor_theme_enqueue_styles() {
    wp_enqueue_style( 'tresor-theme-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'tresor_theme_enqueue_styles' );

/**
 * 
 * menu-principal
 * @return void
 *
 */

function sheedan_menu_setup() {
    register_nav_menus( array(
        'menu-principal' => "Menu Principal du theme Sheedan",
    ) );
}



add_action( 'after_setup_theme', 'sheedan_menu_setup' );

/** 
 
*menu-footer
*@return void

*/

function sheedan_menu_footer_setup() {
    register_nav_menus( array(
        'menu-footer' => "Menu Footer du theme Sheedan",
    ) );
}

add_action( 'after_setup_theme', 'sheedan_menu_footer_setup' );