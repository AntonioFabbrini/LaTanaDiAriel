<?php
/**
 * Card di un racconto (usata negli elenchi per categoria).
 */
if (!defined('ABSPATH')) {
    exit;
}
?>
<article <?php post_class('story-card'); ?>>
  <a href="<?php the_permalink(); ?>">
    <?php if (has_post_thumbnail()) : ?>
      <?php the_post_thumbnail('tana-card', array('class' => 'story-card-image', 'alt' => '')); ?>
    <?php else : ?>
      <div class="story-card-placeholder"><?php echo tana_icon(tana_icon_key_for(get_the_ID())); // phpcs:ignore ?></div>
    <?php endif; ?>
    <div class="story-card-body">
      <h3><?php the_title(); ?></h3>
      <?php if (has_excerpt() || get_the_content()) : ?>
        <p class="teaser"><?php echo esc_html(wp_strip_all_tags(get_the_excerpt())); ?></p>
      <?php endif; ?>
      <span class="story-cta">Leggi il racconto →</span>
    </div>
  </a>
</article>
