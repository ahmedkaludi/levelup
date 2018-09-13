<?php
// if uninstall.php is not called by WordPress, die
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

$option_name = 'levelup_library_settings';
 
delete_option('levelup-library-version');
delete_option('levelup-library-loaded-version');
delete_option('levelup_default_designs_load');
delete_option($option_name);




//
function levelup_go_delete_now() {
    global $wpdb;

    $posts = get_posts( array(
        'numberposts' => -1,
        'post_type' => levelup_basics_config('post_type'),
        'post_status' => 'any' ) );

    foreach ( $posts as $post ){
        wp_delete_post( $post->ID, true );
    }
}

levelup_go_delete_now();

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
        array(levelup_basics_config('taxonomy')) 
    );
// Delete taxonomies
$wpdb->prepare( "DELETE FROM {$wpdb->term_taxonomy} WHERE taxonomy = %s", array(levelup_basics_config('taxonomy')) );