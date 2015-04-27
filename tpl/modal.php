<?php foreach ($_SESSION['realkit']['modals'] as $modal): ?>

  <div id="realmodal-<?= $modal->ID; ?>" class="realmodal">
    <div class="realmodal-window">
      <div data-realmodal="close"></div>
      <div class="realmodal-header"></div>
      <div class="realmodal-content">
        <?= $modal->post_content; ?>
      </div>
      <div class="realmodal-footer"></div>
    </div>
  </div>

<?php endforeach; ?>