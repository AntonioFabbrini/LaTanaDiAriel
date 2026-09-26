<?php
if (!defined('ABSPATH')) {
    exit;
}
get_header();
?>
<main id="top">
  <section class="entry">
    <div class="wrap">
      <header class="entry-head">
        <span class="eyebrow">Ops</span>
        <h1>Questa porta della Tana è chiusa</h1>
      </header>
      <div class="entry-content">
        <p>La pagina che cercavi non c'è (più). Ma la Tana è grande: torna alla porta d'ingresso e cerca da lì.</p>
        <p><a class="btn btn-primary" href="<?php echo esc_url(home_url('/')); ?>">Torna alla Tana</a></p>
      </div>
    </div>
  </section>
</main>
<?php get_footer(); ?>
