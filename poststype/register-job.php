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

    // Taxonomy: Features
    register_taxonomy( 'features', array( 'job' ), array(
        'hierarchical'      => true,
        'labels'            => get_tax_labels('Features', 'Feature'),
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'features' ),
    ));

    // Taxonomy: Sector
    register_taxonomy( 'sector', array( 'job' ), array(
        'hierarchical'      => true,
        'labels'            => get_tax_labels('Sectors', 'Sector'),
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'sector' ),
    ));

    // Taxonomy: Region
    register_taxonomy( 'region', array( 'job' ), array(
        'hierarchical'      => true,
        'labels'            => get_tax_labels('Regions', 'Region'),
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'region' ),
    ));

    // Taxonomy: Department
    register_taxonomy( 'department', array( 'job' ), array(
        'hierarchical'      => true,
        'labels'            => get_tax_labels('Departments', 'Department'),
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
        'Client Information',
        'job_client_callback',
        'job',
        'normal',
        'high'
    );

    // Profil Info Metabox (Normal position for large editor)
    add_meta_box(
        'job_profil_meta',
        'Profil Information',
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
                job_render_tax_dropdown( 'region', 'Region' );
                job_render_tax_dropdown( 'department', 'Department' );
                job_render_tax_dropdown( 'sector', 'Sector' );
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
        
        <div id="job-loading-overlay" style="display:none;"><?php echo esc_html_e('Chargement...', 'themesflat-core'); ?></div>

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
    
    $terms_features = wp_get_post_terms( $post_id, 'features', array( 'fields' => 'names' ) );
    
    $client_excerpt = $client_info;
    $date_posted = get_the_date( 'd/m/Y', $post_id );
    $post_permalink = get_permalink( $post_id );
    ?>
        <div class="job-card">
            <h3 class="job-title">
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

                <?php if ( ! empty( $terms_features ) && is_array( $terms_features ) ) : ?>
                    | <span class="meta-features">
                        <?php echo implode( ', ', array_map( 'esc_html', $terms_features ) ); ?>
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

            <a href="<?php echo esc_url( $post_permalink ); ?>" class="btn-view-deal">
                En savoir plus 
                <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 11 11" fill="none">
                    <path d="M0.27002 0V1.73H7.19995L0 8.92L1.23999 10.16L8.43994 2.97V9.9H10.17V0H0.27002Z" fill="#FF9366"/>
                </svg>
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