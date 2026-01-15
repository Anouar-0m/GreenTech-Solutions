<?php 



function new_theme_enqueue_styles() {
    wp_enqueue_style( 'style',get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'new_theme_enqueue_styles' );

//chapitre sur les hooks
//actions: Executer une fonction à un moment précis 
//filters: Modifier des données de les afficher ou de les enregistrer   

function modify_article_title($title) {
    return "*" . $title . "*";  
}
add_filter('the_title', 'modify_article_title');
//si on veut supprimer le filtre    
remove_filter('the_title', 'modify_article_title');


function merci_lire_suite($link) {
    return $link . "<p>Merci de votre lecture</p>   ";

}
add_filter('the_excerpt', 'merci_lire_suite');
//si on veut supprimer le filtre   
remove_filter('the_excerpt', 'merci_lire_suite');
//shortcode : creer des codes courts pour inserer du contenu dynamique dans les articles ou les pages   
function year_shortcode() {
    return date("Y");
}
add_shortcode('year', 'year_shortcode');
//bouton personnaliser 
function custom_button_($atts){
    $atts = shortcode_atts(
        array(
            'url' => '#',
            'text' => 'Cliquez ici',
            "color" => "blue"
         ), $atts, // infos fournies par l'utilisateur  
         );
         /*esc_url: securiser les url pour eviter les attaques de type XSS
            esc_attr: securiser les attributs html
            esc_html: securiser le texte pour eviter l'injection de code malveillant    
            */
         return '<a href="' . esc_url($atts['url']) . '"class="btn" style="background:' . esc_attr($atts['color']) . ';">' . esc_html($atts['text']) . '</a>';
    
}
add_shortcode('button', 'custom_button_');
// Shortcode pour les icônes sociales

function custom_social_icons($atts)
{
    $atts = shortcode_atts(
        array(
            'facebook' => '#',
            'twitter' => '#',
            'instagram' => '#'
        ),
        $atts,
        'social_icons'
    );

    /*
    esc_url : sécuriser l'URL pour eviter les failles XSS
    Le HTML est généré directement car les classes et structures sont contrôlées
    */

    $html = '<div class="social-icons">';

    if (!empty($atts['facebook'])) {
        $html .= '<a href="' . esc_url($atts['facebook']) . '" class="social-icon facebook" target="_blank" rel="noopener">
            <i class="fab fa-facebook"></i>
        </a>';
    }

    if (!empty($atts['twitter'])) {
        $html .= '<a href="' . esc_url($atts['twitter']) . '" class="social-icon twitter" target="_blank" rel="noopener">
            <i class="fab fa-twitter"></i>
        </a>';
    }

    if (!empty($atts['instagram'])) {
        $html .= '<a href="' . esc_url($atts['instagram']) . '" class="social-icon instagram" target="_blank" rel="noopener">
            <i class="fab fa-instagram"></i>
        </a>';
    }

    $html .= '</div>';

    return $html;
}
add_shortcode('social_icons', 'custom_social_icons');
function enqueue_fontawesome()
{
    wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');
}
add_action('wp_enqueue_scripts', 'enqueue_fontawesome');


function shortcode_date_heure_fr($atts) {
    // Paramètres par défaut
    $atts = shortcode_atts(
        array(
            'format' => 'complet', // Options: complet, court, date, heure
        ),
        $atts
    );
    
    // Obtenir le timestamp WordPress
    $timestamp = current_time('timestamp');
    
    // Tableaux de traduction en français
    $jours = array(
        'Sunday' => 'dimanche',
        'Monday' => 'lundi',
        'Tuesday' => 'mardi',
        'Wednesday' => 'mercredi',
        'Thursday' => 'jeudi',
        'Friday' => 'vendredi',
        'Saturday' => 'samedi'
    );
    
    $mois = array(
        'January' => 'janvier',
        'February' => 'février',
        'March' => 'mars',
        'April' => 'avril',
        'May' => 'mai',
        'June' => 'juin',
        'July' => 'juillet',
        'August' => 'août',
        'September' => 'septembre',
        'October' => 'octobre',
        'November' => 'novembre',
        'December' => 'décembre'
    );
    
    // Récupérer les éléments de date
    $jour_semaine = $jours[date('l', $timestamp)];
    $jour = date('j', $timestamp);
    $mois_nom = $mois[date('F', $timestamp)];
    $annee = date('Y', $timestamp);
    $heure = date('H:i', $timestamp);
    
    // Choisir le format
    switch($atts['format']) {
        case 'court':
            $resultat = date('d/m/Y H:i', $timestamp);
            break;
        case 'date':
            $resultat = $jour_semaine . ' ' . $jour . ' ' . $mois_nom . ' ' . $annee;
            break;
        case 'heure':
            $resultat = $heure;
            break;
        case 'complet':
        default:
            $resultat = $jour_semaine . ' ' . $jour . ' ' . $mois_nom . ' ' . $annee . ' à ' . $heure;
            break;
    }
    
    return '<span class="date-heure-fr">' . $resultat . '</span>';
}

add_shortcode('date_heure_fr', 'shortcode_date_heure_fr');

//
function remove_dashborad_widgets() {
    if(!current_user_can('administrator')) {
        remove_meta_box('dashboard_quick_press', 'dashboard', 'side'); // Brouillon rapide
        remove_meta_box('dashboard_primary', 'dashboard', 'side'); // Nouvelles WordPress   
        remove_meta_box('dashboard_secondary', 'dashboard', 'normal'); // Autres nouvelles WordPress
        }
}
add_action('wp_dashboard_setup', 'remove_dashborad_widgets');   

function new_role(){
    add_role('sheedan','Monsieur Sheedan', array(
        
        'edit_posts' => true,
        'delete_posts' => true,
        'edit_page' => true,
        'edit_published_pages' => true,
        'upload_files' => true,
        'edit_themes' => false,
        'install_themes' => false,
        'switch_themes' => false,
        'edit_plugins' => false,
        'install_plugins' => false,
        'activate_plugins' => false,
        'delete_plugins' => false,
        'update_plugins' => false,
        'update_themes' => false,
    )); 
}
add_action('init', 'new_role');

function remove_menus() {
    if (current_user_can('sheedan')) {
        remove_menu_page('tools.php'); // Outils
        remove_menu_page('options-general.php'); // Réglages
        remove_menu_page('edit-comments.php'); // commentaires
        remove_menu_page('plugins.php'); //plugins
    }
}
add_action('admin_menu', 'remove_menus');

function remove_roles() {
    remove_role('subscriber');
    remove_role('contributor');
    remove_role('author');
    remove_role('editor');

}
add_action('init', 'remove_roles');