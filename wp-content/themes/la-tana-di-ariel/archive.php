<?php
/**
 * Pagina di una categoria o archivio generico.
 * - Categoria con sottocategorie (es. Ariel): introduzione e una scheda per ogni sottocategoria.
 * - Altrimenti: introduzione ed elenco dei racconti.
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();

$children = array();
if (is_category()) {
    $term    = get_queried_object();
    $info    = tana_category_info($term);
    $eyebrow = $info['eyebrow'];
    $archive_title   = single_cat_title('', false);
    $lede    = $info['desc'];
    $empty   = $info['empty'];
    $children = get_categories(array('parent' => $term->term_id, 'hide_empty' => false, 'orderby' => 'term_id'));
} else {
    $eyebrow = 'Dalla Tana';
    $archive_title   = get_the_archive_title();
    $lede    = get_the_archive_description();
    $empty   = 'Nessun racconto trovato.';
}

// Icone delle schede (disegnate come quelle della homepage).
$hub_icons = array(
    'storie-di-vita'      => '<path d="M22 30c-5-4-9-7.4-9-11.8C13 15 15.4 13 18 13c1.8 0 3.2 1 4 2.4.8-1.4 2.2-2.4 4-2.4 2.6 0 5 2 5 5.2 0 4.4-4 7.8-9 11.8z" fill="none" stroke="var(--crimson)" stroke-width="1.6" stroke-linejoin="round"/>',
    'consigli-dalla-tana' => '<ellipse cx="22" cy="26" rx="5.5" ry="4.5" fill="none" stroke="var(--crimson)" stroke-width="1.6"/><circle cx="15" cy="19" r="2.2" fill="none" stroke="var(--crimson)" stroke-width="1.6"/><circle cx="19.5" cy="15" r="2.2" fill="none" stroke="var(--crimson)" stroke-width="1.6"/><circle cx="24.5" cy="15" r="2.2" fill="none" stroke="var(--crimson)" stroke-width="1.6"/><circle cx="29" cy="19" r="2.2" fill="none" stroke="var(--crimson)" stroke-width="1.6"/>',
    'diario-di-bordo'     => '<path d="M14 13h13a3 3 0 0 1 3 3v15H17a3 3 0 0 1-3-3z" fill="none" stroke="var(--crimson)" stroke-width="1.6" stroke-linejoin="round"/><path d="M14 28a3 3 0 0 1 3-3h13M19 17h7M19 21h5" fill="none" stroke="var(--crimson)" stroke-width="1.6" stroke-linecap="round"/>',
    'in-viaggio-con-la-tana' => '<path d="M10 28 Q22 12 34 28" fill="none" stroke="var(--crimson)" stroke-width="1.6" stroke-linecap="round"/><circle cx="14" cy="29" r="3" fill="none" stroke="var(--crimson)" stroke-width="1.6"/><circle cx="30" cy="29" r="3" fill="none" stroke="var(--crimson)" stroke-width="1.6"/>',
);
?>
<main id="top">

  <section class="paths">
    <div class="wrap section-head">
      <span class="eyebrow"><?php echo esc_html($eyebrow); ?></span>
      <h1><?php echo esc_html($archive_title); ?></h1>
      <?php if ($lede) : ?><p class="lede"><?php echo wp_kses_post($lede); ?></p><?php endif; ?>
    </div>
  </section>

  <?php if ($children) : ?>
  <section class="category-hub">
    <div class="wrap">
      <div class="path-grid path-grid-2">
        <?php foreach ($children as $child) :
            $c_info = tana_category_info($child);
            $c_post = tana_featured_post($child->slug);
            $c_icon = isset($hub_icons[$child->slug]) ? $hub_icons[$child->slug] : $hub_icons['storie-di-vita'];
            ?>
          <article class="path-card" id="<?php echo esc_attr($child->slug); ?>">
            <svg class="path-icon" viewBox="0 0 44 44" aria-hidden="true">
              <circle cx="22" cy="22" r="21" fill="var(--paper-deep)"/>
              <?php echo $c_icon; // phpcs:ignore -- SVG statico definito nel tema ?>
            </svg>
            <span class="path-tag"><?php echo esc_html($c_info['tag']); ?></span>
            <h2><?php echo esc_html($child->name); ?></h2>
            <?php if ($c_info['desc']) : ?><p class="desc"><?php echo esc_html($c_info['desc']); ?></p><?php endif; ?>
            <div class="sample">
              <?php if ($c_post) : ?>
                <p class="title"><a href="<?php echo esc_url(get_permalink($c_post)); ?>"><?php echo esc_html(get_the_title($c_post)); ?></a></p>
                <p class="teaser"><?php echo esc_html(wp_strip_all_tags(get_the_excerpt($c_post))); ?></p>
              <?php else : ?>
                <p class="teaser"><?php echo esc_html($c_info['empty']); ?></p>
              <?php endif; ?>
            </div>
            <a class="story-more" href="<?php echo esc_url(get_category_link($child)); ?>">Vai a <?php echo esc_html($child->name); ?> →</a>
          </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <?php else : ?>
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
  <?php endif; ?>

</main>
<?php get_footer(); ?>
