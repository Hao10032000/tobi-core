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