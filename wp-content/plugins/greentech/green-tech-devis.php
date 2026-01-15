<?php
/**
 * Plugin Name: GreenTech Demandes de Devis
 * Description: Plugin personnalisé pour gérer les demandes de devis GreenTech Solutions
 * Version: 1.0.0
 * Author: Sheedan Hyman
 * Text Domain: greentech-devis
 */

// Sécurité : empêcher l'accès direct
if (!defined('ABSPATH')) {
    exit;
}

// Création de la table lors de l'activation
function greentech_devis_activate() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'greentech_devis';
    $charset_collate = $wpdb->get_charset_collate();
    
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        nom varchar(100) NOT NULL,
        email varchar(100) NOT NULL,
        entreprise varchar(150) DEFAULT '',
        telephone varchar(20) DEFAULT '',
        message text NOT NULL,
        date_soumission datetime DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY  (id)
    ) $charset_collate;";
    
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
register_activation_hook(__FILE__, 'greentech_devis_activate');

// Shortcode pour afficher le formulaire
function greentech_devis_form_shortcode() {
    ob_start();
    
    // Traitement du formulaire
    if (isset($_POST['greentech_devis_submit'])) {
        greentech_devis_process_form();
    }
    ?>
    
    <form method="post" action="" id="greentech-devis-form">
        <?php wp_nonce_field('greentech_devis_action', 'greentech_devis_nonce'); ?>
        
        <input type="text" name="nom" placeholder="Nom *" required>
        
        <input type="email" name="email" placeholder="Email *" required>
        
        <input type="text" name="entreprise" placeholder="Entreprise">
        
        <input type="tel" name="telephone" placeholder="Téléphone">
        
        <textarea name="message" rows="5" placeholder="Votre message *" required></textarea>
        
        <button type="submit" name="greentech_devis_submit">Envoyer ma demande</button>
    </form>
    
    <?php
    return ob_get_clean();
}
add_shortcode('greentech_devis', 'greentech_devis_form_shortcode');

// Traitement du formulaire
function greentech_devis_process_form() {
    // Vérification du nonce
    if (!isset($_POST['greentech_devis_nonce']) || 
        !wp_verify_nonce($_POST['greentech_devis_nonce'], 'greentech_devis_action')) {
        return;
    }
    
    global $wpdb;
    $table_name = $wpdb->prefix . 'greentech_devis';
    
    // Récupération et nettoyage des données
    $nom = sanitize_text_field($_POST['nom']);
    $email = sanitize_email($_POST['email']);
    $entreprise = sanitize_text_field($_POST['entreprise']);
    $telephone = sanitize_text_field($_POST['telephone']);
    $message = sanitize_textarea_field($_POST['message']);
    
    // Insertion dans la base de données
    $wpdb->insert(
        $table_name,
        array(
            'nom' => $nom,
            'email' => $email,
            'entreprise' => $entreprise,
            'telephone' => $telephone,
            'message' => $message
        ),
        array('%s', '%s', '%s', '%s', '%s')
    );
    
    // Message de confirmation
    echo '<div style="background: #d4edda; color: #155724; padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
            Merci ! Votre demande a été envoyée avec succès. Nous vous contacterons rapidement.
          </div>';
}

// Ajout du menu dans l'admin
function greentech_devis_admin_menu() {
    add_menu_page(
        __('Demandes de Devis', 'greentech-devis'),
        __('Devis', 'greentech-devis'),
        'view_devis', // Capacité personnalisée
        'greentech-devis',
        'greentech_devis_admin_page',
        'dashicons-email',
        26
    );
}
add_action('admin_menu', 'greentech_devis_admin_menu');

// Permettre aux commerciaux de voir les devis
function greentech_add_devis_capability() {
    $commercial = get_role('commercial');
    if ($commercial) {
        $commercial->add_cap('view_devis');
    }
    
    $admin = get_role('administrator');
    if ($admin) {
        $admin->add_cap('view_devis');
    }
}
add_action('admin_init', 'greentech_add_devis_capability');

// Page d'administration
function greentech_devis_admin_page() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'greentech_devis';
    
    // Suppression d'un devis
    if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $wpdb->delete($table_name, array('id' => $id), array('%d'));
        echo '<div class="notice notice-success"><p>Demande supprimée avec succès.</p></div>';
    }
    
    // Récupération des demandes
    $demandes = $wpdb->get_results("SELECT * FROM $table_name ORDER BY date_soumission DESC");
    
    ?>
    <div class="wrap">
        <h1><?php _e('Demandes de Devis', 'greentech-devis'); ?></h1>
        
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Entreprise</th>
                    <th>Téléphone</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($demandes) : ?>
                    <?php foreach ($demandes as $demande) : ?>
                        <tr>
                            <td><?php echo $demande->id; ?></td>
                            <td><?php echo esc_html($demande->nom); ?></td>
                            <td><a href="mailto:<?php echo esc_attr($demande->email); ?>"><?php echo esc_html($demande->email); ?></a></td>
                            <td><?php echo esc_html($demande->entreprise); ?></td>
                            <td><?php echo esc_html($demande->telephone); ?></td>
                            <td><?php echo esc_html(substr($demande->message, 0, 50)) . '...'; ?></td>
                            <td><?php echo date('d/m/Y H:i', strtotime($demande->date_soumission)); ?></td>
                            <td>
                                <a href="?page=greentech-devis&action=delete&id=<?php echo $demande->id; ?>" 
                                   onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette demande ?');" 
                                   class="button button-small">
                                    Supprimer
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="8" style="text-align: center;">Aucune demande de devis pour le moment.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php
}