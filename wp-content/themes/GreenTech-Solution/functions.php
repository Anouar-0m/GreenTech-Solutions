<?php
/**
 * Fonctions du thème GreenTech Solutions
 */

// Enregistrement des menus
function greentech_menus_setup() {
    register_nav_menus(array(
        'menu-principal' => __('Menu Principal', 'greentech'),
        'menu-footer' => __('Menu Footer', 'greentech')
    ));
}
add_action('after_setup_theme', 'greentech_menus_setup');

// Support des fonctionnalités WordPress
function greentech_theme_support() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
}
add_action('after_setup_theme', 'greentech_theme_support');

// Enregistrement de la zone de widget
function greentech_widgets_init() {
    register_sidebar(array(
        'name'          => __('Zone Sidebar', 'greentech'),
        'id'            => 'sidebar-1',
        'description'   => __('Zone pour le widget "Nos derniers projets"', 'greentech'),
        'before_widget' => '<div class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'greentech_widgets_init');

// Hook personnalisé après le header
function greentech_after_header() {
    do_action('greentech_after_header');
}

// Affichage du bandeau promotionnel
function greentech_display_promo_banner() {
    $promo_text = get_option('greentech_promo_banner', 'OFFRE SPÉCIALE : Audit énergétique gratuit jusqu\'au 31 mars');
    if (!empty($promo_text)) {
        echo '<div class="promo-banner">' . esc_html($promo_text) . '</div>';
    }
}
add_action('greentech_after_header', 'greentech_display_promo_banner');

// Ajout de la page d'options dans l'admin
function greentech_add_admin_menu() {
    add_menu_page(
        __('Options GreenTech', 'greentech'),
        __('GreenTech', 'greentech'),
        'edit_theme_options',
        'greentech-options',
        'greentech_options_page',
        'dashicons-admin-settings',
        65
    );
}
add_action('admin_menu', 'greentech_add_admin_menu');

// Page d'options
function greentech_options_page() {
    ?>
    <div class="wrap">
        <h1><?php _e('Options GreenTech Solutions', 'greentech'); ?></h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('greentech_options_group');
            do_settings_sections('greentech-options');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Enregistrement des settings
function greentech_settings_init() {
    register_setting('greentech_options_group', 'greentech_promo_banner');
    
    add_settings_section(
        'greentech_promo_section',
        __('Bandeau Promotionnel', 'greentech'),
        'greentech_promo_section_callback',
        'greentech-options'
    );
    
    add_settings_field(
        'greentech_promo_banner',
        __('Texte du bandeau', 'greentech'),
        'greentech_promo_banner_callback',
        'greentech-options',
        'greentech_promo_section'
    );
}
add_action('admin_init', 'greentech_settings_init');

function greentech_promo_section_callback() {
    echo '<p>' . __('Configurez le texte du bandeau promotionnel affiché sous le header.', 'greentech') . '</p>';
}

function greentech_promo_banner_callback() {
    $value = get_option('greentech_promo_banner', 'OFFRE SPÉCIALE : Audit énergétique gratuit jusqu\'au 31 mars');
    echo '<input type="text" name="greentech_promo_banner" value="' . esc_attr($value) . '" style="width: 100%; max-width: 600px;" />';
}

// Création du rôle Commercial
function greentech_add_commercial_role() {
    $commercial = get_role('commercial');
    
    if (!$commercial) {
        add_role(
            'commercial',
            __('Commercial', 'greentech'),
            array(
                'read' => true,
                'edit_theme_options' => true, // Pour modifier le bandeau
                'view_devis' => true, // Capacité personnalisée pour voir les devis
            )
        );
    }
}
add_action('init', 'greentech_add_commercial_role');

// Charger les styles
function greentech_enqueue_styles() {
    wp_enqueue_style('greentech-style', get_stylesheet_uri(), array(), '1.0.0');
}
add_action('wp_enqueue_scripts', 'greentech_enqueue_styles');