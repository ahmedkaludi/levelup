<?php
require_once LEVELUP__FILE__PATH.'inc/importer/vendor/vendor_importer.php';
require_once LEVELUP__FILE__PATH.'inc/composite-menu.php';
add_filter( 'levelup_import/import_files', 'demo_designs_import_files'  );

function demo_designs_import_files(){
	return array(
			array(
				'import_file_name'           => 'Bolts Construction',
				'import_file_url'            => 'http://localhost/import/2018-12-15.xml',
				'import_widget_file_url'     => '',
				'import_customizer_file_url' => 'http://localhost/import/level-up-export.dat',
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
	}
}