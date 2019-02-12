<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly?>
<script id="tmpl-levelup-library-templates" type="text/html">
  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="levelup-close eicon-close close"></span>
      	<ul class="nav">
		  	<li><a class="active" href="/"><%= name %> (<%= layouts.length %> <?php echo esc_html__('Designs',LEVELUP_TEXT_DOMAIN) ?>)</a></li>
		  	
		</ul>
    </div>
    <div class="modal-body">
        <?php
         $settings = get_option( 'levelup_library_settings',0);
         if($settings['api_key']==''){
        ?>
        <div class="row" id="levelup-designs-container">
               <div class="levelup-message-label">
                   <strong><?php echo esc_html__('LevelUP', LEVELUP_TEXT_DOMAIN); ?></strong> <?php echo esc_html__('is installed but not yet configured, you need to configure here'); ?>  <a target="_blank" href="<?php echo esc_url('admin.php?page=levelup',LEVELUP_TEXT_DOMAIN); ?>" class="button levelup-message-btn"><?php echo esc_html__('Finish Setup',LEVELUP_TEXT_DOMAIN); ?></a> 
               </div>
        </div>
    <?php } ?>
		<div class="row" id="levelup-designs-container">
			<% if(layouts) { %>
              
                <% _(layouts).each(function(data) { %>
                <div class="column">
					<div class="img-content">
                    <div class="levelup-design-wrapper">
                        <span class="levelup-elementor-design-btn levelup-elementor-design" data-template-id="<%= data.designId %>">Insert</span>
                        <span class="levelup-elementor-design-preview"><a href="<% if (typeof(data.designPreview) !== 'undefined') { %><%= data.designPreview %><% }else{ %><%= '#' %><% } %>" <% if (typeof(data.designPreview) !== 'undefined') { %><%= 'target="_blank"' %><% } %>> <?php echo esc_html__('Preview',LEVELUP_TEXT_DOMAIN) ?></a></span>
                    </div>
						<img src="<%= data.designImage%>" />
					</div>
					<div class="levelup-elementor-design-text" >
						<p><%= data.title %></p>
					</div>
				</div>
                <% }) %>
             
            <% } %>
			
		</div>
    </div>
    <div class="modal-footer">
      
    </div>
</div>
<style type="text/css">
    <?php do_action("levelup_modal_style"); ?>
</style>
</script>