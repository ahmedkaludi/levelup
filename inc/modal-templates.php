<script id="tmpl-levelup-library-templates" type="text/html">
  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="levelup-close eicon-close close"></span>
      	<ul class="nav">
		  	<li><a class="active" href="/"><?php echo esc_html__('Category Module',LEVELUP_TEXT_DOMAIN); ?> (<%= layouts.length %> <?php echo esc_html__('Designs',LEVELUP_TEXT_DOMAIN) ?>)</a></li>
		  	
		</ul>
    </div>
    <div class="modal-body">
    	<div class="row" id="levelup-designs-container">
               <div class="">
                   <strong>LevelUP</strong>. is installed but not yet configured, you need to configure here -  <a href="<?php echo esc_url('admin.php?page=levelup_settings',LEVELUP_TEXT_DOMAIN); ?>" class="button button-secondary button-hero" style="color: #f5faff;padding: 8px 15px;background: #5ab75a;border-radius: 40px;"><?php echo esc_html__('Finish Setup',LEVELUP_TEXT_DOMAIN); ?></a>
               </div>
        </div>
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