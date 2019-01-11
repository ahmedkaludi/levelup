<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
require_once LEVELUP__FILE__PATH.'inc/vendor/importer/vendor/vendor_importer.php';
add_filter( 'levelup_import/import_files', 'demo_designs_import_files'  );

function demo_designs_import_files(){
	return array(
			array(
				'import_file_name'           => 'Bolts Construction',
				'import_file_url'            => 'http://levelup.magazine3.company/levelup/ampforwp.20190109093839.xml',
				'import_widget_file_url'     => '',
				'import_customizer_file_url' => 'http://levelup.magazine3.company/levelup/level-up-export.dat',
				'import_dummy_content'		=> '',
				'import_preview_image_url'   => 'http://artifacts.proteusthemes.com/import-preview-images/bolts-construction.jpg',
				'preview_url'                => 'https://demo.proteusthemes.com/bolts',
			),
		);
}

add_action( 'wp_import_insert_post', 'levelup_import_set_frontPage', 10,4 );
function levelup_import_set_frontPage($post_id, $original_id, $postdata, $data){
	if($post_id){
		update_option( 'page_on_front', $post_id );
		update_option( 'show_on_front', 'page' );


		//AMP 
		global $redux_builder_amp;
		$redux_builder_amp = get_option('redux_builder_amp');
		$redux_builder_amp['amp-frontpage-select-option'] = 1;
		$redux_builder_amp['amp-frontpage-select-option-pages'] = $post_id;
		update_option( 'redux_builder_amp', $redux_builder_amp );
	}

	if(!defined('LEVELUP_SYNC_DESIGN_URL')){
		define( 'LEVELUP_SERVER_URL', 'http://levelup.magazine3.company' );
		define( 'LEVELUP_API_url', LEVELUP_SERVER_URL.'/wp-json/' );
		define( 'LEVELUP_SYNC_DESIGN_URL', LEVELUP_API_url.'elementor_design_layout/v1/get-elementor-designs' );
	}
	 $settings = get_option('levelup_library_settings');
    $response = wp_remote_post( LEVELUP_SYNC_DESIGN_URL,array(
                                    'timeout'=> 120,
                                    'body'=>array(
                                        'api_key'   =>  $settings['api_key']
                                    )
                                )
                            );
    if ( is_array( $response ) ) {
    	$responseData = json_decode($response['body'],true);
    	foreach( $responseData['designs'] as $widgetType => $valCategory ){
            foreach( $valCategory['layouts'] as $key => $valDesigntype ){
            	$query = get_posts( array(
							        'posts_per_page' => -1,
							        'post_type' => $post_type,
							        'meta_query' => array(
											array(
							                'key' => 'design_unique_name',
							                'value' => $valDesigntype['design_markup_name'],
							                'compare' => '=',
											)
							            )
							        
							    ));
            	$post_id = $query[0]->ID;
            	$amp_html_markup = array('amp_html'=>$valDesigntype['amp_template_html'],
                                        'amp_css'=>$valDesigntype['amp_template_css']
                                    );
                $non_amp_html_markup = array('non_amp_html'=>$valDesigntype[
                    'non_amp_template_html'],
                                        'non_amp_css'=>$valDesigntype['non_amp_template_css']
                                    );
                update_post_meta( $post_id, 'amp_html_markup', $amp_html_markup );
                update_post_meta( $post_id, 'non_amp_html_markup', $non_amp_html_markup );
            }
        }
    
    }

}