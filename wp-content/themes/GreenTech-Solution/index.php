<?php get_header(); ?>

<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <div class="hero-content">
            <h2>L'énergie verte pour votre entreprise</h2>
            <p>Réduisez vos coûts énergétiques de 40% avec nos solutions écologiques sur-mesure</p>
            <a href="#contact" class="cta-button">Demander un devis gratuit</a>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="services" id="services">
    <div class="container">
        <h2>Nos Services</h2>
        <div class="services-grid">
            <div class="service-card">
                <div class="service-icon">⚡</div>
                <h3>Audit Énergétique</h3>
                <p>Analyse complète de votre consommation pour identifier les économies potentielles</p>
            </div>
            <div class="service-card">
                <div class="service-icon">☀️</div>
                <h3>Panneaux Solaires</h3>
                <p>Installation de panneaux photovoltaïques adaptés à vos besoins</p>
            </div>
            <div class="service-card">
                <div class="service-icon">📊</div>
                <h3>Optimisation</h3>
                <p>Suivi et optimisation continue de votre consommation énergétique</p>
            </div>
        </div>
    </div>
</section>

<!-- Sidebar avec widget -->
<aside class="sidebar-widget-area">
    <div class="container">
        <?php
        if (is_active_sidebar('sidebar-1')) {
            dynamic_sidebar('sidebar-1');
        } else {
            echo '<p style="text-align: center; color: #999;">Zone pour le widget "Nos derniers projets"</p>';
        }
        ?>
    </div>
</aside>

<!-- Contact Section -->
<section class="contact" id="contact">
    <div class="container">
        <h2>Demandez votre devis gratuit</h2>
        <div class="contact-form">
            <?php echo do_shortcode('[greentech_devis]'); ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>