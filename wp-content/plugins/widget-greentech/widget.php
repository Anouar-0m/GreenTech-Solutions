<?php
/**
 * Plugin Name: GreenTech Widget Projets
 * Description: Widget "Nos derniers projets" pour afficher 3 réalisations
 * Version: 1.0.0
 * Author: Sheedan Hyman
 * Text Domain: greentech-widget
 */

// Sécurité
if (!defined('ABSPATH')) {
    exit;
}

// Classe du widget
class GreenTech_Projets_Widget extends WP_Widget {
    
    public function __construct() {
        parent::__construct(
            'greentech_projets_widget',
            __('GreenTech - Nos Projets', 'greentech-widget'),
            array('description' => __('Affiche les 3 derniers projets de GreenTech', 'greentech-widget'))
        );
    }
    
    // Affichage du widget côté front-end
    public function widget($args, $instance) {
        echo $args['before_widget'];
        
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }
        
        // Récupération des projets
        $projet1_titre = !empty($instance['projet1_titre']) ? $instance['projet1_titre'] : '';
        $projet1_desc = !empty($instance['projet1_desc']) ? $instance['projet1_desc'] : '';
        
        $projet2_titre = !empty($instance['projet2_titre']) ? $instance['projet2_titre'] : '';
        $projet2_desc = !empty($instance['projet2_desc']) ? $instance['projet2_desc'] : '';
        
        $projet3_titre = !empty($instance['projet3_titre']) ? $instance['projet3_titre'] : '';
        $projet3_desc = !empty($instance['projet3_desc']) ? $instance['projet3_desc'] : '';
        
        ?>
        <div class="greentech-projets-widget">
            <style>
                .greentech-projets-widget {
                    display: grid;
                    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                    gap: 2rem;
                }
                .projet-item {
                    background: #f8f9fa;
                    padding: 1.5rem;
                    border-radius: 12px;
                    border-left: 4px solid #4a7c2c;
                }
                .projet-item h4 {
                    color: #2d5a27;
                    margin-bottom: 0.5rem;
                    font-size: 1.2rem;
                }
                .projet-item p {
                    color: #636e72;
                    font-size: 0.95rem;
                    line-height: 1.6;
                }
            </style>
            
            <?php if ($projet1_titre) : ?>
            <div class="projet-item">
                <h4><?php echo esc_html($projet1_titre); ?></h4>
                <p><?php echo esc_html($projet1_desc); ?></p>
            </div>
            <?php endif; ?>
            
            <?php if ($projet2_titre) : ?>
            <div class="projet-item">
                <h4><?php echo esc_html($projet2_titre); ?></h4>
                <p><?php echo esc_html($projet2_desc); ?></p>
            </div>
            <?php endif; ?>
            
            <?php if ($projet3_titre) : ?>
            <div class="projet-item">
                <h4><?php echo esc_html($projet3_titre); ?></h4>
                <p><?php echo esc_html($projet3_desc); ?></p>
            </div>
            <?php endif; ?>
        </div>
        <?php
        
        echo $args['after_widget'];
    }
    
    // Formulaire de configuration dans l'admin
    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : __('Nos Derniers Projets', 'greentech-widget');
        
        // Projet 1
        $projet1_titre = !empty($instance['projet1_titre']) ? $instance['projet1_titre'] : '';
        $projet1_desc = !empty($instance['projet1_desc']) ? $instance['projet1_desc'] : '';
        
        // Projet 2
        $projet2_titre = !empty($instance['projet2_titre']) ? $instance['projet2_titre'] : '';
        $projet2_desc = !empty($instance['projet2_desc']) ? $instance['projet2_desc'] : '';
        
        // Projet 3
        $projet3_titre = !empty($instance['projet3_titre']) ? $instance['projet3_titre'] : '';
        $projet3_desc = !empty($instance['projet3_desc']) ? $instance['projet3_desc'] : '';
        ?>
        
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">
                <?php _e('Titre du widget:', 'greentech-widget'); ?>
            </label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" 
                   name="<?php echo $this->get_field_name('title'); ?>" type="text" 
                   value="<?php echo esc_attr($title); ?>">
        </p>
        
        <hr>
        <h4><?php _e('Projet 1', 'greentech-widget'); ?></h4>
        
        <p>
            <label for="<?php echo $this->get_field_id('projet1_titre'); ?>">
                <?php _e('Titre:', 'greentech-widget'); ?>
            </label>
            <input class="widefat" id="<?php echo $this->get_field_id('projet1_titre'); ?>" 
                   name="<?php echo $this->get_field_name('projet1_titre'); ?>" type="text" 
                   value="<?php echo esc_attr($projet1_titre); ?>">
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id('projet1_desc'); ?>">
                <?php _e('Description:', 'greentech-widget'); ?>
            </label>
            <textarea class="widefat" id="<?php echo $this->get_field_id('projet1_desc'); ?>" 
                      name="<?php echo $this->get_field_name('projet1_desc'); ?>" rows="3"><?php echo esc_textarea($projet1_desc); ?></textarea>
        </p>
        
        <hr>
        <h4><?php _e('Projet 2', 'greentech-widget'); ?></h4>
        
        <p>
            <label for="<?php echo $this->get_field_id('projet2_titre'); ?>">
                <?php _e('Titre:', 'greentech-widget'); ?>
            </label>
            <input class="widefat" id="<?php echo $this->get_field_id('projet2_titre'); ?>" 
                   name="<?php echo $this->get_field_name('projet2_titre'); ?>" type="text" 
                   value="<?php echo esc_attr($projet2_titre); ?>">
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id('projet2_desc'); ?>">
                <?php _e('Description:', 'greentech-widget'); ?>
            </label>
            <textarea class="widefat" id="<?php echo $this->get_field_id('projet2_desc'); ?>" 
                      name="<?php echo $this->get_field_name('projet2_desc'); ?>" rows="3"><?php echo esc_textarea($projet2_desc); ?></textarea>
        </p>
        
        <hr>
        <h4><?php _e('Projet 3', 'greentech-widget'); ?></h4>
        
        <p>
            <label for="<?php echo $this->get_field_id('projet3_titre'); ?>">
                <?php _e('Titre:', 'greentech-widget'); ?>
            </label>
            <input class="widefat" id="<?php echo $this->get_field_id('projet3_titre'); ?>" 
                   name="<?php echo $this->get_field_name('projet3_titre'); ?>" type="text" 
                   value="<?php echo esc_attr($projet3_titre); ?>">
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id('projet3_desc'); ?>">
                <?php _e('Description:', 'greentech-widget'); ?>
            </label>
            <textarea class="widefat" id="<?php echo $this->get_field_id('projet3_desc'); ?>" 
                      name="<?php echo $this->get_field_name('projet3_desc'); ?>" rows="3"><?php echo esc_textarea($projet3_desc); ?></textarea>
        </p>
        
        <?php
    }
    
    // Sauvegarde des options
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
        
        $instance['projet1_titre'] = (!empty($new_instance['projet1_titre'])) ? sanitize_text_field($new_instance['projet1_titre']) : '';
        $instance['projet1_desc'] = (!empty($new_instance['projet1_desc'])) ? sanitize_textarea_field($new_instance['projet1_desc']) : '';
        
        $instance['projet2_titre'] = (!empty($new_instance['projet2_titre'])) ? sanitize_text_field($new_instance['projet2_titre']) : '';
        $instance['projet2_desc'] = (!empty($new_instance['projet2_desc'])) ? sanitize_textarea_field($new_instance['projet2_desc']) : '';
        
        $instance['projet3_titre'] = (!empty($new_instance['projet3_titre'])) ? sanitize_text_field($new_instance['projet3_titre']) : '';
        $instance['projet3_desc'] = (!empty($new_instance['projet3_desc'])) ? sanitize_textarea_field($new_instance['projet3_desc']) : '';
        
        return $instance;
    }
}

// Enregistrement du widget
function greentech_register_projets_widget() {
    register_widget('GreenTech_Projets_Widget');
}
add_action('widgets_init', 'greentech_register_projets_widget');