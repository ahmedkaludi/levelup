<script id="tmpl-ampforwp-elementor-library-templates" type="text/html">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close"></span>
      	<ul class="nav">
		  	<li><a class="active" href="/">Category Module (7 Designs)</a></li>
		  	
		</ul>
    </div>
    <div class="modal-body">
    	
		<div class="row" id="ampforwp-designs-container">
			<% if(layouts) { %>
              
                <% _(layouts).each(function(data) { %>
                <div class="column">
					<div class="img-content" style="background-image: url('<%= data.designImage%>');background-size: contain;">
						
					</div>
					<div class="ampforwp-elementor-design" data-template-id="<%= data.designId %>">
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
	height: 220px;
	/*background-color:#aaa;*/
	border-top-left-radius: 5px;
	border-top-right-radius: 5px;
}

.column:hover{
	 box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
.column {
    float: left;
    width: 220px;
    height: 270px; /* Should be removed. Only for demonstration */
    margin:15px;
    border-radius: 10px;
    border: 5px solid #ddd;
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
    background-color: #fefefe;
    margin: auto;
    padding: 0;
    border: 1px solid #888;
    border-radius: 6px;
    width: 80%;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s
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
.close:before{ content: '\2716'; }
.close {
    color: white;
    float: right;
    font-size: 18px;
    font-weight: bold;
    padding: 5px;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}

/* The Modal Header, Footer and Body*/
.modal-header {
    padding: 10px 10px;
    background-color: #5cb85c;
    color: white;
    border-top-left-radius: 6px;
    border-top-right-radius: 6px;
    height: 50px;
}

.modal-body {
	// height: 520px;
    max-height: 90vh;
    overflow: auto;
    padding: 25px 30px 30px;
}

.modal-footer {
    padding: 10px 10px;
    background-color: #5cb85c;
    color: white;
    border-bottom-right-radius: 6px;
    border-bottom-left-radius: 6px;
    height: 50px;
}

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
    display:inline-block;
    padding:12px;
    border-bottom: 3px solid transparent;
    color:#000;
    font-weight:900;
}
.nav a:hover {
  border-bottom: 3px solid red;
  color:#ddd;
}
.nav a.active {
  border-bottom: 3px solid red;
}
.ampforwp-elementor-design > p{
    text-align: center;
    cursor: pointer;
    padding-top: 13px;
    font-weight: 600;
    font-size: 16px;
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