<?php
// if uninstall.php is not called by WordPress, die
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

$post_type = 'lu_design_library';
$taxonomy = 'lu_widget_type';
$option_name = 'levelup_library_settings';
 
delete_option('levelup-library-version');
delete_option('levelup-library-loaded-version');
delete_option('levelup_default_designs_load');
delete_option($option_name);

wp_clear_scheduled_hook( 'levelup_daily_event' ); 


//
function levelup_go_delete_now() {
    global $wpdb;

    $posts = get_posts( array(
        'numberposts' => -1,
        'post_type' => $post_type,
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
        array($taxonomy) 
    );
// Delete taxonomies
$wpdb->prepare( "DELETE FROM {$wpdb->term_taxonomy} WHERE taxonomy = %s", array($taxonomy) );