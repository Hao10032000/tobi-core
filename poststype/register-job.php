<?php
/*
 * 1. Register Custom Post Type: JOB
 */
function create_job_cpt() {
    $labels = array(
        'name'                  => _x( 'Jobs', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Job', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'Jobs', 'text_domain' ),
        'name_admin_bar'        => __( 'Job', 'text_domain' ),
        'archives'              => __( 'Job Archives', 'text_domain' ),
        'attributes'            => __( 'Job Attributes', 'text_domain' ),
        'parent_item_colon'     => __( 'Parent Job:', 'text_domain' ),
        'all_items'             => __( 'All Jobs', 'text_domain' ),
        'add_new_item'          => __( 'Add New Job', 'text_domain' ),
        'add_new'               => __( 'Add New', 'text_domain' ),
        'new_item'              => __( 'New Job', 'text_domain' ),
        'edit_item'             => __( 'Edit Job', 'text_domain' ),
        'update_item'           => __( 'Update Job', 'text_domain' ),
        'view_item'             => __( 'View Job', 'text_domain' ),
        'view_items'            => __( 'View Jobs', 'text_domain' ),
        'search_items'          => __( 'Search Job', 'text_domain' ),
        'not_found'             => __( 'Not found', 'text_domain' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
    );
    $args = array(
        'label'                 => __( 'Job', 'text_domain' ),
        'description'           => __( 'Job Listings', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'thumbnail', 'revisions' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-businessman', // Icon for Jobs
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
    );
    register_post_type( 'job', $args );
}
add_action( 'init', 'create_job_cpt', 0 );

/*
 * 2. Register Taxonomies: Features, Sector, Region, Department
 */
function create_job_taxonomies() {
    // Helper function to create labels easily
    function get_tax_labels($name, $singular) {
        return array(
            'name'              => $name,
            'singular_name'     => $singular,
            'search_items'      => 'Search ' . $name,
            'all_items'         => 'All ' . $name,
            'parent_item'       => 'Parent ' . $singular,
            'parent_item_colon' => 'Parent ' . $singular . ':',
            'edit_item'         => 'Edit ' . $singular,
            'update_item'       => 'Update ' . $singular,
            'add_new_item'      => 'Add New ' . $singular,
            'new_item_name'     => 'New ' . $singular . ' Name',
            'menu_name'         => $name,
        );
    }


    // Taxonomy: Sector
    register_taxonomy( 'sector', array( 'job' ), array(
        'hierarchical'      => true,
        'labels'            => get_tax_labels('Secteur', 'Secteur'),
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'sector' ),
    ));

    // Taxonomy: Region
    register_taxonomy( 'region', array( 'job' ), array(
        'hierarchical'      => true,
        'labels'            => get_tax_labels('Région', 'Région'),
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'region' ),
    ));

    // Taxonomy: Department
    register_taxonomy( 'department', array( 'job' ), array(
        'hierarchical'      => true,
        'labels'            => get_tax_labels('Département', 'Département'),
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'department' ),
    ));
}
add_action( 'init', 'create_job_taxonomies', 0 );

/*
 * 3. Add Custom Meta Boxes (Ref, Client, Profil)
 */
function job_add_meta_boxes() {
    // Ref Metabox (Side position usually better for short numbers)
    add_meta_box(
        'job_ref_meta',
        'Ref (Reference Number)',
        'job_ref_callback',
        'job',
        'side', 
        'high'
    );

    // Client Info Metabox (Normal position for large editor)
    add_meta_box(
        'job_client_meta',
        'Description Job',
        'job_client_callback',
        'job',
        'normal',
        'high'
    );

    // Profil Info Metabox (Normal position for large editor)
    add_meta_box(
        'job_profil_meta',
        'Single Job',
        'job_profil_callback',
        'job',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'job_add_meta_boxes' );

/*
 * 4. Render Meta Boxes HTML
 */

// Callback for Ref (Number Input)
function job_ref_callback( $post ) {
    wp_nonce_field( 'job_save_meta_data', 'job_meta_nonce' );
    $value = get_post_meta( $post->ID, '_job_ref', true );
    ?>
    <label for="job_ref_field">Reference Number:</label>
    <input type="number" id="job_ref_field" name="job_ref_field" value="<?php echo esc_attr( $value ); ?>" style="width:100%; margin-top:5px;">
    <p class="description">Enter numeric reference only.</p>
    <?php
}

// Callback for Client (WYSIWYG Editor)
function job_client_callback( $post ) {
    $content = get_post_meta( $post->ID, '_job_client', true );
    $editor_id = 'jobclienteditor';
    $settings = array(
        'textarea_name' => 'job_client_editor',
        'media_buttons' => false, // Set to true if you want to allow image insertion
        'textarea_rows' => 8,
        'teeny'         => false, // Set to false to show full toolbar (bold, italic, lists, etc)
        'quicktags'     => true
    );
    wp_editor( $content, $editor_id, $settings );
}

// Callback for Profil (WYSIWYG Editor)
function job_profil_callback( $post ) {
    $content = get_post_meta( $post->ID, '_job_profil', true );
    $editor_id = 'jobprofileditor';
    $settings = array(
        'textarea_name' => 'job_profil_editor',
        'media_buttons' => false, 
        'textarea_rows' => 8,
        'teeny'         => false, 
        'quicktags'     => true
    );
    wp_editor( $content, $editor_id, $settings );
}

/*
 * 5. Save Meta Box Data
 */
function job_save_meta_data( $post_id ) {
    // Check nonce for security
    if ( ! isset( $_POST['job_meta_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['job_meta_nonce'], 'job_save_meta_data' ) ) return;

    // Check autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

    // Check permissions
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    // 1. Save Ref (Sanitize as number)
    if ( isset( $_POST['job_ref_field'] ) ) {
        // Ensure only numbers are saved? You can use absint() or sanitize_text_field
        update_post_meta( $post_id, '_job_ref', sanitize_text_field( $_POST['job_ref_field'] ) );
    }

    // 2. Save Client Info (Sanitize as Post content to keep HTML tags)
    if ( isset( $_POST['job_client_editor'] ) ) {
        update_post_meta( $post_id, '_job_client', wp_kses_post( $_POST['job_client_editor'] ) );
    }

    // 3. Save Profil Info (Sanitize as Post content to keep HTML tags)
    if ( isset( $_POST['job_profil_editor'] ) ) {
        update_post_meta( $post_id, '_job_profil', wp_kses_post( $_POST['job_profil_editor'] ) );
    }
}
add_action( 'save_post', 'job_save_meta_data' );

?>

<?php
// Tên action AJAX
define( 'JOB_AJAX_ACTION', 'filter_jobs' );

/**
 * 1. Setup the AJAX Handler (Handles filter requests)
 */
function job_filter_ajax_handler() {
    // Luôn cần kiểm tra nonce cho bảo mật
    check_ajax_referer( 'job_filter_nonce', 'security' );

    // Lấy các tham số filter và pagination
    $paged = isset( $_POST['paged'] ) ? intval( $_POST['paged'] ) : 1;
    $region = isset( $_POST['region'] ) ? sanitize_text_field( $_POST['region'] ) : '';
    $department = isset( $_POST['department'] ) ? sanitize_text_field( $_POST['department'] ) : '';
    $sector = isset( $_POST['sector'] ) ? sanitize_text_field( $_POST['sector'] ) : '';

    $args = job_get_query_args( $paged, $region, $department, $sector );
    
    // Bắt đầu query
    $jobs_query = new WP_Query( $args );

    ob_start();

    if ( $jobs_query->have_posts() ) {
        while ( $jobs_query->have_posts() ) {
            $jobs_query->the_post();
            // Hàm hiển thị một job item (được định nghĩa ở bước 3)
            job_render_single_card( get_the_ID() ); 
        }
    } else {
        echo '<p class="no-results">Sorry, no jobs match your criteria.</p>';
    }

    $posts_html = ob_get_clean();
    
    // Tạo phân trang (Pagination HTML)
    $pagination_html = job_render_pagination( $jobs_query );

    wp_reset_postdata();

    // Trả về dữ liệu JSON
    wp_send_json_success( array(
        'posts_html' => $posts_html,
        'pagination_html' => $pagination_html,
        'max_pages' => $jobs_query->max_num_pages,
        'current_page' => $paged,
    ) );
}
// Ajax cho người dùng đã đăng nhập
add_action( 'wp_ajax_' . JOB_AJAX_ACTION, 'job_filter_ajax_handler' );
// Ajax cho người dùng chưa đăng nhập
add_action( 'wp_ajax_nopriv_' . JOB_AJAX_ACTION, 'job_filter_ajax_handler' );


/**
 * 2. Shortcode initialization and Filter/Select HTML
 */
function job_listing_shortcode( $atts ) {
    wp_enqueue_style( 'tf-project' );
    wp_enqueue_script( 'job-filter-ajax' );

    $args = job_get_query_args( 1 );
    $jobs_query = new WP_Query( $args );

    ob_start();
    ?>
    <div id="job-listing-container">

        <div class="inner-header-filter">

            <h2><?php echo esc_html_e('NOS OFFRES D’EMPLOI', 'themesflat-core'); ?></h2>

            <div class="job-filters" id="job-filters-form">
                <?php 
                job_render_tax_dropdown( 'region', 'Région' );
                job_render_tax_dropdown( 'department', 'Département ' );
                job_render_tax_dropdown( 'sector', 'Secteur' );
                ?>
            </div>
        </div>
        
        
        <div class="job-results-wrapper" id="job-results-wrapper">
            <?php if ( $jobs_query->have_posts() ) : ?>
                <div id="job-results-list" class="job-grid">
                    <?php while ( $jobs_query->have_posts() ) : $jobs_query->the_post(); ?>
                        <?php job_render_single_card( get_the_ID() ); ?>
                    <?php endwhile; ?>
                </div>
                
                <div id="job-pagination" class="job-pagination-area">
                    <?php echo job_render_pagination( $jobs_query ); ?>
                </div>
            <?php else : ?>
                <p class="no-results"><?php echo esc_html_e('Aucun emploi trouvé.', 'themesflat-core'); ?></p>
            <?php endif; ?>
        </div>
        
        <div id="job-loading-overlay" style="display:none;"></div>

    </div>
    <?php
    wp_reset_postdata();
    return ob_get_clean();

    ob_start();
    ?>
    <div id="job-listing-container">

         <div class="inner-header-filter">

            <h2><?php echo esc_html_e('NOS OFFRES D’EMPLOI', 'themesflat-core'); ?></h2>
        
            <div class="job-filters" id="job-filters-form">
                <?php 
                job_render_tax_dropdown( 'region', 'Region' );
                job_render_tax_dropdown( 'department', 'Department' );
                job_render_tax_dropdown( 'sector', 'Sector' );
                ?>
                <button type="button" id="reset-all-filters" style="display:none;"><?php echo esc_html_e('Tout réinitialiser', 'themesflat-core'); ?></button>
            </div>
        </div>
        
        </div>
    <?php
    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode( 'job_listings', 'job_listing_shortcode' );


/**
 * 3. Render Functions (HTML Parts)
 */

function job_get_query_args( $paged = 1, $region = '', $department = '', $sector = '' ) {
    $tax_query = array( 'relation' => 'AND' );

    if ( ! empty( $region ) ) {
        $tax_query[] = array( 'taxonomy' => 'region', 'field' => 'slug', 'terms' => $region );
    }
    if ( ! empty( $department ) ) {
        $tax_query[] = array( 'taxonomy' => 'department', 'field' => 'slug', 'terms' => $department );
    }
    if ( ! empty( $sector ) ) {
        $tax_query[] = array( 'taxonomy' => 'sector', 'field' => 'slug', 'terms' => $sector );
    }

    $args = array(
        'post_type'      => 'job',
        'posts_per_page' => 6, // 6 bài/trang, giống ảnh
        'paged'          => $paged,
        'post_status'    => 'publish',
    );
    
    if ( count( $tax_query ) > 1 ) {
        $args['tax_query'] = $tax_query;
    }
    
    return $args;
}

function job_render_single_card( $post_id ) {
    $client_info = get_post_meta( $post_id, '_job_client', true );
    $ref_number = get_post_meta( $post_id, '_job_ref', true );
    $terms_department = wp_get_post_terms( $post_id, 'department', array( 'fields' => 'names' ) );
    $terms_sector = wp_get_post_terms( $post_id, 'sector', array( 'fields' => 'names' ) );
    
    $client_excerpt = $client_info;
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
                <a href="<?php echo esc_url( $post_permalink ); ?>">
                    <?php echo get_the_title( $post_id ); ?>
                </a>
            </h3>

            <div class="job-meta">
                <?php if ( ! empty( $date_posted ) ) : ?>
                    <span class="meta-date"><?php echo esc_html( $date_posted ); ?></span>
                <?php endif; ?>

                <?php if ( ! empty( $ref_number ) ) : ?>
                    | <span class="meta-ref">Ref: <?php echo esc_html( $ref_number ); ?></span>
                <?php endif; ?>
                <?php if ( ! empty( $terms_department ) && is_array( $terms_department ) ) : ?>
                    | <span class="meta-features">
                        <?php echo implode( ', ', array_map( 'esc_html', $terms_department ) ); ?>
                    </span>
                <?php endif; ?>
                <?php if ( ! empty( $terms_sector ) && is_array( $terms_sector ) ) : ?>
                    | <span class="meta-features">
                        <?php echo implode( ', ', array_map( 'esc_html', $terms_sector ) ); ?>
                    </span>
                <?php endif; ?>
            </div>

            <div class="job-content">
                <?php 
                if ( ! empty( $client_excerpt ) ) {
                    echo wp_kses_post( $client_excerpt );
                } 
                ?>
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

function job_render_tax_dropdown( $taxonomy_slug, $label ) {
    $terms = get_terms( array(
        'taxonomy' => $taxonomy_slug,
        'hide_empty' => true,
    ) );
    
    ?>
    <div class="filter-dropdown-wrapper">
        <select name="<?php echo esc_attr( $taxonomy_slug ); ?>" id="<?php echo esc_attr( $taxonomy_slug ); ?>-filter" class="job-filter-select">
            <option value=""><?php echo esc_html( $label ); ?></option>
            <?php foreach ( $terms as $term ) : ?>
                <option value="<?php echo esc_attr( $term->slug ); ?>"><?php echo esc_html( $term->name ); ?></option>
            <?php endforeach; ?>
        </select>
        <button type="button" class="reset-single-filter" data-filter="<?php echo esc_attr( $taxonomy_slug ); ?>" style="display:none;">&times;</button> 
    </div>
    <?php
}

function job_render_pagination( $query ) {
    if ( $query->max_num_pages <= 1 ) {
        return '';
    }
    
    $big = 999999999; 
    
    $paginate_links = paginate_links( array(
        'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format'    => '?paged=%#%',
        'current'   => max( 1, $query->query_vars['paged'] ),
        'total'     => $query->max_num_pages,
        'type'      => 'array',
        'prev_next' => false,
    ) );
    
    if ( is_array( $paginate_links ) ) {
        $output = '<ul class="pagination-list">';
        foreach ( $paginate_links as $link ) {
            $link = str_replace( '<a class="page-numbers"', '<a class="page-numbers ajax-page-link"', $link );
            $link = str_replace( 'page-numbers current', 'page-numbers current active', $link );
            $output .= '<li>' . $link . '</li>';
        }
        $output .= '</ul>';
        return $output;
    }
    return '';
}

// form job

// Tên action AJAX cho Form Ứng Tuyển
define( 'JOB_APPLICATION_ACTION', 'submit_job_application' );

/**
 * Register CPT to store job applications (Submissions)
 */
function register_job_application_cpt() {
    $labels = array(
        'name'          => _x( 'Applications', 'Post Type General Name', 'text_domain' ),
        'singular_name' => _x( 'Application', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'     => __( 'Job Applications', 'text_domain' ),
        'all_items'     => __( 'All Applications', 'text_domain' ),
        'add_new'       => __( 'Add New', 'text_domain' ),
        'add_new_item'  => __( 'Add New Application', 'text_domain' ),
        'edit_item'     => __( 'Edit Application', 'text_domain' ),
    );
    $args = array(
        'label'        => __( 'Job Application', 'text_domain' ),
        'labels'       => $labels,
        'public'       => false, // KHÔNG HIỂN THỊ RA FRONTEND
        'show_ui'      => true,
        'show_in_menu' => true, // Hiển thị trên Admin Menu
        'supports'     => array( 'title', 'editor' ), // Sử dụng title để lưu tên ứng viên và editor để lưu CV/lý do
        'menu_icon'    => 'dashicons-id-alt',
        'menu_position' => 25, 
        'has_archive'  => false,
        'capabilities' => array(
            'create_posts' => 'do_not_allow', 
        ),
        'map_meta_cap' => true,
        'map_meta_cap' => true,
    );
    register_post_type( 'job_application', $args );
}
add_action( 'init', 'register_job_application_cpt' );


function submit_job_application_handler() {
    if ( ! isset( $_POST['security'] ) || ! wp_verify_nonce( $_POST['security'], 'job_application_nonce' ) ) {
        wp_send_json_error( array( 'message' => 'Security check failed.' ) );
    }

    $job_id = intval( $_POST['job_id'] );
    $job_title = get_the_title( $job_id );

    $fields = array(
        'job_id'       => intval( $_POST['job_id'] ),
        'civility'     => sanitize_text_field( $_POST['civility'] ),
        'prenom'       => sanitize_text_field( $_POST['prenom'] ),
        'nom'          => sanitize_text_field( $_POST['nom'] ),
        'ville'        => sanitize_text_field( $_POST['ville'] ),
        'tel_mobile'   => sanitize_text_field( $_POST['tel_mobile'] ),
        'email_perso'  => sanitize_email( $_POST['email_perso'] ),
        'data_consent' => ( isset( $_POST['data_consent'] ) && $_POST['data_consent'] === 'on' ) ? 'Accepted' : 'Rejected',
    );

    $job_title = get_the_title( $fields['job_id'] );
    $candidate_name = $fields['prenom'] . ' ' . $fields['nom'];

    $attachments = array(); 
    $cv_file_url = '';

    if ( ! empty( $_FILES['cv_file'] ) && $_FILES['cv_file']['error'] === UPLOAD_ERR_OK ) {
        require_once( ABSPATH . 'wp-admin/includes/file.php' );
        $upload = wp_handle_upload( $_FILES['cv_file'], array( 'test_form' => false ) );
        
        if ( isset( $upload['file'] ) ) {
            $attachments[] = $upload['file']; 
            $cv_file_url = $upload['url'];  
        }
    }

    $post_title = $candidate_name . ' - ' . $job_title;
    $new_post_id = wp_insert_post( array(
        'post_title'   => $post_title,
        'post_status'  => 'publish',
        'post_type'    => 'job_application',
    ) );

if ( ! is_wp_error( $new_post_id ) ) {

        update_post_meta( $new_post_id, 'job_id', $fields['job_id'] );
        update_post_meta( $new_post_id, 'civility', $fields['civility'] );
        update_post_meta( $new_post_id, 'prenom', $fields['prenom'] );
        update_post_meta( $new_post_id, 'nom', $fields['nom'] );
        update_post_meta( $new_post_id, 'ville', $fields['ville'] );
        update_post_meta( $new_post_id, 'tel_mobile', $fields['tel_mobile'] );
        update_post_meta( $new_post_id, 'email_perso', $fields['email_perso'] );
        update_post_meta( $new_post_id, 'cv_file_url', $cv_file_url );
        update_post_meta( $new_post_id, 'data_consent', $fields['data_consent'] );

        $placeholders = array(
            '[job_title]'            => get_the_title($fields['job_id']),
            '[candidate_name]'       => $fields['prenom'] . ' ' . $fields['nom'],
            '[candidate_first_name]' => $fields['prenom'],
            '[candidate_last_name]'  => $fields['nom'],
            '[candidate_civility]'   => $fields['civility'],
            '[candidate_email]'      => $fields['email_perso'],
            '[candidate_phone]'      => $fields['tel_mobile'],
            '[candidate_city]'       => $fields['ville'],
        );

        $keys = array_keys($placeholders);
        $values = array_values($placeholders);

        $headers = array('Content-Type: text/html; charset=UTF-8');

        $raw_cand_subject = get_option('job_candidate_email_subject', 'Confirmation de votre candidature – [job_title]');
        $raw_cand_body    = get_option('job_candidate_email_body', 'Bonjour [candidate_first_name]...');
        
        $subj_candidate = str_replace($keys, $values, $raw_cand_subject);
        $body_candidate = str_replace($keys, $values, $raw_cand_body);
        $body_candidate = wpautop($body_candidate);

        wp_mail( $fields['email_perso'], $subj_candidate, $body_candidate, $headers );


        $raw_admin_subject = get_option('job_admin_email_subject', 'Nouvelle candidature – [job_title]');
        $raw_admin_body    = get_option('job_admin_email_body', 'Bonjour, một ứng viên mới...');

        $subj_admin = str_replace($keys, $values, $raw_admin_subject);
        $body_admin = str_replace($keys, $values, $raw_admin_body);
        $body_admin = wpautop($body_admin);

        $specific_cc = get_post_meta( $fields['job_id'], '_job_cc_email', true );
        if ( ! empty( $specific_cc ) && is_email( $specific_cc ) ) {
            $cc_recipient = $specific_cc;
        } else {
            $cc_recipient = get_option('job_default_cc_email', 'renaud@tobi-rh.com');
        }

        $to_admin = get_option('job_admin_recipient_email', 'barnabe@milsabor.com');
        $admin_headers = array(
            'Content-Type: text/html; charset=UTF-8',
            'Cc: ' . $cc_recipient
        );

        wp_mail( $to_admin, $subj_admin, $body_admin, $admin_headers, $attachments );

        wp_send_json_success( array( 'message' => 'Your application has been successfully submitted.' ) );
    } else {
        wp_send_json_error( array( 'message' => 'Failed to save application.' ) );
    }
}
add_action( 'wp_ajax_' . JOB_APPLICATION_ACTION, 'submit_job_application_handler' );
add_action( 'wp_ajax_nopriv_' . JOB_APPLICATION_ACTION, 'submit_job_application_handler' );

/**
 * Enqueue Scripts and Localize Data for AJAX
 */
function job_popup_enqueue_scripts() {
    if ( is_singular( 'job' ) ) {
        wp_enqueue_script( 'job-application-ajax', get_template_directory_uri() . '/js/job-application.js', array( 'jquery' ), null, true );
        
        wp_localize_script( 'job-application-ajax', 'jobAppAjax', array(
            'ajaxurl'   => admin_url( 'admin-ajax.php' ),
            'action'    => JOB_APPLICATION_ACTION, 
            'security'  => wp_create_nonce( 'job_application_nonce' ),
            'job_title' => get_the_title(),
            'job_id'    => get_the_ID(),
        ) );
    }
}
add_action( 'wp_enqueue_scripts', 'job_popup_enqueue_scripts' );

/**
 * 1. Add Custom Meta Box to display Application Details
 */
function job_application_add_meta_boxes() {
    add_meta_box(
        'job_application_details',
        'Application Details',
        'job_application_details_callback',
        'job_application',
        'normal',
        'high'
    );
    // Ẩn Editor mặc định vì nó chỉ chứa link CV và consent, không cần thiết cho việc xem nhanh
    remove_post_type_support( 'job_application', 'editor' ); 
}
add_action( 'add_meta_boxes', 'job_application_add_meta_boxes' );

/**
 * 2. Render the Application Details Meta Box content
 */
function job_application_details_callback( $post ) {
    // Lấy dữ liệu theo các key đã thống nhất
    $fields_to_display = array(
        'job_id'        => 'Applied Job Title',
        'civility'      => 'Civility',
        'nom'           => 'Last Name',
        'prenom'        => 'First Name',
        'tel_mobile'    => 'Mobile Phone',
        'email_perso'   => 'Personal Email',
        'ville'         => 'City',
        'cv_file_url'   => 'CV File Link',
        'data_consent'  => 'Data Consent',
    );
    
    echo '<table class="form-table" style="background: #f9f9f9; padding: 15px; border-radius: 5px;">';
    foreach ( $fields_to_display as $key => $label ) {
        $value = get_post_meta( $post->ID, $key, true );
        $value = $value ? $value : 'N/A';
        
        echo '<tr>';
        echo '<th style="width: 200px; color: #555;">' . esc_html( $label ) . '</th>';
        echo '<td style="font-weight: 500;">';
        
        if ( $key === 'job_id' && $value !== 'N/A' ) {
            echo '<a href="' . get_edit_post_link( $value ) . '" target="_blank">' . get_the_title( $value ) . '</a>';
        } elseif ( $key === 'cv_file_url' && $value !== 'N/A' ) {
            echo '<a href="' . esc_url( $value ) . '" class="button button-small" target="_blank">Download CV</a>';
        } else {
            echo esc_html( $value );
        }
        echo '</td></tr>';
    }
    echo '</table>';
}

function customize_job_app_row_actions( $actions, $post ) {
    if ( $post->post_type === 'job_application' ) {
        if ( isset( $actions['edit'] ) ) {
            $actions['edit'] = str_replace( 'Edit', 'Afficher les détails', $actions['edit'] );
        }
        
        unset( $actions['inline hide-if-no-js'] );
        
        unset( $actions['view'] );
    }
    return $actions;
}
add_filter( 'post_row_actions', 'customize_job_app_row_actions', 10, 2 );

function customize_job_app_publish_box() {
    global $post;
    if ( $post && $post->post_type === 'job_application' ) {
        echo '<style>
            #major-publishing-actions { padding: 10px; }
            #publish { width: 100%; height: 40px; }
            .preview.button { display: none; } /* Ẩn nút xem thử */
        </style>';
    }
}
add_action( 'admin_head', 'customize_job_app_publish_box' );

/**
 * 4. Add Custom Columns to Application List
 */
function job_application_set_columns( $columns ) {
    $new_columns = array();
    $new_columns['cb'] = $columns['cb'];
    $new_columns['title'] = 'Applicant Name'; // Đổi tên cột Title
    $new_columns['job_applied'] = 'Applied For Job'; // Tên Job ứng tuyển
    $new_columns['applicant_email'] = 'Email';
    $new_columns['applicant_mobile'] = 'Mobile';
    $new_columns['cv_status'] = 'CV Uploaded';
    $new_columns['date'] = 'Submission Date';

    return $new_columns;
}
add_filter( 'manage_job_application_posts_columns', 'job_application_set_columns' );

function job_application_custom_column( $column, $post_id ) {
    switch ( $column ) {
        case 'job_applied':
            $job_id = get_post_meta( $post_id, 'job_id', true ); 
            if ( $job_id ) {
                echo '<strong>' . esc_html( get_the_title( $job_id ) ) . '</strong>';
            }
            break;
            
        case 'applicant_email':
            echo esc_html( get_post_meta( $post_id, 'email_perso', true ) );
            break;

        case 'applicant_mobile':
            echo esc_html( get_post_meta( $post_id, 'tel_mobile', true ) );
            break;
            
        case 'cv_status':
            $cv_url = get_post_meta( $post_id, 'cv_file_url', true );
            if ( $cv_url ) {
                echo '<a href="' . esc_url( $cv_url ) . '" target="_blank" style="color: green;">View CV</a>';
            } else {
                echo '<span style="color: #ccc;">No CV</span>';
            }
            break;
    }
}
add_action( 'manage_job_application_posts_custom_column', 'job_application_custom_column', 10, 2 );

/**
 * 6. Make Job Applied column sortable (Optional but Recommended)
 */
function job_application_sortable_columns( $columns ) {
    $columns['job_applied'] = 'job_applied';
    $columns['applicant_email'] = 'applicant_email';
    return $columns;
}
add_filter( 'manage_edit-job_application_sortable_columns', 'job_application_sortable_columns' );


function my_render_elementor_template_shortcode( $atts ) {
    $atts = shortcode_atts( [
        'id' => '',
    ], $atts );

    if ( empty( $atts['id'] ) ) {
        return '';
    }

    if ( ! class_exists( '\Elementor\Plugin' ) ) {
        return '<!-- Elementor plugin not active -->';
    }

    return \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $atts['id'] );
}
add_shortcode( 'my_elementor_template', 'my_render_elementor_template_shortcode' );

/**
 * 1. Thêm Meta Box "Email CC" vào Custom Post Type 'job'
 */
function job_add_cc_email_metabox() {
    add_meta_box(
        'job_cc_email_meta',
        'Paramètres de l’email de notification (CC)',
        'job_cc_email_metabox_callback',
        'job', // Áp dụng cho post type 'job'
        'side', // Hiển thị ở cột bên phải
        'default'
    );
}
add_action( 'add_meta_boxes', 'job_add_cc_email_metabox' );

function job_cc_email_metabox_callback( $post ) {
    $cc_email = get_post_meta( $post->ID, '_job_cc_email', true );
    ?>
    <p>
        <label for="job_cc_email">Email de réception des notifications (CC)</label>
        <input type="email" id="job_cc_email" name="job_cc_email" value="<?php echo esc_attr( $cc_email ); ?>" style="width:100%;" placeholder="EX: abc@gmail.com" />
    </p>
    <p class="description">Si ce champ est laissé vide, le système enverra par défaut à: renaud@tobi-rh.com</p>
    <?php
}

function job_save_cc_email_meta( $post_id ) {
    if ( array_key_exists( 'job_cc_email', $_POST ) ) {
        update_post_meta( $post_id, '_job_cc_email', sanitize_email( $_POST['job_cc_email'] ) );
    }
}
add_action( 'save_post', 'job_save_cc_email_meta' );

/**
 * 1. Tạo menu "Email Settings" dưới Job Applications
 */
function job_app_email_settings_menu() {
    add_submenu_page(
        'edit.php?post_type=job_application',
        'Email Settings',
        'Email Settings',
        'manage_options',
        'job-email-settings',
        'job_app_email_settings_callback'
    );
}
add_action('admin_menu', 'job_app_email_settings_menu');

/**
 * Cập nhật giao diện trang cài đặt với thêm 2 trường Email người nhận
 */
function job_app_email_settings_callback() {
    // Lưu dữ liệu nếu có bấm Save
    if ( isset($_POST['save_email_templates']) ) {
        // Lưu thông tin người nhận
        update_option('job_admin_recipient_email', sanitize_email($_POST['admin_recipient_email']));
        update_option('job_default_cc_email', sanitize_email($_POST['default_cc_email']));
        
        // Lưu template (giữ nguyên phần cũ)
        update_option('job_candidate_email_subject', sanitize_text_field($_POST['candidate_subject']));
        update_option('job_candidate_email_body', wp_kses_post(stripslashes($_POST['candidate_body'])));
        update_option('job_admin_email_subject', sanitize_text_field($_POST['admin_subject']));
        update_option('job_admin_email_body', wp_kses_post(stripslashes($_POST['admin_body'])));
        
        echo '<div class="updated"><p>Cài đặt đã được lưu thành công!</p></div>';
    }

    // Lấy dữ liệu đã lưu (nếu trống thì lấy giá trị mặc định cũ)
    $admin_recipient = get_option('job_admin_recipient_email', 'barnabe@milsabor.com');
    $default_cc      = get_option('job_default_cc_email', 'renaud@tobi-rh.com');
    
    $candidate_subject = get_option('job_candidate_email_subject', 'Confirmation de votre candidature – [job_title]');
    $candidate_body    = get_option('job_candidate_email_body', '');
    $admin_subject     = get_option('job_admin_email_subject', 'Nouvelle candidature – [job_title]');
    $admin_body       = get_option('job_admin_email_body', '');
    ?>
    <div class="wrap">
        <h1>Paramètres des emails et notifications</h1>
        <form method="post">
            
            <div class="card" style="max-width: 100%; margin-top: 20px; padding: 15px;">
                <h2>1. Configuration des destinataires des notifications</h2>
                <table class="form-table">
                    <tr>
                        <th>Email administrateur principal (To)</th>
                        <td>
                            <input type="email" name="admin_recipient_email" value="<?php echo esc_attr($admin_recipient); ?>" class="regular-text" required>
                            <p class="description">Email principal recevant les notifications lorsqu’un nouveau candidat postule.</p>
                        </td>
                    </tr>
                    <tr>
                        <th>Email CC par défaut</th>
                        <td>
                            <input type="email" name="default_cc_email" value="<?php echo esc_attr($default_cc); ?>" class="regular-text" required>
                            <p class="description">Sera utilisé si l’offre d’emploi ne dispose pas d’un email CC spécifique.</p>
                        </td>
                    </tr>
                </table>
            </div>

            <hr>
            <h2>2. Contenu de l’email envoyé au candidat</h2>
            <p>Utilisez les balises suivantes pour remplacer automatiquement le contenu : <code>[job_title]</code>, <code>[candidate_name]</code>, <code>[candidate_first_name]</code>, <code>[candidate_last_name]</code>, <code>[candidate_civility]</code>, <code>[candidate_email]</code>, <code>[candidate_phone]</code>, <code>[candidate_city]</code></p>
            <table class="form-table">
                <tr>
                    <th>Subject</th>
                    <td><input type="text" name="candidate_subject" value="<?php echo esc_attr($candidate_subject); ?>" class="large-text"></td>
                </tr>
                <tr>
                    <th>Body</th>
                    <td><?php wp_editor($candidate_body, 'candidate_body'); ?></td>
                </tr>
            </table>

            <hr>
            <h2>3. Contenu de l’email envoyé à l’administrateur et aux CC</h2>
            <p>Utilisez les balises suivantes pour remplacer automatiquement le contenu: <code>[job_title]</code>, <code>[candidate_name]</code>, <code>[candidate_first_name]</code>, <code>[candidate_last_name]</code>, <code>[candidate_civility]</code>, <code>[candidate_email]</code>, <code>[candidate_phone]</code>, <code>[candidate_city]</code></p>
            <table class="form-table">
                <tr>
                    <th>Subject</th>
                    <td><input type="text" name="admin_subject" value="<?php echo esc_attr($admin_subject); ?>" class="large-text"></td>
                </tr>
                <tr>
                    <th>Body</th>
                    <td><?php wp_editor($admin_body, 'admin_body'); ?></td>
                </tr>
            </table>

            <p class="submit">
                <input type="submit" name="save_email_templates" class="button button-primary" value="Enregistrer les modifications">
            </p>
        </form>
    </div>
    <?php
}