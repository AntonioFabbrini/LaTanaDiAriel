<?php
/**
 * Pagina generica.
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();
?>
<main id="top">
<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class('entry'); ?>>
    <div class="wrap">
      <header class="entry-head">
        <h1><?php the_title(); ?></h1>
      </header>
      <?php if (has_post_thumbnail()) : ?>
        <figure class="entry-thumb"><?php the_post_thumbnail('large', array('alt' => '')); ?></figure>
      <?php endif; ?>
      <div class="entry-content"><?php the_content(); ?></div>
    </div>
  </article>
<?php endwhile; ?>
</main>
<?php get_footer(); ?>
