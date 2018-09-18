/* Create four equal columns that floats next to each other */
#levelup-modalContainer .img-name{
	height: 44px;
	background-color:#ddd;
	border-bottom-left-radius: 10px;
	border-bottom-right-radius: 10px;
}
#levelup-modalContainer .img-content{
    position: relative;
}
#levelup-modalContainer .img-content img{width:100%;height:auto}

#levelup-modalContainer .column:hover{
	 box-shadow: 0 3px 18px 0 rgba(0, 0, 0, 0.07), 0 5px 20px 0 rgba(0, 0, 0, 0.1);
}
#levelup-modalContainer .column {
    transition: .15s;
    float: left;
    width: 31%;
    margin: 1.16%;
    margin-bottom:1%;
    border: 3px solid #ddd;
}

/* Clear floats after the columns */
#levelup-modalContainer .row:after {
    content: "";
    display: table;
    clear: both;
}

#levelup-modalContainer .modal {
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
#levelup-modalContainer .modal-content {
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
#levelup-modalContainer .levelup-close {
    position: absolute;
    right: 0;
    padding: 16px;
    font-size: 18px;
    color: #a4afb7;
    cursor:pointer
}
 

/* The Modal Header, Footer and Body*/
#levelup-modalContainer .modal-header {
    height: 50px;
    background-color: #fff;
    -webkit-box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
    box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
}

#levelup-modalContainer .modal-body {
    max-height: 90vh;
    height: auto;
    overflow: scroll;
    padding: 15px;
    }

#levelup-modalContainer .modal-footer {
    padding: 10px 10px;
    color: white;
    border-bottom-right-radius: 6px;
    border-bottom-left-radius: 6px;
    height: 50px;
    width: 100%;
    bottom: 0;
    position: absolute;}

/* Navigation Menu Css*/
#levelup-modalContainer .nav{
    /*border:1px solid #ccc;*/
    /*border-width:1px 0;*/
    list-style:none;
    margin:0;
    padding:0;
    text-align:center;
}
#levelup-modalContainer .nav li{
    display:inline;
}
#levelup-modalContainer .nav a{
    display: inline-block;
    padding: 17px 30px;
    border-bottom: 3px solid transparent;
    font-weight: 500;
    color: #6d7882;
    font-size: 13px;
}
#levelup-modalContainer .nav a:hover {
}
#levelup-modalContainer .nav a.active {
    background-image: -webkit-gradient(linear, left top, left bottom, from(#f3f3f3), to(#fff));
    background-image: -webkit-linear-gradient(top, #f3f3f3, #fff);
    background-image: -o-linear-gradient(top, #f3f3f3, #fff);
    background-image: linear-gradient(to bottom, #f3f3f3, #fff);
    border-bottom: 3px solid #9b0a46;
    }
#levelup-modalContainer .levelup-design-wrapper{
    position: absolute;
    width: 100%;
    text-align: center;
    padding: 10px;
    height:100%;
    display:none;
    background: #0000007d; 
}
#levelup-modalContainer .column:hover .levelup-design-wrapper{
    display:block
}
#levelup-modalContainer .levelup-elementor-design-btn, .levelup-elementor-design-preview{
    margin: 5px;
    background: #fff;
    border-radius: 40px;
    position: relative;
    top: 50%;
    font-size: 16px;
    cursor:pointer;
}
#levelup-modalContainer .levelup-elementor-design-btn{
    padding:8px 15px;
}
#levelup-modalContainer .levelup-elementor-design-preview a{
    color:#6d7882;
    padding:8px 15px;    background: #fff;
    border-radius: 40px;
}
#levelup-modalContainer .levelup-elementor-design-text {
    text-align: center;
    padding: 8px;
    background: #fff;
}
.levelup-message-label{
    BACKGROUND: #FFF9C4;
    DISPLAY: INLINE-BLOCK;
    WIDTH: 97.5%;
    TEXT-ALIGN: CENTER;
    PADDING: 15PX;
    BORDER: 1PX SOLID #e6dfa2;
    MARGIN: 0 13PX;
}
.levelup-message-btn{
    color: #FFF;padding: 6px 12px;background: #4CAF50;border-radius: 50px;
}