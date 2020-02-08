<?php

class OgpHelper extends AppHelper {
	public $helpers = array('BcBaser', 'BcHtml');
	
	public function showOgp(){
		$this->BcBaser->element('Ogp.show_ogp', array('plugin' => 'Ogp'));
	}
	
	public function ogpImageInfo($uri){
		$image_uri = $root_uri = $image_width = $image_height = false;
		$image_uri = $this->BcBaser->getUri($uri);
		$root_uri = WWW_ROOT.$uri;
		$root_uri = str_replace('//', '/', $root_uri);
		if(is_file($root_uri)){
			$image_info = getimagesize($root_uri);
			$image_width = $image_info[0];
			$image_height = $image_info[1];
		}else{
			$image_uri = false;
		}
		$return = [
			'image_uri' => $image_uri,
			'root_uri' => $root_uri,
			'image_width' => $image_width,
			'image_height' => $image_height
		];
		return $return;
	}
}