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
            <img class="image-list1" src="<?php echo esc_url( plugins_url( 'assets/img/list1.png', dirname(__FILE__) ) ); ?>" alt="">
            <img class="image-list2" src="<?php echo esc_url( plugins_url( 'assets/img/list2.png', dirname(__FILE__) ) ); ?>" alt="">
            <h3 class="job-title">
                <div class="icon">
                    <svg width="22" height="17" viewBox="0 0 22 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                       <path d="M12.528 16.0802C12.16 16.0802 11.808 15.9682 11.472 15.7442C11.136 15.5362 10.856 15.2642 10.632 14.9282C10.424 14.5922 10.32 14.2562 10.32 13.9202C10.32 13.5362 10.48 13.1282 10.8 12.6962C11.12 12.2642 11.496 11.8402 11.928 11.4242C12.376 10.9922 12.768 10.6242 13.104 10.3202H3.192C2.28 10.3202 1.632 10.2482 1.248 10.1042C0.864001 9.96023 0.560001 9.72023 0.336001 9.38423C0.112001 9.06423 1.04308e-06 8.61623 1.04308e-06 8.04023C1.04308e-06 7.46423 0.104001 7.01623 0.312001 6.69623C0.536001 6.37623 0.840001 6.13623 1.224 5.97623C1.608 5.83223 2.264 5.76023 3.192 5.76023H13.104L11.928 4.63223C11.272 3.99223 10.84 3.50423 10.632 3.16823C10.424 2.81623 10.32 2.48023 10.32 2.16023C10.32 1.82423 10.424 1.48823 10.632 1.15223C10.84 0.816234 11.112 0.544233 11.448 0.336233C11.8 0.112233 12.16 0.000233173 12.528 0.000233173C12.848 0.000233173 13.192 0.104233 13.56 0.312233C13.928 0.504234 14.36 0.840234 14.856 1.32023L21.768 8.04023L15 14.6162C14.424 15.1602 13.952 15.5362 13.584 15.7442C13.216 15.9682 12.864 16.0802 12.528 16.0802Z" fill="black"/>
                    </svg>
                </div>
                <a href="<?php echo esc_url( $post_permalink ); ?>"><?php echo get_the_title( $post_id ); ?></a>
            </h3>
            <div class="job-meta">
                <span class="meta-date"><?php echo $date_posted; ?></span> 
            </div>
            <div class="job-content">
                <?php echo wp_kses_post( $client_excerpt ); ?>
            </div>
           <a class="tf-button" href="<?php echo esc_url( $post_permalink ); ?>">

                            <span class="tf-button__text">
                              En savoir plus</span>
                            <span class="button__icon-wrapper">
                                <span class="button__icon-svg">
                                    <svg viewBox="0 0 14 15" fill="currentColor" width="10">
                                        <path d="M13.376 11.552l-.264-10.44-10.44-.24.024 2.28 6.96-.048L.2 12.56l1.488 1.488 9.432-9.432-.048 6.912 2.304.024z">
                                        </path>
                                    </svg>
                                </span> <span class="button__icon-svg button__icon-svg--copy">
                                    <svg viewBox="0 0 14 15" fill="currentColor" width="10">
                                        <path d="M13.376 11.552l-.264-10.44-10.44-.24.024 2.28 6.96-.048L.2 12.56l1.488 1.488 9.432-9.432-.048 6.912 2.304.024z">
                                        </path>
                                    </svg>
                                </span> </span>

                        </a>
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