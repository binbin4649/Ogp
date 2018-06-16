<?php

class OgpHelper extends AppHelper {
	public $helpers = array('BcBaser', 'BcHtml');
	
	public function showOgp(){
		
		$this->BcBaser->element('Ogp.show_ogp', array('plugin' => 'Ogp'));
	}
}