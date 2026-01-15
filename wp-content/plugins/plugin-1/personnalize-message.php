<?php
/**
 * Plugin Name: Personnalize Message
 * Description: A Plugin to personalize messages.
 * Version: 1.0
 * Author: Corentin
 * 
 */

// empêcher l'accès direct au fichier
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

//ajouter une page de paramètres dans le menu reglages
function pm_add_settings_page() {
        /*
        titre de la page
        titre du menu
        capacité requise
        slug de la page
        fonction de rappel pour afficher le contenu de la page 
        */
        add_options_page(
            __('parametres du message personnalise', 'message-personnalise'),
            __('Message Personnalisé', 'message-personnalise'),
            'manage_options',
            'pm-settings',
            'pm_parametres_page'
        );
}
add_action('admin_menu', 'pm_add_settings_page');

//afficher le contenu de la page de paramètres
function pm_parametres_page() {
    ?>
    <div class="wrap">
        <h1>Message personnalisé - Paramètres</h1>
        <form method="post" action="options.php">
            <?php
            //afficher les champs de paramètres
            settings_fields('pm_settings_group');
            //afficher les sections de paramètres
            do_settings_sections('pm-settings');
            //afficher le bouton de soumission
            submit_button();
            ?>                          
        </form>
    </div>
    
    <?php       
}

//initialiser les paramètres 
function pm_initialize_settings() {
    register_setting('pm_settings_group', 'pm_message');
    //ajouter une section de paramètres
    add_settings_section(
        'pm_main_section',
        __('Paramètres principaux', 'message-personnalise'),
        null,
        'pm-settings'
    );
    add_settings_field(
        'pm_message_field',
        __('Message personnalisé', 'message-personnalise'),
        'pm_render_message_field',
        'pm-settings',
        'pm_main_section'
    );  
}
add_action('admin_init', 'pm_initialize_settings');

//afficher le champ de saisie pour le message personnalisé  
function pm_render_message_field() {
    $message = get_option('pm_message');
    echo '<input type="text" name="pm_message" value="' . esc_attr($message) . '" size="50"/>'; 
}

function pm_display_message()
{
    $message = get_option('pm_message');
    if(!empty($message)) {
        return '<p>' . esc_html($message) . '</p>'; 
    }else {
        return '<p>' .esc_html__('Bienvenue sur notre site!', 'message-personnalise') . '</p>' ;
    }
}
add_shortcode('personalized_message', 'pm_display_message');
//[personalized_message]  pour afficher le message personnalisé dans les articles ou les pages 