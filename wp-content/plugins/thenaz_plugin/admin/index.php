<div class="content">
  <?php settings_errors();?>
  <form action="options.php" method="post">
    <?php 
      settings_fields('thenaz_settings');
      do_settings_sections('thenaz_settings');
      submit_button();
    ?>
  </form>
</div>