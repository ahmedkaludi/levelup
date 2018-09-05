<script id="tmpl-elementor-plus-library-templates" type="text/html">
  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="eplus-close eicon-close close"></span>
      	<ul class="nav">
		  	<li><a class="active" href="/">Category Module (<%= layouts.length %> Designs)</a></li>
		  	
		</ul>
    </div>
    <div class="modal-body">
    	
		<div class="row" id="elementor-plus-designs-container">
			<% if(layouts) { %>
              
                <% _(layouts).each(function(data) { %>
                <div class="column">
					<div class="img-content">
                    <div class="elementor-plus-design-wrapper">
                        <span class="ep-elementor-design-btn ep-elementor-design" data-template-id="<%= data.designId %>">Insert</span>
                        <span class="ep-elementor-design-preview"><a href="#">Preview</a></span>
                    </div>
						<img src="<%= data.designImage%>" />
					</div>
					<div class="ep-elementor-design-text" >
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
    <?php do_action("elementor_plus_modal_style"); ?>
</style>
</script>