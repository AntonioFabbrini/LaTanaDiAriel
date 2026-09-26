<?php
/**
 * Pagina "Chi siamo" (usata automaticamente dalla pagina con indirizzo /chi-siamo/).
 * Il contenuto è nel tema; per modificarlo basta cambiare questo file
 * oppure, in futuro, sostituirlo con blocchi dell'editor.
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();
?>
<main id="top">

  <section class="chi-siamo">
    <div class="wrap">
      <div class="section-head">
        <span class="eyebrow">Chi siamo</span>
        <h1>Chi vive nella Tana</h1>
      </div>
      <div class="people-grid">
        <div class="person">
          <div class="avatar">
            <span style="font-family:'Fraunces',serif;font-style:italic;font-weight:600;color:var(--crimson-soft);font-size:1.2rem;">L</span>
          </div>
          <h3>Linda</h3>
          <p>Voce narrante di questo diario. Insegnante, cerca ogni giorno un po' più di sintonia con la natura.</p>
        </div>
        <div class="person">
          <div class="avatar">
            <span style="font-family:'Fraunces',serif;font-style:italic;font-weight:600;color:var(--crimson-soft);font-size:1.2rem;">A</span>
          </div>
          <h3>Antonio</h3>
          <p>Mio marito, compagno di ogni sosta imprevista. Non voleva un cane — oggi non riesce a immaginare la vita senza.</p>
        </div>
        <div class="person">
          <div class="avatar">
            <svg width="24" height="24" viewBox="0 0 26 26" aria-hidden="true">
              <path d="M13 8c-2 0-3.5 1.5-3.5 3.3 0 1.3.8 2.4 1.9 3-3.2.9-5.6 3.6-5.6 6.9 0 .5.4.9.9.9h12.6c.5 0 .9-.4.9-.9 0-3.3-2.4-6-5.6-6.9 1.1-.6 1.9-1.7 1.9-3C16.5 9.5 15 8 13 8z" fill="var(--crimson-soft)"/>
            </svg>
          </div>
          <h3>Ariel</h3>
          <p>La nostra Cavalier King Blenheim, in Tana dal 17 ottobre 2015. Una macchia color cioccolato sulla guancia, come un piccolo baffo.</p>
        </div>
        <div class="person">
          <div class="avatar">
            <svg width="28" height="28" viewBox="0 0 30 30" aria-hidden="true">
              <rect x="6" y="14" width="18" height="8" rx="3" fill="var(--crimson-soft)"/>
              <circle cx="11" cy="23" r="2.4" fill="var(--green)"/>
              <circle cx="21" cy="23" r="2.4" fill="var(--green)"/>
              <rect x="10" y="10" width="8" height="6" rx="2" fill="var(--crimson-soft)"/>
            </svg>
          </div>
          <h3>Olivia</h3>
          <p>La roulotte-tana, chiamata come la tartaruga che porta casa sulle spalle ovunque vada.</p>
        </div>
      </div>

      <div class="origin-notes">
        <div class="note">
          <svg viewBox="0 0 56 56" aria-hidden="true">
            <circle cx="28" cy="28" r="27" fill="var(--paper-deep)"/>
            <path d="M28 38c-8-6-14-11-14-18 0-5 4-8 8-8 3 0 5.4 1.6 6 3.6.6-2 3-3.6 6-3.6 4 0 8 3 8 8 0 7-6 12-14 18z" fill="none" stroke="var(--crimson)" stroke-width="1.8"/>
          </svg>
          <div>
            <h3>Come è arrivata Ariel</h3>
            <p>Era un desiderio della narratrice da tempo. Poi, in vacanza a Malta, un cane come lei nuotò verso il proprio padrone, e Antonio disse: <span class="quote">«Se mai avremo un cane, deve essere quello.»</span></p>
            <p>Da una vicina, da un allevamento di Quistello, nel Mantovano, arrivò Ariel: la più piccola della cucciolata.</p>
          </div>
        </div>
        <div class="note olivia">
          <svg viewBox="0 0 56 56" aria-hidden="true">
            <circle cx="28" cy="28" r="27" fill="var(--paper-deep)"/>
            <ellipse cx="28" cy="32" rx="15" ry="10.5" fill="var(--green)" opacity="0.85"/>
            <path d="M18 32c-5-1-7 2-7 2s4 2.5 8 .8" fill="var(--green)" opacity="0.85"/>
            <path d="M38 32c5-1 7 2 7 2s-4 2.5-8 .8" fill="var(--green)" opacity="0.85"/>
            <circle cx="16" cy="26.5" r="4.8" fill="var(--green)" opacity="0.85"/>
          </svg>
          <div>
            <h3>Perché Olivia</h3>
            <p>Olivia è la nostra caravan, chiamata così dal nome di una piccola tartaruga marina che abbiamo adottato. Come la tartaruga porta la casa sulle spalle ovunque vada, noi viaggiamo portando la nostra Tana con noi.</p>
            <p>Non è "solo" una roulotte: <span class="quote">è la Tana che ha messo le ruote.</span> E alla sera torniamo sempre lì, dove siamo in tre. Una famiglia un po' particolare, forse. Ma piena di amore e di sogni.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

</main>
<?php get_footer(); ?>
