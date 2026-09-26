<?php
/**
 * Elenco dei racconti di una categoria (Ariel, Olivia) o archivio generico.
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();

if (is_category()) {
    $info    = tana_category_info(get_queried_object());
    $eyebrow = $info['eyebrow'];
    $archive_title   = single_cat_title('', false);
    $lede    = $info['desc'];
    $empty   = $info['empty'];
} else {
    $eyebrow = 'Dalla Tana';
    $archive_title   = get_the_archive_title();
    $lede    = get_the_archive_description();
    $empty   = 'Nessun racconto trovato.';
}
?>
<main id="top">

  <section class="paths">
    <div class="wrap section-head">
      <span class="eyebrow"><?php echo esc_html($eyebrow); ?></span>
      <h1><?php echo esc_html($archive_title); ?></h1>
      <?php if ($lede) : ?><p class="lede"><?php echo wp_kses_post($lede); ?></p><?php endif; ?>
    </div>
  </section>

  <section class="category-list">
    <div class="wrap">
      <div class="story-list">
        <?php if (have_posts()) : ?>
          <?php while (have_posts()) : the_post(); get_template_part('template-parts/card', 'story'); endwhile; ?>
        <?php else : ?>
          <p class="story-list-empty"><?php echo esc_html($empty); ?></p>
        <?php endif; ?>
      </div>
      <?php the_posts_pagination(array('mid_size' => 1, 'prev_text' => '←', 'next_text' => '→')); ?>
    </div>
  </section>

</main>
<?php get_footer(); ?>
