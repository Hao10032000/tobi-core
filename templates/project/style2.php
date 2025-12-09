<div class="swiper-slide">				

    <div class="project-slider">

    <div class="featured-post">

        <a href="<?php echo get_the_permalink(); ?>">

        <?php 

        $get_id_post_thumbnail = get_post_thumbnail_id();

        echo sprintf('<img src="%s" alt="image">', \Elementor\Group_Control_Image_Size::get_attachment_image_src( $get_id_post_thumbnail, 'thumbnail', $settings ));

        ?>

        </a>

        <div class="content">
            <div class="category">
                <?php echo esc_attr ( the_terms( get_the_ID(), 'project_category', '', ', ', '' ) ); ?>
            </div>
            <h3 class="title border_eff">
                <a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a>
            </h3>
            <div class="description"><?php echo wp_trim_words( get_the_content(), 30, '' ); ?></div>
            <div class="group-navigation">
			    <div class="button-nav-prev"> <i class="icon-proty-arrow-left"></i> </div>
			    <div class="button-nav-next"> <i class="icon-proty-arrow-right"></i> </div>
			</div>
        </div>

</div>


    </div>

</div>