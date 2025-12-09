<?php

add_action('init', 'themesflat_register_project_post_type');

/**

  * Register project post type

*/

function themesflat_register_project_post_type() {

    $project_slug = 'project';

    $labels = array(

        'name'                  => esc_html__( 'Project', 'themesflat-core' ),

        'singular_name'         => esc_html__( 'Project', 'themesflat-core' ),

        'menu_name'             => esc_html__( 'Project', 'themesflat-core' ),

        'add_new'               => esc_html__( 'New Project', 'themesflat-core' ),

        'add_new_item'          => esc_html__( 'Add New Project', 'themesflat-core' ),

        'new_item'              => esc_html__( 'New Project Item', 'themesflat-core' ),

        'edit_item'             => esc_html__( 'Edit Project Item', 'themesflat-core' ),

        'view_item'             => esc_html__( 'View Project', 'themesflat-core' ),

        'all_items'             => esc_html__( 'All Project', 'themesflat-core' ),

        'search_items'          => esc_html__( 'Search Project', 'themesflat-core' ),

        'not_found'             => esc_html__( 'No Project Items Found', 'themesflat-core' ),

        'not_found_in_trash'    => esc_html__( 'No Project Items Found In Trash', 'themesflat-core' ),

        'parent_item_colon'     => esc_html__( 'Parent Project:', 'themesflat-core' ),

        'not_found'             => esc_html__( 'No Project found', 'themesflat-core' ),

        'not_found_in_trash'    => esc_html__( 'No Project found in Trash', 'themesflat-core' )



    );

    $args = array(

        'labels'      => $labels,

        'supports'    => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'elementor'  ),

        'rewrite'       => array( 'slug' => $project_slug ),

        'public'      => true,   

        'show_in_rest' => true,  

        'has_archive' => true 

    );

    register_post_type( 'project', $args );

    flush_rewrite_rules();

}



add_filter( 'post_updated_messages', 'themesflat_project_updated_messages' );

/**

  * project update messages.

*/

function themesflat_project_updated_messages ( $messages ) {

    Global $post, $post_ID;

    $messages[esc_html__( 'project' )] = array(

        0  => '',

        1  => sprintf( esc_html__( 'project Updated. <a href="%s">View project</a>', 'themesflat-core' ), esc_url( get_permalink( $post_ID ) ) ),

        2  => esc_html__( 'Custom Field Updated.', 'themesflat-core' ),

        3  => esc_html__( 'Custom Field Deleted.', 'themesflat-core' ),

        4  => esc_html__( 'project Updated.', 'themesflat-core' ),

        5  => isset( $_GET['revision']) ? sprintf( esc_html__( 'project Restored To Revision From %s', 'themesflat-core' ), wp_post_revision_title((int)$_GET['revision'], false)) : false,

        6  => sprintf( esc_html__( 'project Published. <a href="%s">View project</a>', 'themesflat-core' ), esc_url( get_permalink( $post_ID ) ) ),

        7  => esc_html__( 'project Saved.', 'themesflat-core' ),

        8  => sprintf( esc_html__('project Submitted. <a target="_blank" href="%s">Preview project</a>', 'themesflat-core' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),

        9  => sprintf( esc_html__( 'project Scheduled For: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview project</a>', 'themesflat-core' ),date_i18n( esc_html__( 'M j, Y @ G:i', 'themesflat-core' ), strtotime( $post->post_date ) ), esc_url( get_permalink( $post_ID ) ) ),

        10 => sprintf( esc_html__( 'project Draft Updated. <a target="_blank" href="%s">Preview project</a>', 'themesflat-core' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),

    );

    return $messages;

}



add_action( 'init', 'themesflat_register_project_taxonomy' );

/**

  * Register project taxonomy

*/

function themesflat_register_project_taxonomy() {

    /*project Categories*/    

    $project_cat_slug = 'project_category'; 

    $labels = array(

        'name'                       => esc_html__( 'project Categories', 'themesflat-core' ),

        'singular_name'              => esc_html__( 'Categories', 'themesflat-core' ),

        'search_items'               => esc_html__( 'Search Categories', 'themesflat-core' ),

        'menu_name'                  => esc_html__( 'Categories', 'themesflat-core' ),

        'all_items'                  => esc_html__( 'All Categories', 'themesflat-core' ),

        'parent_item'                => esc_html__( 'Parent Categories', 'themesflat-core' ),

        'parent_item_colon'          => esc_html__( 'Parent Categories:', 'themesflat-core' ),

        'new_item_name'              => esc_html__( 'New Categories Name', 'themesflat-core' ),

        'add_new_item'               => esc_html__( 'Add New Categories', 'themesflat-core' ),

        'edit_item'                  => esc_html__( 'Edit Categories', 'themesflat-core' ),

        'update_item'                => esc_html__( 'Update Categories', 'themesflat-core' ),

        'add_or_remove_items'        => esc_html__( 'Add or remove Categories', 'themesflat-core' ),

        'choose_from_most_used'      => esc_html__( 'Choose from the most used Categories', 'themesflat-core' ),

        'not_found'                  => esc_html__( 'No Categories found.' ),

        'menu_name'                  => esc_html__( 'Categories' ),

    );

    $args = array(

        'labels'        => $labels,

        'rewrite'       => array('slug'=>$project_cat_slug),

        'hierarchical'  => true,

        'show_in_rest'  => true,

    );

    register_taxonomy( 'project_category', 'project', $args );

    flush_rewrite_rules();

}

function project_custom_meta() {

    add_meta_box(

		'project_custom_field',       

		'Information Project',                  

		'project_custom_metabox',  

		'project',                 

		'side',                

		'high'                     

	);

}

add_action('add_meta_boxes', 'project_custom_meta');

function project_custom_metabox() {
    global $post;

    $data_desc = get_post_meta($post->ID, 'desc_project_value', true);
    $image_url = get_post_meta($post->ID, 'image_project_url', true);

    // Use nonce for verification to secure data sending
    wp_nonce_field( basename( __FILE__ ), 'project_nonce' );
    ?>

    <div class="group-custom-metabox-contianer">
        <div class="inner-full group-custom-metabox" style="margin-bottom: 30px;">
            <label for="desc_project" style="display: block; font-size: 18px; font-weight: 600; color: #3C210E; text-transform: capitalize; margin-bottom: 20px;">
                <?php esc_html_e( 'Description', 'themesflat-core' ) ?>
            </label>
            <textarea id="desc_project" name="desc_project_value" rows="5" style="width: 100%; border: 1px solid #E4E4E4; background-color: #f6f6f6; padding: 10px 25px;"><?php echo esc_textarea($data_desc); ?></textarea>
        </div>
    </div>

    <!-- Image Upload -->
        <div class="inner-full group-custom-metabox" style="margin-bottom: 30px;">
            <label for="image_project" style="display: block; font-size: 18px; font-weight: 600; color: #3C210E; margin-bottom: 10px;">
                <?php esc_html_e( 'Project Single Image', 'themesflat-core' ) ?>
            </label>
            <input type="hidden" name="image_project_url" id="image_project_url" value="<?php echo esc_url($image_url); ?>" />
            <img id="image_preview" src="<?php echo esc_url($image_url); ?>" style="max-width: 200px; display: <?php echo $image_url ? 'block' : 'none'; ?>; margin-bottom: 10px;" />
            <button type="button" class="button" id="upload_image_button"><?php esc_html_e( 'Choose Image', 'themesflat-core' ); ?></button>
            <button type="button" class="button" id="remove_image_button" style="display: <?php echo $image_url ? 'inline-block' : 'none'; ?>;"><?php esc_html_e( 'Remove Image', 'themesflat-core' ); ?></button>
        </div>

        <script>
        jQuery(document).ready(function($){
            var mediaUploader;

            $('#upload_image_button').click(function(e) {
                e.preventDefault();
                if (mediaUploader) {
                    mediaUploader.open();
                    return;
                }
                mediaUploader = wp.media({
                    title: 'Choose Image',
                    button: { text: 'Choose Image' },
                    multiple: false
                });
                mediaUploader.on('select', function() {
                    var attachment = mediaUploader.state().get('selection').first().toJSON();
                    $('#image_project_url').val(attachment.url);
                    $('#image_preview').attr('src', attachment.url).show();
                    $('#remove_image_button').show();
                });
                mediaUploader.open();
            });

            $('#remove_image_button').click(function(e) {
                e.preventDefault();
                $('#image_project_url').val('');
                $('#image_preview').hide();
                $(this).hide();
            });
        });
    </script>

    <?php
}


function project_save_meta_fields($post_id) {

	// Verify nonce
	if (!isset($_POST['project_nonce']) || !wp_verify_nonce($_POST['project_nonce'], basename(__FILE__)))
		return;

	// Check autosave
	if (wp_is_post_autosave($post_id))
		return;

	// Check post revision
	if (wp_is_post_revision($post_id))
		return;

	// Check permissions
	if (isset($_POST['post_type']) && $_POST['post_type'] == 'project') {
		if (!current_user_can('edit_page', $post_id))
			return;
	} elseif (!current_user_can('edit_post', $post_id)) {
		return;
	}

	
    if (isset($_POST['desc_project_value'])) {
		update_post_meta($post_id, 'desc_project_value', sanitize_text_field($_POST['desc_project_value']));
	}else {
		update_post_meta($post_id, 'desc_project_value', 'GIFFORDS is a nationwide organization led by former Congresswoman Gabrielle Giffords that is dedicated to saving lives from gun violence.');
	}

    if (isset($_POST['image_project_url'])) {
    	update_post_meta($post_id, 'image_project_url', esc_url_raw($_POST['image_project_url']));
    } else {
    	delete_post_meta($post_id, 'image_project_url');
    }
   
}

add_action('save_post', 'project_save_meta_fields');
