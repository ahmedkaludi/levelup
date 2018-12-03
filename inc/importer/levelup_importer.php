<?php
require_once LEVELUP__FILE__PATH.'inc/importer/vendor/vendor_importer.php';
add_filter( 'levelup_import/import_files', 'demo_designs_import_files'  );

function demo_designs_import_files(){
	return array(
			array(
				'import_file_name'           => 'Bolts Construction',
				'import_file_url'            => 'http://artifacts.proteusthemes.com/xml-exports/bolts-latest.xml',
				'import_widget_file_url'     => 'http://artifacts.proteusthemes.com/json-widgets/bolts-construction-ptcs.json',
				'import_customizer_file_url' => 'http://artifacts.proteusthemes.com/customizer-exports/bolts-construction.dat',
				'import_preview_image_url'   => 'http://artifacts.proteusthemes.com/import-preview-images/bolts-construction.jpg',
				'preview_url'                => 'https://demo.proteusthemes.com/bolts',
			),
		);
}