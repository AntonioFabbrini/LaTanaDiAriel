<?php
/**
 * Un singolo racconto.
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();
?>
<main id="top">
<?php while (have_posts()) : the_post();
    $cats = get_the_category();
    $main_cat  = $cats ? $cats[0] : null;
    $info = $main_cat ? tana_category_info($main_cat) : null;
    ?>
  <article <?php post_class('entry'); ?>>
    <div class="wrap">
      <header class="entry-head">
        <span class="eyebrow"><?php echo esc_html($info ? $info['eyebrow'] : 'Dalla Tana'); ?></span>
        <h1><?php the_title(); ?></h1>
        <time class="entry-date" datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date('j F Y')); ?></time>
      </header>

      <?php if (has_post_thumbnail()) : ?>
        <figure class="entry-thumb"><?php the_post_thumbnail('large', array('alt' => '')); ?></figure>
      <?php endif; ?>

      <div class="entry-content"><?php the_content(); ?></div>

      <?php if ($main_cat) : ?>
        <a class="back-link" href="<?php echo esc_url(get_category_link($main_cat)); ?>">← Tutte le storie: <?php echo esc_html($main_cat->name); ?></a>
      <?php endif; ?>

      <?php
      $prev = get_previous_post(true);
      $next = get_next_post(true);
      if ($prev || $next) : ?>
        <nav class="post-nav" aria-label="Altri racconti">
          <span><?php if ($prev) : ?>← <a href="<?php echo esc_url(get_permalink($prev)); ?>"><?php echo esc_html(get_the_title($prev)); ?></a><?php endif; ?></span>
          <span><?php if ($next) : ?><a href="<?php echo esc_url(get_permalink($next)); ?>"><?php echo esc_html(get_the_title($next)); ?></a> →<?php endif; ?></span>
        </nav>
      <?php endif; ?>

      <?php if (comments_open() || get_comments_number()) { comments_template(); } ?>
    </div>
  </article>
<?php endwhile; ?>
</main>
<?php get_footer(); ?>
