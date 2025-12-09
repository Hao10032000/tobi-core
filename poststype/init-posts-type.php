<?php 

/* Custom Post Type

===================================*/

if ( ! class_exists( 'themesflat_custom_post_type' ) ) {

    class themesflat_custom_post_type {

        function __construct() {

            require_once THEMESFLAT_PATH . '/poststype/register-job.php';

            add_filter( 'single_template', array( $this,'themesflat_single_job' ) );

            add_filter( 'taxonomy_template', array( $this,'themesflat_taxonomy_job' ) ); 

            add_filter( 'archive_template', array( $this,'themesflat_archive_job' ) );  

        }        




        /* Temlate job */

        function themesflat_single_job( $single_template ) {

            global $post;

            if ( $post->post_type == 'job' ) $single_template = THEMESFLAT_PATH . '/poststype/inc/single-job.php';

            return $single_template;

        }

        function themesflat_taxonomy_job( $taxonomy_template ) {

            global $post;

            if ( $post->post_type == 'job' ) $taxonomy_template = THEMESFLAT_PATH . '/poststype/inc/taxonomy-job_category.php';

            return $taxonomy_template;

        }

        function themesflat_archive_job( $archive_template ) {

            global $post;

            if ( is_post_type_archive ( 'job' ) ) $archive_template = THEMESFLAT_PATH . '/poststype/inc/archive-job.php';

            return $archive_template;

        }

    }

    

}

new themesflat_custom_post_type;
