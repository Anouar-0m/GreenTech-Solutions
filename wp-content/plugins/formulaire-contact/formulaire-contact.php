<?php

/**
 * Plugin Name: Formulaire de Contact
 * Description: Un plugin pour ajouter un formulaire de contact simple.
 * Version: 1.0
 * 
 */

// empêcher l'accès direct au fichier
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

//afficher du formulaire de contact
function display_form(){
    ob_start(); //démarrer la mise en mémoire tampon de sortie
    ?>
    <form method="post" action="">
        <?php
        //genere un champ secu caché pour verifier que le formulaire. Pour protéger contre les attaques CSRF
        wp_nonce_field('fc_form_nonce_action', 'fc_form_nonce_field');
        ?>
        <p>
            <label for="fc_name">Nom:</label>
            <input type="text" id="fc_name" name="fc_name" required>
        </p>
        <p>
            <label for="fc_email">Email:</label>
            <input type="email" id="fc_email" name="fc_email" required>
        </p>
        <p>
            <label for="fc_message">Message:</label>
            <textarea id="fc_message" name="fc_message" required></textarea>
        </p>
        <p>
            <input type="submit" name="fc_submit" value="Envoyer">
        </p>
    </form>
    <?php
    return ob_get_clean(); //retourner le contenu mis en mémoire tampon et nettoyer la mémoire tampon                                               
}
add_shortcode('mon-joli-formulaire', 'display_form');
//traiter le formulaire de contact
function treatment_form(){
    if(isset($_POST['fc_submit'])){
        //verifie si le formulaire est envoyé 
        //verifie le nonce pour la securité
        if(!isset($_POST['fc_form_nonce']) ){
            echo "Erreur de sécurité. Veuillez réessayer.";
            exit;
        }
        //nettoyage
        $nom = sanitize_text_field($_POST['fc_name']);                      
        $email = sanitize_email($_POST['fc_email']);
        $message = sanitize_textarea_field($_POST['fc_message']);

        //envoyer l'email
        $to = get_option('admin_email'); //envoyer au mail
        $subject = "Nouveau message de contact de " . $nom;
        $headers = array('Content-Type: text/plain; charset=UTF-8', 'From: ' . $nom . ' <' . $email . '>');

        $body = '<h2>Nouveau message de contact</h2>';
        $body .= "<strong>Nom:</strong> " . $nom . "<br>";
        $body .= "<strong>Email:</strong> " . $email . "<br>";
        $body .= "<strong>Message:</strong> " . $message . "<br>";
        wp_mail($to, $subject, $body, $headers);
        echo "<p>Merci pour votre message. Nous vous contacterons bientôt.</p>";
    }
}
add_action('wp_head', 'treatment_form');

