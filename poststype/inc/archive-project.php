<?php
/**
 * The template for displaying archive project.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package saylo
 */
wp_enqueue_script( 'owl-carousel');
wp_enqueue_style( 'owl-carousel');
wp_enqueue_style( 'tf-project');
wp_enqueue_script( 'tf-project');
get_header(); ?>

<?php 

$terms_slug = wp_list_pluck(get_terms('project_category', 'hide_empty=0'), 'slug');
$filters = wp_list_pluck(get_terms('project_category', 'hide_empty=0'), 'name', 'slug');
$show_filter_class = '';

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$orderby = '';

$project_number_post = -1;

$query_args = array(
    'post_type' => 'project',
    'orderby'   => $orderby,
    'order'     => $order,
    'paged'     => $paged,
    'posts_per_page' => $project_number_post,
    'tax_query' => array(
        array(
            'taxonomy' => 'project_category',
            'field'    => 'slug',
            'terms'    => $terms_slug,
        ),
    ),
);

if (!empty($exclude)) {
    if (!is_array($exclude)) {
        $exclude = explode(',', $exclude);
    }
    $query_args['post__not_in'] = $exclude;
}

$query = new WP_Query($query_args);
?>

<div class="themesflat-project-taxonomy project-page">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="wrap-content-area">
                    <div id="primary" class="content-area">
                        <main id="main" class="main-content" role="main">

                            <div class="group-archive-project">

                            <div class="tf-project-wrap">
    <div class="wrap-project-post">
        <div  class="swiper slider-project">
            <div class="owl-carousel" data-bullets="yes" data-spacer="8" data-loop="false" data-auto="false" data-column="2" data-column2="2" data-column3="2">
                <?php 
                if ($query->have_posts()) {
                    while ($query->have_posts()) : $query->the_post(); ?>
                        <div class="swiper-slide">
                            <div class="item">
                                <div class="project-post scale-hover">
                                    <div class="featured-post">
                                        <a href="<?php echo get_the_permalink(); ?>">
                                            <?php 
                                            if (has_post_thumbnail()) {
                                                $themesflat_thumbnail = "full";
                                                the_post_thumbnail($themesflat_thumbnail);
                                            }
                                            ?>
                                        </a>
                                    </div>
                                    <div class="content"> 
                                        <div class="project-category">
                                            <?php 
                                            echo get_the_term_list( get_the_ID(), 'project_category', '', ', ' ); 
                                            ?>
                                        </div>
                                        <h5 class="title border_eff">
                                            <a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a>
                                        </h5>
                                        <div class="description"><?php echo wp_trim_words( get_the_content(), 4, '' ); ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile;
                } else {
                    get_template_part('template-parts/content', 'none');
                }
                ?>
            </div>
        </div>
    </div>
    <?php 
    themesflat_pagination_posttype($query);
    wp_reset_postdata();
    ?>
</div>


                            </div>
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
