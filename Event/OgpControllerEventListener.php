<?php

class OgpControllerEventListener extends BcControllerEventListener {
	
	public $events = array(
		'initialize'
		);
		
	public function initialize(CakeEvent $event) {
		$Controller = $event->subject();
		$Plugin = ClassRegistry::init('Plugin');
        $inOgp = $Plugin->findByName('Ogp');
        if(!empty($inOgp) && $inOgp['Plugin']['status'] === true){
	        $Controller->helpers[] = 'Ogp.Ogp';
        }
	}
	
}