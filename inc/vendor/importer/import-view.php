<?php
namespace LUIMPORT;
$importerObj = OneClickDemoImport::get_instance();
$predefined_themes = $importerObj->import_files;

if ( ! empty( $importerObj->import_files ) && isset( $_GET['import-mode'] ) && 'manual' === $_GET['import-mode'] ) {
	$predefined_themes = array();
}
?>

<div class="levelup levelup_import_screen">
	<h2 class="levelup_import_title"><?php esc_html_e( 'Design Templates', LEVELUP_TEXT_DOMAIN ); ?></h2>
 	<p class="levelup_import_desc"><?php esc_html_e( 'You can import the pre-built demos with just one click. To get started, Browse the gallery below and click Import.', LEVELUP_TEXT_DOMAIN ); ?></p>
	
	<?php if ( empty( $importerObj->import_files ) ) : ?>
		<div class="notice  notice-info  is-dismissible">
			<p><?php esc_html_e( 'There are no predefined import files available in this theme. Please upload the import files manually!', LEVELUP_TEXT_DOMAIN ); ?></p>
		</div>
	<?php endif; 

	?>


		<!-- OCDI grid layout -->
		<div class="levelup_gl  js-levelup-gl">
		<?php
			// Prepare navigation data.
			$categories = Helpers::get_all_demo_import_categories( $predefined_themes );
		?>
			<?php if ( ! empty( $categories ) ) : ?>
				<div class="levelup_gl-header  js-levelup-gl-header">
					<nav class="levelup_gl-navigation">
						<ul>
							<li class="active"><a href="#all" class="levelup_gl-navigation-link  js-levelup-nav-link"><?php esc_html_e( 'All', LEVELUP_TEXT_DOMAIN ); ?></a></li>
							<?php foreach ( $categories as $key => $name ) : ?>
								<li><a href="#<?php echo esc_attr( $key ); ?>" class="levelup_gl-navigation-link  js-levelup-nav-link"><?php echo esc_html( $name ); ?></a></li>
							<?php endforeach; ?>
						</ul>
					</nav>
					<div clas="levelup_gl-search">
						<input type="search" class="levelup_gl-search-input  js-levelup-gl-search" name="ocdi-gl-search" value="" placeholder="<?php esc_html_e( 'Search demos...', LEVELUP_TEXT_DOMAIN ); ?>">
					</div>
				</div>
			<?php endif; ?>
			<div class="levelup_gl-item-container  wp-clearfix  js-levelup-gl-item-container">
				<?php foreach ( $predefined_themes as $index => $import_file ) : ?>
					<?php
						// Prepare import item display data.
						$img_src = isset( $import_file['import_preview_image_url'] ) ? $import_file['import_preview_image_url'] : '';
						// Default to the theme screenshot, if a custom preview image is not defined.
						if ( empty( $img_src ) ) {
							$theme = wp_get_theme();
							$img_src = $theme->get_screenshot();
						}

					?>
					<div class="levelup_gl-item js-levelup-gl-item" data-categories="<?php echo esc_attr( Helpers::get_demo_import_item_categories( $import_file ) ); ?>" data-name="<?php echo esc_attr( strtolower( $import_file['import_file_name'] ) ); ?>">
						<div class="levelup_gl-item-image-container">
							<?php if ( ! empty( $img_src ) ) : ?>
								<img class="levelup_gl-item-image" src="<?php echo esc_url( $img_src ) ?>">
							<?php else : ?>
								<div class="levelup_gl-item-image  levelup_gl-item-image--no-image"><?php esc_html_e( 'No preview image.', LEVELUP_TEXT_DOMAIN ); ?></div>
							<?php endif; ?>
						</div>
						<div class="levelup_gl-item-footer<?php echo ! empty( $import_file['preview_url'] ) ? '  levelup_gl-item-footer--with-preview' : ''; ?>">
							<h4 class="levelup_gl-item-title" title="<?php echo esc_attr( $import_file['import_file_name'] ); ?>"><?php echo esc_html( $import_file['import_file_name'] ); ?></h4>
							<button class="levelup_gl-item-button  button  button-primary  js-levelup-gl-import-data" value="<?php echo esc_attr( $index ); ?>"><?php esc_html_e( 'Import', LEVELUP_TEXT_DOMAIN ); ?></button>
							<?php if ( ! empty( $import_file['preview_url'] ) ) : ?>
								<a class="levelup_gl-item-button  button" href="<?php echo esc_url( $import_file['preview_url'] ); ?>" target="_blank"><?php esc_html_e( 'Preview', LEVELUP_TEXT_DOMAIN ); ?></a>
							<?php endif; ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>

		<div id="js-levelup-modal-content"></div>


	<p class="levelup_ajax-loader  js-levelup-ajax-loader">
		<span class="spinner"></span> <?php esc_html_e( 'Importing, please wait!', LEVELUP_TEXT_DOMAIN ); ?>
	</p>

	<div class="levelup_response  js-levelup-ajax-response"></div>
</div>
