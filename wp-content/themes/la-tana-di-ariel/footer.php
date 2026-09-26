<?php
/**
 * Footer.
 */
if (!defined('ABSPATH')) {
    exit;
}
?>
<footer>
  <div class="wrap footer-top">
    <div>
      <span class="eyebrow">Resta nella Tana</span>
      <h2>La newsletter arriva presto</h2>
      <p class="lede footer-note">Nel frattempo, la Tana cresce una storia alla volta.</p>
    </div>
    <?php if (is_active_sidebar('footer-newsletter')) : ?>
      <div class="subscribe"><?php dynamic_sidebar('footer-newsletter'); ?></div>
    <?php endif; ?>
  </div>
  <div class="wrap footer-bottom">
    <span class="signature">Con affetto, Linda, Antonio e Ariel</span>
    <?php
    wp_nav_menu(array(
        'theme_location' => 'footer',
        'container'      => 'nav',
        'menu_class'     => 'menu',
        'depth'          => 1,
        'fallback_cb'    => 'tana_fallback_menu',
    ));
    ?>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
