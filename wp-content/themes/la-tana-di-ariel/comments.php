<?php
/**
 * Commenti di un racconto. Il template viene caricato da single.php solo se i
 * commenti sono aperti o ce n'è già qualcuno (si gestiscono da Impostazioni > Discussione).
 */
if (!defined('ABSPATH')) {
    exit;
}
if (post_password_required()) {
    return;
}
?>
<div class="comments-area" id="comments">
  <?php if (have_comments()) : ?>
    <h2 class="comments-title">
      <?php
      $n = (int) get_comments_number();
      echo esc_html(number_format_i18n($n) . ($n === 1 ? ' commento' : ' commenti'));
      ?>
    </h2>
    <ol class="comment-list">
      <?php wp_list_comments(array('style' => 'ol', 'short_ping' => true, 'avatar_size' => 40)); ?>
    </ol>
    <?php the_comments_navigation(); ?>
  <?php endif; ?>

  <?php if (!comments_open() && get_comments_number()) : ?>
    <p class="no-comments">I commenti sono chiusi.</p>
  <?php endif; ?>

  <?php comment_form(); ?>
</div>
