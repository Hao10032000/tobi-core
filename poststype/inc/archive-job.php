<?php
wp_enqueue_style( 'tf-project' );
get_header(); 

if ( ! function_exists( 'job_render_single_card' ) ) {
    function job_render_single_card( $post_id ) {
        // Cung cấp hàm hiển thị dự phòng nếu hàm gốc không được tìm thấy
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
?>

<div class="container job-archive-container">

    <header class="page-header">
        <h1 class="page-title"><?php post_type_archive_title( 'Job Listings: ' ); ?></h1>
    </header>

    <div id="primary" class="content-area">
        <main id="main" class="site-main job-results-wrapper" role="main">

            <?php if ( have_posts() ) : ?>

                <div class="job-grid archive-job-grid">
                    <?php 
                    // Bắt đầu The Loop (WordPress sẽ tự động query các bài 'job')
                    while ( have_posts() ) : the_post(); 
                        job_render_single_card( get_the_ID() );
                    endwhile; 
                    ?>
                </div>

                <div class="archive-pagination">
                    <?php
                    // Phân trang mặc định của WordPress (Không dùng AJAX)
                    the_posts_pagination( array(
                        'prev_text' => __( 'Previous', 'text_domain' ),
                        'next_text' => __( 'Next', 'text_domain' ),
                        'screen_reader_text' => 'Job Pagination'
                    ) );
                    ?>
                </div>

            <?php else : ?>

                <p class="no-results">Sorry, no jobs found.</p>

            <?php endif; ?>

        </main></div></div><?php get_footer(); ?>