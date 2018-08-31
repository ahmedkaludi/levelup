<?php
// if uninstall.php is not called by WordPress, die
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

$option_name = 'elementor_plus_library_settings';
 
delete_option('elementor-plus-library-version');
delete_option('elementor-plus-library-loaded-version');
delete_option($option_name);




//
function elementor_plus_go_delete_now() {
    global $wpdb;

    $posts = get_posts( array(
        'numberposts' => -1,
        'post_type' => elementor_plus_basics_config('post_type'),
        'post_status' => 'any' ) );

    foreach ( $posts as $post ){
        wp_delete_post( $post->ID, true );
    }
}

elementor_plus_go_delete_now();

    // Set global
    global $wpdb;
    // Delete terms
    $wpdb->prepare( "
            DELETE FROM
            {$wpdb->terms}
            WHERE term_id IN
            ( SELECT * FROM (
                SELECT {$wpdb->terms}.term_id
                FROM {$wpdb->terms}
                JOIN {$wpdb->term_taxonomy}
                ON {$wpdb->term_taxonomy}.term_id = {$wpdb->terms}.term_id
                WHERE taxonomy = '%s'
            ) as T
            );
        ",
        array(elementor_plus_basics_config('taxonomy')) 
    );
// Delete taxonomies
$wpdb->prepare( "DELETE FROM {$wpdb->term_taxonomy} WHERE taxonomy = %s", array(elementor_plus_basics_config('taxonomy')) );