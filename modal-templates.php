<script id="tmpl-ampforwp-elementor-library-templates" type="text/html">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close"></span>
      	<ul class="nav">
		  	<li><a class="active" href="/">Home</a></li>
		  	<li><a href="/about/">About</a></li>
		  	<li><a href="/work/">Work</a></li>
		  	
		</ul>
    </div>
    <div class="modal-body">
		<div class="row">
			
			<div class="column" style="background-color:#aaa;">
				<h2>Column 1</h2>
				<p>Some text..</p>
			</div>
			
			<div class="column" style="background-color:#aaa;">
				<h2>Column 2</h2>
				<p>Some text..</p>
			</div>
			
			<div class="column" style="background-color:#aaa;">
				<h2>Column 3</h2>
				<p>Some text..</p>
			</div>
			
			<div class="column" style="background-color:#aaa;">
				<h2>Column 4</h2>
				<p>Some text..</p>
			</div>
			
		</div>
    </div>
    <div class="modal-footer">
      <h3>Modal Footer</h3>
    </div>
  </div>

<style>
/* Create four equal columns that floats next to each other */

.column {
    float: left;
    width: 220px;
    padding: 10px;
    height: 270px; /* Should be removed. Only for demonstration */
    margin:15px;
    border-radius: 10px;
    border-color: #ddd;
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
    padding-top: 15px; /* Location of the box */
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
	height: 520px;
    max-height: 85vh;
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
</style>
</script>