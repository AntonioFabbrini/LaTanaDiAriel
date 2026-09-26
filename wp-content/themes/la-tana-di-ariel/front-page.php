<?php
/**
 * Homepage: hero, manifesto, filosofia e i tre "percorsi" (Ariel, Olivia, La Bottega).
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();

$menu_items = tana_menu_items(); // [Ariel, Olivia, La Bottega, Chi siamo]
$url_ariel  = $menu_items[0][1];
$url_olivia = $menu_items[1][1];
$url_shop   = $menu_items[2][1];
$url_chi    = $menu_items[3][1];

// Il manifesto "Perché scriviamo": se esiste un articolo con indirizzo perche-scriviamo, il testo viene da lì;
// altrimenti si usa il testo scritto più sotto (modificabile in questo file).
$manifesto = get_posts(array('name' => 'perche-scriviamo', 'post_type' => 'post', 'posts_per_page' => 1));

// Anteprime dei tre percorsi
$ariel_post  = tana_featured_post('ariel');
$olivia_post = tana_featured_post('olivia');
$shop_posts  = get_posts(array('post_type' => 'bottega', 'posts_per_page' => 1));
$shop_post   = $shop_posts ? $shop_posts[0] : null;

$paths = array(
    array(
        'id'    => 'ariel',
        'tag'   => 'Storie di Ariel',
        'title' => 'Ariel',
        'desc'  => 'La sua storia, la vita con un Cavalier King, la cura e i piccoli episodi quotidiani che raccontano il nostro legame.',
        'post'  => $ariel_post,
        'fallback_title'  => 'Il posto tutto suo',
        'fallback_teaser' => 'Arrivò spaventata, la più piccola della cucciolata. Le bastò un peluche caldo per trovare finalmente un posto tutto suo.',
        'url'   => $url_ariel,
        'cta'   => 'Leggi tutte le storie di Ariel →',
        'icon'  => '<path d="M22 30c-5-4-9-7.4-9-11.8C13 15 15.4 13 18 13c1.8 0 3.2 1 4 2.4.8-1.4 2.2-2.4 4-2.4 2.6 0 5 2 5 5.2 0 4.4-4 7.8-9 11.8z" fill="none" stroke="var(--crimson)" stroke-width="1.6" stroke-linejoin="round"/>',
    ),
    array(
        'id'    => 'olivia',
        'tag'   => 'Viaggiare con il cane',
        'title' => 'Olivia',
        'desc'  => 'La caravan, la vita on the road, i consigli pratici per viaggiare in roulotte insieme al proprio cane.',
        'post'  => $olivia_post,
        'fallback_title'  => 'La Tana che ha preso le ruote',
        'fallback_teaser' => 'Una piccola casa su quattro ruote per scoprire il mondo senza mai rinunciare alla propria tana — e portare Ariel sempre con noi.',
        'url'   => $url_olivia,
        'cta'   => 'Leggi tutte le storie di Olivia →',
        'icon'  => '<path d="M10 28 Q22 12 34 28" fill="none" stroke="var(--crimson)" stroke-width="1.6" stroke-linecap="round"/><circle cx="14" cy="29" r="3" fill="none" stroke="var(--crimson)" stroke-width="1.6"/><circle cx="30" cy="29" r="3" fill="none" stroke="var(--crimson)" stroke-width="1.6"/>',
    ),
    array(
        'id'    => 'bottega',
        'tag'   => 'Handmade',
        'title' => 'La Bottega',
        'desc'  => 'Oggetti fatti a mano, uno alla volta — ognuno porta con sé il racconto di dove è nato: viaggio, scoperta, oggetto, ricordo.',
        'post'  => $shop_post,
        'fallback_title'  => 'I primi pezzi della Tana',
        'fallback_teaser' => 'Porta-rotoli in pelle, collane con pietre naturali, piccoli oggetti nati dai materiali raccolti lungo la strada con Olivia.',
        'url'   => $url_shop,
        'cta'   => 'Scopri la Bottega →',
        'icon'  => '<path d="M14 18l8-6 8 6v10a2 2 0 0 1-2 2H16a2 2 0 0 1-2-2z" fill="none" stroke="var(--crimson)" stroke-width="1.6" stroke-linejoin="round"/><path d="M19 30v-6h6v6" fill="none" stroke="var(--crimson)" stroke-width="1.6"/>',
    ),
);
?>
<main id="top">

  <!-- HERO -->
  <section class="hero">
    <div class="wrap">
      <div class="hero-art">
        <figure>
          <img src="<?php echo esc_url(get_theme_file_uri('assets/images/hero-door.jpg')); ?>" alt="Biglietto con il logo de La Tana di Ariel: Ariel, una Cavalier King addormentata sotto un piccolo arco di rami, rose e cuori dorati">
        </figure>
      </div>
      <div class="hero-copy">
        <span class="eyebrow">Benvenuto nella nostra Tana</span>
        <h1>Una piccola casa,<br>tre cuori e un mondo da scoprire.</h1>
        <p class="lede">Qui viviamo noi: Ariel, Antonio e io. Una famiglia un po' particolare, con una piccola Cavalier King al centro del nostro mondo e una piccola casa su quattro ruote, Olivia, che ci accompagna alla scoperta del mondo.</p>
        <p class="lede">La Tana di Ariel nasce dal desiderio di custodire e condividere ciò che abbiamo imparato insieme: la vita con un cane, la cura, l'amore, la natura, i viaggi — tutte quelle piccole esperienze che, mentre le viviamo, sembrano soltanto nostre, ma che un giorno potrebbero essere utili a qualcun altro.</p>
        <p class="closing">Entra. Fermati un po'. Questa è la nostra Tana.</p>
        <div class="cta-row">
          <a class="btn btn-primary" href="#percorsi">Entra nella Tana</a>
          <a class="btn btn-ghost" href="<?php echo esc_url($url_chi); ?>">Chi siamo</a>
        </div>
      </div>
    </div>
  </section>

  <!-- MANIFESTO -->
  <section class="manifesto" id="tana">
    <div class="wrap">
      <div class="section-head">
        <span class="eyebrow">La nostra Tana</span>
        <h2>Perché scriviamo</h2>
      </div>
      <div class="letter">
        <?php if ($manifesto) : ?>
          <?php echo apply_filters('the_content', $manifesto[0]->post_content); // phpcs:ignore ?>
        <?php else : ?>
          <p>Ariel è entrata nella nostra vita e l’ha cambiata. Non soltanto la mia: la nostra. Ci ha resi migliori, più in sintonia con la natura e con noi stessi. Da quel giorno abbiamo sentito il bisogno di raccontare: le nostre esperienze, ciò che abbiamo scoperto, imparato, capito insieme a lei — dentro Olivia, la nostra roulotte, lungo le strade che abbiamo percorso.</p>
          <p>Non vogliamo che tutto questo vada perduto. Per questo apriamo la porta della nostra Tana: a chi ha un animale di cui prendersi cura, a chi sogna di viaggiare portando la propria casa con sé, a chi cerca — come noi — il mondo, ma protetto.</p>
          <p class="signoff">— Linda &amp; Antonio</p>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <!-- FILOSOFIA -->
  <section class="philosophy">
    <div class="wrap">
      <span class="eyebrow">Dal manifesto della Tana</span>
      <div class="philosophy-grid">
        <div class="philosophy-main">
          <blockquote>«La Tana non va incontro alle persone per vendere qualcosa. La Tana apre la porta.»</blockquote>
          <p class="invite">Vieni, siediti un momento con noi. Ti raccontiamo una cosa che abbiamo imparato.</p>
        </div>
        <div class="pull">
          <blockquote>«Un'esperienza condivisa continua a vivere nella vita di qualcun altro.»</blockquote>
        </div>
      </div>
    </div>
  </section>

  <!-- PERCORSI -->
  <section class="paths" id="percorsi">
    <div class="wrap">
      <div class="section-head">
        <span class="eyebrow">Cosa trovi qui</span>
        <h2>Ariel, Olivia e la Bottega</h2>
        <p class="lede">Le storie, i viaggi, le mani. Nascono tutti dallo stesso posto — qui sotto un'anteprima di ciascuno.</p>
      </div>
      <div class="path-grid">
        <?php foreach ($paths as $p) : ?>
          <article class="path-card" id="<?php echo esc_attr($p['id']); ?>">
            <svg class="path-icon" viewBox="0 0 44 44" aria-hidden="true">
              <circle cx="22" cy="22" r="21" fill="var(--paper-deep)"/>
              <?php echo $p['icon']; // phpcs:ignore -- SVG statico definito nel tema ?>
            </svg>
            <span class="path-tag"><?php echo esc_html($p['tag']); ?></span>
            <h3><?php echo esc_html($p['title']); ?></h3>
            <p class="desc"><?php echo esc_html($p['desc']); ?></p>
            <div class="sample">
              <?php if ($p['post']) : ?>
                <p class="title"><a href="<?php echo esc_url(get_permalink($p['post'])); ?>"><?php echo esc_html(get_the_title($p['post'])); ?></a></p>
                <p class="teaser"><?php echo esc_html(wp_strip_all_tags(get_the_excerpt($p['post']))); ?></p>
              <?php else : ?>
                <p class="title"><?php echo esc_html($p['fallback_title']); ?></p>
                <p class="teaser"><?php echo esc_html($p['fallback_teaser']); ?></p>
              <?php endif; ?>
            </div>
            <a class="story-more" href="<?php echo esc_url($p['url']); ?>"><?php echo esc_html($p['cta']); ?></a>
          </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

</main>
<?php get_footer(); ?>
