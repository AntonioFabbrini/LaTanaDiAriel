<?php
/**
 * La Tana di Ariel — funzioni del tema.
 */
if (!defined('ABSPATH')) {
    exit;
}

define('TANA_VERSION', '1.0.0');

/* ------------------------------------------------------------------
 * Impostazioni base del tema
 * ------------------------------------------------------------------ */
function tana_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
    add_theme_support('responsive-embeds');
    add_theme_support('wp-block-styles');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script'));
    add_theme_support('custom-logo', array(
        'height'      => 160,
        'width'       => 160,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    add_image_size('tana-card', 800, 450, true);

    register_nav_menus(array(
        'primary' => 'Menu principale',
        'footer'  => 'Menu nel footer',
    ));
}
add_action('after_setup_theme', 'tana_setup');

/* Area widget nel footer: qui si potrà inserire il modulo newsletter (es. Mailchimp, MailPoet). */
function tana_widgets() {
    register_sidebar(array(
        'name'          => 'Footer - Newsletter',
        'id'            => 'footer-newsletter',
        'description'   => 'Il modulo di iscrizione alla newsletter, mostrato nel footer.',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<span class="eyebrow">',
        'after_title'   => '</span>',
    ));
}
add_action('widgets_init', 'tana_widgets');

/* ------------------------------------------------------------------
 * Stili e script
 * ------------------------------------------------------------------ */
function tana_assets() {
    // Font: Fraunces (titoli) + Karla (testo). Vedi LEGGIMI per ospitarli in locale (GDPR).
    wp_enqueue_style(
        'tana-fonts',
        'https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,500;0,9..144,600;0,9..144,700;1,9..144,400;1,9..144,500;1,9..144,600&family=Karla:wght@400;500;600;700&display=swap',
        array(),
        null
    );
    wp_enqueue_style('tana-style', get_stylesheet_uri(), array('tana-fonts'), TANA_VERSION);
    wp_enqueue_script('tana-theme', get_template_directory_uri() . '/assets/js/theme.js', array(), TANA_VERSION, true);
}
add_action('wp_enqueue_scripts', 'tana_assets');

/* ------------------------------------------------------------------
 * La Bottega: tipo di contenuto "oggetto handmade"
 * (in futuro si può affiancare o sostituire con WooCommerce)
 * ------------------------------------------------------------------ */
function tana_register_bottega() {
    register_post_type('bottega', array(
        'labels' => array(
            'name'               => 'La Bottega',
            'singular_name'      => 'Oggetto',
            'menu_name'          => 'La Bottega',
            'all_items'          => 'Tutti gli oggetti',
            'add_new'            => 'Aggiungi oggetto',
            'add_new_item'       => 'Aggiungi un nuovo oggetto',
            'edit_item'          => 'Modifica oggetto',
            'new_item'           => 'Nuovo oggetto',
            'view_item'          => 'Vedi oggetto',
            'search_items'       => 'Cerca oggetti',
            'not_found'          => 'Nessun oggetto trovato',
            'not_found_in_trash' => 'Nessun oggetto nel cestino',
        ),
        'public'        => true,
        'has_archive'   => 'bottega',
        'rewrite'       => array('slug' => 'bottega'),
        'menu_icon'     => 'dashicons-store',
        'menu_position' => 5,
        'show_in_rest'  => true,
        'supports'      => array('title', 'editor', 'excerpt', 'thumbnail', 'revisions'),
    ));
}
add_action('init', 'tana_register_bottega');

/* ------------------------------------------------------------------
 * Alla prima attivazione: categorie e pagina "Chi siamo"
 * ------------------------------------------------------------------ */
function tana_categories_defaults() {
    return array(
        'ariel'  => array(
            'name'    => 'Ariel',
            'eyebrow' => 'Storie di Ariel',
            'desc'    => 'La sua storia, la vita con un Cavalier King, la cura e i piccoli episodi quotidiani che raccontano il nostro legame.',
            'empty'   => 'Presto qui troverai i primi racconti su Ariel.',
        ),
        'olivia' => array(
            'name'    => 'Olivia',
            'eyebrow' => 'Viaggiare con il cane',
            'desc'    => 'La caravan, la vita on the road, i consigli pratici per viaggiare in roulotte insieme al proprio cane.',
            'empty'   => 'Presto qui troverai i primi racconti di viaggio con Olivia.',
        ),
    );
}

function tana_on_activation() {
    foreach (tana_categories_defaults() as $slug => $c) {
        if (!term_exists($slug, 'category')) {
            wp_insert_term($c['name'], 'category', array('slug' => $slug, 'description' => $c['desc']));
        }
    }

    if (!get_page_by_path('chi-siamo')) {
        wp_insert_post(array(
            'post_title'   => 'Chi siamo',
            'post_name'    => 'chi-siamo',
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_content' => '',
        ));
    }

    tana_register_bottega();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'tana_on_activation');

/**
 * Al cambio di tema WordPress sposta i widget di prova del tema precedente
 * (Archivi, Categorie…) nella prima area del nuovo tema. L'area newsletter del
 * footer deve invece partire vuota: i widget non vengono cancellati, ma messi
 * tra quelli inattivi (Aspetto > Widget).
 */
function tana_clear_footer_widgets() {
    $sidebars = wp_get_sidebars_widgets();
    if (empty($sidebars['footer-newsletter'])) {
        return;
    }
    $inactive = isset($sidebars['wp_inactive_widgets']) ? (array) $sidebars['wp_inactive_widgets'] : array();
    $sidebars['wp_inactive_widgets'] = array_merge($inactive, (array) $sidebars['footer-newsletter']);
    $sidebars['footer-newsletter']   = array();
    wp_set_sidebars_widgets($sidebars);
}
// Priorità 20: dopo che WordPress ha spostato i widget (priorità 10).
add_action('after_switch_theme', 'tana_clear_footer_widgets', 20);

/* ------------------------------------------------------------------
 * Helper
 * ------------------------------------------------------------------ */

/** Dati di presentazione di una categoria (eyebrow, descrizione, messaggio vuoto). */
function tana_category_info($term) {
    $defaults = tana_categories_defaults();
    $slug = is_object($term) ? $term->slug : $term;
    $d = isset($defaults[$slug]) ? $defaults[$slug] : array('name' => '', 'eyebrow' => 'Dalla Tana', 'desc' => '', 'empty' => 'Presto nuovi racconti.');
    if (is_object($term)) {
        $d['name'] = $term->name;
        if (!empty($term->description)) {
            $d['desc'] = $term->description;
        }
    }
    return $d;
}

/** Racconto in evidenza per una categoria: il primo "articolo in evidenza" (sticky), altrimenti l'ultimo. */
function tana_featured_post($cat_slug) {
    $sticky = get_option('sticky_posts');
    if (!empty($sticky)) {
        $q = new WP_Query(array(
            'category_name'       => $cat_slug,
            'post__in'            => $sticky,
            'ignore_sticky_posts' => 1,
            'posts_per_page'      => 1,
            'no_found_rows'       => true,
        ));
        if ($q->have_posts()) {
            return $q->posts[0];
        }
    }
    $posts = get_posts(array('category_name' => $cat_slug, 'posts_per_page' => 1));
    return $posts ? $posts[0] : null;
}

/** Icona decorativa mostrata al posto della foto quando manca. */
function tana_icon($key) {
    $icons = array(
        'ariel'   => '<svg viewBox="0 0 44 44" fill="none" aria-hidden="true"><path d="M22 30c-5-4-9-7.4-9-11.8C13 15 15.4 13 18 13c1.8 0 3.2 1 4 2.4.8-1.4 2.2-2.4 4-2.4 2.6 0 5 2 5 5.2 0 4.4-4 7.8-9 11.8z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg>',
        'olivia'  => '<svg viewBox="0 0 44 44" fill="none" aria-hidden="true"><path d="M10 28 Q22 12 34 28" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/><circle cx="14" cy="29" r="3" stroke="currentColor" stroke-width="1.6"/><circle cx="30" cy="29" r="3" stroke="currentColor" stroke-width="1.6"/></svg>',
        'bottega' => '<svg viewBox="0 0 44 44" fill="none" aria-hidden="true"><path d="M14 18l8-6 8 6v10a2 2 0 0 1-2 2H16a2 2 0 0 1-2-2z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/><path d="M19 30v-6h6v6" stroke="currentColor" stroke-width="1.6"/></svg>',
        'tana'    => '<svg viewBox="0 0 44 44" fill="none" aria-hidden="true"><path d="M9 30c0-9 6-16 13-16s13 7 13 16" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/><path d="M9 30h26" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>',
    );
    return isset($icons[$key]) ? $icons[$key] : $icons['tana'];
}

/** Chiave dell'icona di un articolo in base alla sua categoria. */
function tana_icon_key_for($post_id) {
    if (get_post_type($post_id) === 'bottega') {
        return 'bottega';
    }
    $cats = get_the_category($post_id);
    if ($cats) {
        return $cats[0]->slug;
    }
    return 'tana';
}

/** Voci del menu di riserva (finché non si crea un menu da Aspetto > Menu). */
function tana_menu_items() {
    $chi = get_page_by_path('chi-siamo');
    $items = array();
    foreach (array('ariel' => 'Ariel', 'olivia' => 'Olivia') as $slug => $label) {
        $t = get_category_by_slug($slug);
        $items[] = array($label, $t ? get_category_link($t) : home_url('/category/' . $slug . '/'));
    }
    $bottega = get_post_type_archive_link('bottega');
    $items[] = array('La Bottega', $bottega ? $bottega : home_url('/bottega/'));
    $items[] = array('Chi siamo', $chi ? get_permalink($chi) : home_url('/chi-siamo/'));
    return $items;
}

function tana_fallback_menu($args = array()) {
    $id    = !empty($args['container_id']) ? ' id="' . esc_attr($args['container_id']) . '"' : '';
    // Nessuna classe di default: "links" è riservata al menu della testata (il footer ha stili suoi).
    $class = !empty($args['container_class']) ? ' class="' . esc_attr($args['container_class']) . '"' : '';
    $label = (!empty($args['theme_location']) && $args['theme_location'] === 'footer') ? 'Menu nel footer' : 'Menu principale';
    // $class e $id sono già passati da esc_attr() qui sopra.
    echo '<nav' . $class . $id . ' aria-label="' . esc_attr($label) . '"><ul class="menu">'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    foreach (tana_menu_items() as $item) {
        echo '<li><a href="' . esc_url($item[1]) . '">' . esc_html($item[0]) . '</a></li>';
    }
    echo '</ul></nav>';
}

/** Riassunto più corto per le card. */
function tana_excerpt_length($length) {
    return 32;
}
add_filter('excerpt_length', 'tana_excerpt_length');
add_filter('excerpt_more', function () { return '…'; });
