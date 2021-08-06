<?php	
	require_once 'extension.php';
	function showAll($path, &$newString ,$arrExtension){
		$data	= scandir($path);
		
		$newString .= '<ul style ="list-style : none">';
		foreach($data as $value){
			if($value != '.' && $value != '..'){
				$dir	= $path . '/' . $value;
				$img = 'sustainable.png';
				if(is_dir($dir)){
					$img = 'folder.png';
					$level = count(explode('/',$dir))-1;
					$level = "<span style ='font-weight : bold;color: red;background-color : turquoise;border-radius:50%;padding:0px 5px'>$level</span>";
					$newString .= sprintf('<li><img src="./images/%s" />%s-%s',$img,$value,$level); 
					showAll($dir, $newString,$arrExtension);
					$newString .= '</li>';
				}else{
					$ext = pathinfo($dir,PATHINFO_EXTENSION);	
					foreach ($arrExtension as $extensionKey => $extensionValue) {
						if(in_array($ext,$extensionValue)){
							$img =$extensionKey ;
							break;
						}
					}
					$newString .= sprintf('<li><img src="./images/%s" />%s</li>',$img,$value);
				}
			}
		}
		$newString .= '</ul>';		
	}
	
	showAll('.', $newString,$arrExtension);
	echo $newString;
	
	
	
	
	
	
	

	
