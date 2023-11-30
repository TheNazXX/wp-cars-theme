<?php $locations = get_the_terms(get_the_ID(), 'location') ?>

<article id='post-<?php echo the_ID()?>' <?php post_class()?>>
  <div class="property-card">
    <div class="property-image">
      <?php echo get_the_post_thumbnail() ?>
    </div>
    <div class="property-details">
      <div class="d-flex flex-row justify-content-between align-items-center">
        <h3 class="mr-2"><?php esc_html_e(the_title()); ?></h3>


        <?php if($locations): ?>
        <div><strong>Locations:</strong>
          <?php foreach($locations as $location){ ?>
          <a href="<?php echo esc_url(get_term_link($location))?>"><?php esc_html_e($location->name); ?></a>
          <?php } ?>
        </div>
        <?php endif; ?>

      </div>
      <p class="price"><strong style="color: black">Price:</strong>
        $<?php esc_html_e(get_post_meta(get_the_ID(), 'property_price', true)); ?>
      </p>
      <p class="period"><strong style="color: black">Period:
          &nbsp;</strong><?php esc_html_e(get_post_meta(get_the_ID(), 'property_period', true)); ?>
      </p>

      <p class="type"><strong style="color: black">Type:
          &nbsp;</strong><?php esc_html_e(get_post_meta(get_the_ID(), 'property_type', true)); ?></p>


      <p class="type"><strong style="color: black">Agent:
          &nbsp;</strong><?php echo get_post(get_post_meta(get_the_ID(), 'property_agent', true))->post_title; ?>
      </p>



      <div class="property-details-description">
        <span id="typed-output"></span>
        <div id="typed-input"><?php the_content()?></div>
      </div>
    </div>

    <div class='d-flex justify-content-end'>
      <a href="<?php the_permalink()?>" class="btn btn-secondary">More</a>
    </div>

  </div>
</article>