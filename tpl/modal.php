<?php foreach ($_SESSION['realkit']['modals'] as $modal): ?>
  <?php setup_postdata($modal); ?>

  <div id="realmodal-<?= $modal->ID; ?>" class="realmodal">
    <div class="realmodal-window">
      <div data-realmodal="close"></div>
      <div class="realmodal-header"></div>
      <div class="realmodal-content">
        <?php the_content(); ?>
      </div>
      <div class="realmodal-footer"></div>
    </div>
  </div>

  <?php wp_reset_postdata(); ?>
<?php endforeach; ?>