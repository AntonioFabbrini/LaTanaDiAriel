<?php
/**
 * La Bottega: vetrina degli oggetti fatti a mano.
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();
?>
<main id="top">

  <section class="paths">
    <div class="wrap section-head">
      <span class="eyebrow">Oggettistica handmade</span>
      <h1>La Bottega</h1>
      <p class="lede">Oggetti fatti a mano, uno alla volta — ognuno porta con sé il racconto di dove è nato: viaggio, scoperta, oggetto, ricordo.</p>
    </div>
  </section>

  <section class="category-list">
    <div class="wrap">
      <div class="shop-grid">
        <?php if (have_posts()) : ?>
          <?php while (have_posts()) : the_post(); get_template_part('template-parts/card', 'shop'); endwhile; ?>
        <?php else : ?>
          <p class="story-list-empty">La Bottega sta prendendo forma — i primi oggetti arriveranno presto.</p>
        <?php endif; ?>
      </div>
      <?php the_posts_pagination(array('mid_size' => 1, 'prev_text' => '←', 'next_text' => '→')); ?>
    </div>
  </section>

</main>
<?php get_footer(); ?>
