<script id="tmpl-elementor-plus-library-templates" type="text/html">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="eplus-close eicon-close close"></span>
      	<ul class="nav">
		  	<li><a class="active" href="/">Category Module (7 Designs)</a></li>
		  	
		</ul>
    </div>
    <div class="modal-body">
    	
		<div class="row" id="elementor-plus-designs-container">
			<% if(layouts) { %>
              
                <% _(layouts).each(function(data) { %>
                <div class="column">
					<div class="img-content">
                    <div class="elementor-plus-design-wrapper">
                        <span class="ampforwp-elementor-design-btn ampforwp-elementor-design" data-template-id="<%= data.designId %>">Insert</span>
                        <span class="ampforwp-elementor-design-preview"><a href="#">Preview</a></span>
                    </div>
						<img src="<%= data.designImage%>" />
					</div>
					<div class="" >
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

<style>
/* Create four equal columns that floats next to each other */
.img-name{
	height: 44px;
	background-color:#ddd;
	border-bottom-left-radius: 10px;
	border-bottom-right-radius: 10px;
}
.img-content{
    position: relative;
}
.img-content img{width:100%;height:auto}

.column:hover{
	 box-shadow: 0 3px 18px 0 rgba(0, 0, 0, 0.07), 0 5px 20px 0 rgba(0, 0, 0, 0.1);
}
.column {
    transition: .15s;
    float: left;
    width: 31%;
    margin: 1.16%;
    margin-bottom:1%;
    border: 3px solid #ddd;
}

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}

.modal {
    
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding: 15px 0px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
    position: relative;
    background-color: #f1f3f5;
    height: 96vh;
    margin: auto;
    padding: 0;
    overflow: hidden;
    border: 1px solid #888;
    border-radius: 6px;
    width: 80%;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s;
}

/* Add Animation */
@-webkit-keyframes animatetop {
    from {top:-300px; opacity:0} 
    to {top:0; opacity:1}
}

@keyframes animatetop {
    from {top:-300px; opacity:0}
    to {top:0; opacity:1}
}

/* The Close Button */
.eplus-close {
    position: absolute;
    right: 0;
    padding: 16px;
    font-size: 18px;
    color: #a4afb7;
    cursor:pointer
}
 

/* The Modal Header, Footer and Body*/
.modal-header {
    height: 50px;
    background-color: #fff;
    -webkit-box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
    box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
}

.modal-body {
    max-height: 90vh;
    height: auto;
    overflow: scroll;
    padding: 15px;
    }

.modal-footer {
    padding: 10px 10px;
    color: white;
    border-bottom-right-radius: 6px;
    border-bottom-left-radius: 6px;
    height: 50px;
    width: 100%;
    bottom: 0;
    position: absolute;}

/* Navigation Menu Css*/
.nav{
    /*border:1px solid #ccc;*/
    /*border-width:1px 0;*/
    list-style:none;
    margin:0;
    padding:0;
    text-align:center;
}
.nav li{
    display:inline;
}
.nav a{
    display: inline-block;
    padding: 17px 30px;
    border-bottom: 3px solid transparent;
    font-weight: 500;
    color: #6d7882;
    font-size: 13px;
}
.nav a:hover {
}
.nav a.active {
    background-image: -webkit-gradient(linear, left top, left bottom, from(#f3f3f3), to(#fff));
    background-image: -webkit-linear-gradient(top, #f3f3f3, #fff);
    background-image: -o-linear-gradient(top, #f3f3f3, #fff);
    background-image: linear-gradient(to bottom, #f3f3f3, #fff);
    border-bottom: 3px solid #9b0a46;
    }
.elementor-plus-design-wrapper{
    position: absolute;
    width: 100%;
    text-align: center;
    padding: 10px;
    height:100%;
    display:none;
    background: #0000007d; 
}
.column:hover .elementor-plus-design-wrapper{
    display:block
}
.ampforwp-elementor-design-btn, .ampforwp-elementor-design-preview{
    margin: 5px;
    background: #fff;
    border-radius: 40px;
    position: relative;
    top: 50%;
    font-size: 16px;
}
.ampforwp-elementor-design-btn{
    padding:8px 15px;
}
.ampforwp-elementor-design-preview a{
    color:#6d7882;
    padding:8px 15px;    background: #fff;
    border-radius: 40px;
}
.ampforwp-elementor-design {
    text-align: center;
    padding: 8px;
    background: #fff;
}

</style>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('.img-name').hover(function(){
			$main_text = $(this).text();
			$(this).html("<a href=''>&#8686; Insert</a>");
		},function(){
			$(this).html($main_text);
		});
	});
</script>>
</script>

<script id="modal-view-template" type="text/html">
  <div class="modal-header">
    <h2>This is a modal!</h2>
  </div>
  <div class="modal-body">
    <p>With some content in it!</p>
  </div>
  <div class="modal-footer">
    <button class="btn">cancel</button>
    <button class="btn-default">Ok</button>
  </div>
</script>

<div id="modal"></div>