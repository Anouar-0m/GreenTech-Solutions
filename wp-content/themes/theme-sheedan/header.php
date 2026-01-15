<!DOCTYPE html>
<html lang="<?php language_attributes(); ?>">

<head>
      <meta charset="<?php bloginfo('charset'); ?>">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title><?php wp_get_document_title(); ?></title>
      <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
      <header>
            <nav class="nav">
                  <?php
                  wp_nav_menu(array(
                        'theme_location' => 'menu-principal',
                        'menu_id'        => 'primary-menu',
                        "container"      => false,
                  ));
                  ?>
            <ul class="menu">
                <li><a href="index.html" class="active">Accueil</a></li>
                <li><a href="valeurs.html">Nos valeurs</a></li>
                <li class="has-submenu">
                    <a href="#">Articles</a>
                    <ul class="submenu">
                        <li><a href="vetements.html">Vêtements</a></li>
                        <li><a href="jouets.html">Jouets</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
      </header>