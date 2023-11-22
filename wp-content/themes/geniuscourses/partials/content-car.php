<div <?php post_class('col-lg-4 col-md-6 mb-2'); ?> id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>">
    <div class="rent-item mb-4">
        <img class="img-fluid mb-4" src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>" alt="">
        <h4 class="text-uppercase mb-4"><?php the_title(); ?></h4>
        <div class="d-flex justify-content-center mb-4">
            <div class="px-2">
                <i class="fa fa-car text-primary mr-1"></i>
                <span><?php echo get_post_meta(get_the_ID(),'car_manufacture', true); ?></span>
            </div>
            <div class="px-2 border-left border-right">
                <i class="fa fa-cogs text-primary mr-1"></i>
                <span><?php echo get_post_meta(get_the_ID(),'car_engine', true); ?></span>
            </div>
            <div class="px-2">
                <i class="fa fa-road text-primary mr-1"></i>
                <span>25K</span>
            </div>
        </div>
        <a class="btn btn-primary px-3" href="">$99.00/Day</a>
    </div>
</div>