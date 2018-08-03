<?php
$path = getcwd();
$designs = array('design1','design2');
$designData = '';
$allowedExt = array('jpg','png');

$config['base_url'] = '';
$config['base_url'] =  ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ?  "https" : "http");
$config['base_url'] .=  "://".$_SERVER['HTTP_HOST'];
$config['base_url'] .=  str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);

define('IMG_PATH',$config['base_url']);

$path = getcwd();
$designs = array('design1','design2');
$designData = '';
//for($i=0;$i<count($designs);$i++){
	$dir = $path."/layouts/";
	if (is_dir($dir)){
		$designReturn = array();
	  	if ($dh = opendir($dir)){
			while (($file = readdir($dh)) !== false){
				if(is_dir($dir.$file) && strpos($file, '-layout') == true){
					$designData = array();
					$name = str_replace( "-"," ",$file );
					$name = ucwords($name);
					
					$designData['id'] = $file;
					$designData['name'] = $name;
					
					$imagePath = $path."/layouts/".$file;
					if( $imgdir =  opendir($imagePath) ){
						while (($file = readdir($imgdir)) !== false){
							$ext = pathinfo($file, PATHINFO_EXTENSION);
	    					if(in_array($ext,$allowedExt)) {
	    						$designData['image'] = IMG_PATH.'/layouts/'.$designData['id'].'/'.$file;
	    					}
						}
						
						closedir($imgdir);
					}
					if( !isset($designData['image']) || $designData['image'] ==''){
						$designData['image'] = IMG_PATH.'/layouts/default.jpg';
					}
					$designReturn[] = $designData;
				}
			}
		echo json_encode($designReturn);
		closedir($dh);
	  	}
	}
//}

?>