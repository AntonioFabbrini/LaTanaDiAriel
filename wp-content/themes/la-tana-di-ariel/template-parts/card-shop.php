<?php
/**
 * Card di un oggetto della Bottega.
 */
if (!defined('ABSPATH')) {
    exit;
}
?>
<article <?php post_class('shop-card'); ?>>
  <a href="<?php the_permalink(); ?>">
    <?php if (has_post_thumbnail()) : ?>
      <?php the_post_thumbnail('tana-card', array('class' => 'shop-card-image', 'alt' => '')); ?>
    <?php else : ?>
      <div class="shop-card-placeholder"><?php echo tana_icon('bottega'); // phpcs:ignore ?></div>
    <?php endif; ?>
    <div class="shop-card-body">
      <h3><?php the_title(); ?></h3>
      <?php if (has_excerpt() || get_the_content()) : ?>
        <p class="teaser"><?php echo esc_html(wp_strip_all_tags(get_the_excerpt())); ?></p>
      <?php endif; ?>
      <span class="story-cta">Scopri di più →</span>
    </div>
  </a>
</article>
