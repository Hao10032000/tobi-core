<?php

get_header(); 
wp_enqueue_style( 'tf-project' );
if ( ! function_exists( 'job_render_single_card' ) ) {
    function job_render_single_card( $post_id ) {
        $client_info = get_post_meta( $post_id, '_job_client', true );
        $client_excerpt = wp_trim_words( strip_tags( $client_info ), 30, '...' );
        $date_posted = get_the_date( 'd/m/Y', $post_id );
        $post_permalink = get_permalink( $post_id );
        ?>
        <div class="job-card">
            <h3 class="job-title"><a href="<?php echo esc_url( $post_permalink ); ?>"><?php echo get_the_title( $post_id ); ?></a></h3>
            <div class="job-meta">
                <span class="meta-date"><?php echo $date_posted; ?></span> 
            </div>
            <div class="job-content">
                <?php echo wp_kses_post( $client_excerpt ); ?>
            </div>
            <a href="<?php echo esc_url( $post_permalink ); ?>" class="btn-view-deal">En savoir plus &rarr;</a>
        </div>
        <?php
    }
}

$queried_object = get_queried_object();
$taxonomy_name = '';
$term_name = 'Jobs';

if ( $queried_object && is_a( $queried_object, 'WP_Term' ) ) {
    $taxonomy_name = get_taxonomy( $queried_object->taxonomy )->labels->singular_name;
    $term_name = $queried_object->name;
}
?>

<div class="container job-taxonomy-container">

    <header class="page-header">
        <h1 class="page-title"><?php echo esc_html( $taxonomy_name ); ?>: <?php echo esc_html( $term_name ); ?></h1>
        <?php 
        $term_description = term_description();
        if ( $term_description ) {
            echo '<div class="taxonomy-description">' . $term_description . '</div>';
        }
        ?>
    </header>

    <div id="primary" class="content-area">
        <main id="main" class="site-main job-results-wrapper" role="main">

            <?php if ( have_posts() ) : ?>

                <div class="job-grid taxonomy-job-grid">
                    <?php 
                    while ( have_posts() ) : the_post(); 
                        job_render_single_card( get_the_ID() );
                    endwhile; 
                    ?>
                </div>

                <div class="archive-pagination">
                    <?php
                    the_posts_pagination( array(
                        'prev_text' => __( 'Previous', 'text_domain' ),
                        'next_text' => __( 'Next', 'text_domain' ),
                        'screen_reader_text' => 'Job Pagination'
                    ) );
                    ?>
                </div>

            <?php else : ?>

                <p class="no-results">Sorry, no jobs found for this category.</p>

            <?php endif; ?>

        </main></div></div><?php get_footer(); ?>