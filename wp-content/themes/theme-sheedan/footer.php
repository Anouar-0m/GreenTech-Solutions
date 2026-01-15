  <footer class="footer">
      <p>
            <strong>Petit Trésor</strong>
            <span>Made in france & Ecoresponsable |  &copy; <?php echo date("Y"); ?> </span>      
      </p>
      
            <?php
             wp_nav_menu(array(
                        'theme_location' => 'menu-footer',
                        'menu_id'        => 'footer-menu',
                        "container"      => false,
                        "menu_class"     => "footer-nav",
                        "container_aria_label" => "Navigation de pied de page",
                  ));
            ?>
     
      <nav>
    <ul class="footer-links">
        <li><a href="#">Mentions légales</a></li>
        <li><a href="#">Sitemap</a></li>
        <li><a href="#">Politique de confidentialité</a></li>
    </ul>
    <p>© 2026 Petit Trésor – Tous droits réservés</p>

</footer>
</nav>
<?php wp_footer(); ?>
</body>

</html>
 