<?php
// if uninstall.php is not called by WordPress, die
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

$option_name = 'ampforwp_elementor_theme_settings';
 
delete_option('ampforwp-elementor-plus-version');
delete_option('ampforwp-elementor-plus-loaded-version');
delete_option($option_name);




//
function elementor_plus_go_delete_now() {
    global $wpdb;

    $posts = get_posts( array(
        'numberposts' => -1,
        'post_type' => elem_ampforwp_basics('post_type'),
        'post_status' => 'any' ) );

    foreach ( $posts as $post ){
        wp_delete_post( $post->ID, true );
    }
}

elementor_plus_go_delete_now();

// Set global
global $wpdb;
// Delete terms
$wpdb->query( "
    DELETE FROM
    {$wpdb->terms}
    WHERE term_id IN
    ( SELECT * FROM (
        SELECT {$wpdb->terms}.term_id
        FROM {$wpdb->terms}
        JOIN {$wpdb->term_taxonomy}
        ON {$wpdb->term_taxonomy}.term_id = {$wpdb->terms}.term_id
        WHERE taxonomy = '".elem_ampforwp_basics('taxonomy')."'
    ) as T
    );
");
// Delete taxonomies
$wpdb->query( "DELETE FROM {$wpdb->term_taxonomy} WHERE taxonomy = ".elem_ampforwp_basics('taxonomy') );