<?php
/**
 * Header: intestazione con logo e menu principale.
 */
if (!defined('ABSPATH')) {
    exit;
}
$seal = has_custom_logo()
    ? wp_get_attachment_image_url(get_theme_mod('custom_logo'), 'thumbnail')
    : get_theme_file_uri('assets/images/logo-seal.jpg');
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#top">Vai al contenuto</a>

<header class="site">
  <div class="wrap nav-row">
    <a class="wordmark" href="<?php echo esc_url(home_url('/')); ?>">
      <img class="seal" src="<?php echo esc_url($seal); ?>" alt="">
      <?php bloginfo('name'); ?>
    </a>
    <button class="nav-toggle" id="navToggle" aria-expanded="false" aria-controls="navLinks" aria-label="Apri il menu">
      <svg width="18" height="18" viewBox="0 0 18 18" aria-hidden="true"><path d="M2 5h14M2 9h14M2 13h14" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/></svg>
    </button>
    <?php
    wp_nav_menu(array(
        'theme_location'  => 'primary',
        'container'       => 'nav',
        'container_class' => 'links',
        'container_id'    => 'navLinks',
        'menu_class'      => 'menu',
        'depth'           => 1,
        'fallback_cb'     => 'tana_fallback_menu',
    ));
    ?>
  </div>
</header>
