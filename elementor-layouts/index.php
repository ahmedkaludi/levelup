<?php
$path = getcwd();
$designs = array('design1','design2');
$designData = '';
$dir = $path."/layouts/";
if (is_dir($dir)){
  	if ($dh = opendir($dir)){
		while (($file = readdir($dh)) !== false){
			if( strpos($file, '-layout') == true ){
				if ($designfile = opendir($dir.$file)){
					while( ($designFile = readdir($designfile) ) !== false){
						if(is_file($dir.$file.'/'.$designFile) && strpos($designFile, '-layout.php') == true){
							$designData[str_replace("-layout.php", "", $designFile)] = include $dir.$file.'/'.$designFile;
						}
					}
				}
			}
		}
	echo json_encode($designData);
	closedir($dh);
  	}
}


?>