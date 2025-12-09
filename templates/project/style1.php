<?php if ( $count == 12 ) {
    $count = 13;
} ?>
<div class="item item-<?php echo esc_attr($count); ?> grid-item">				

    <div class="project-post scale-hover">

    <a href="<?php echo esc_url( get_permalink() ) ?>" class="tf-button">
        <i class="icon-proty-arrow-topt"></i>
    </a>

    <div class="featured-post">

<a href="<?php echo get_the_permalink(); ?>">

<?php 

$get_id_post_thumbnail = get_post_thumbnail_id();

echo sprintf('<img src="%s" alt="image">', \Elementor\Group_Control_Image_Size::get_attachment_image_src( $get_id_post_thumbnail, 'thumbnail', $settings ));

?>

</a>

</div>

        <div class="content"> 
                <div class="count-number">
                    <?php echo esc_html($count < 10 ? '0'.$count : $count); ?>
                </div>
            <h5 class="title border_eff">
                <a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a>
            </h5>

        </div>

    </div>

</div>