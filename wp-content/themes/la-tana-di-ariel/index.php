<?php
/**
 * Template di riserva (elenco articoli, risultati di ricerca).
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();
?>
<main id="top">

  <section class="paths">
    <div class="wrap section-head">
      <span class="eyebrow">Dalla Tana</span>
      <h1><?php echo is_search() ? 'Risultati per «' . esc_html(get_search_query()) . '»' : 'Tutti i racconti'; ?></h1>
    </div>
  </section>

  <section class="category-list">
    <div class="wrap">
      <div class="story-list">
        <?php if (have_posts()) : ?>
          <?php while (have_posts()) : the_post(); get_template_part('template-parts/card', 'story'); endwhile; ?>
        <?php else : ?>
          <p class="story-list-empty">Non abbiamo trovato nulla. Prova con un'altra parola.</p>
        <?php endif; ?>
      </div>
      <?php the_posts_pagination(array('mid_size' => 1, 'prev_text' => '←', 'next_text' => '→')); ?>
    </div>
  </section>

</main>
<?php get_footer(); ?>
