<?php

class OgpControllerEventListener extends BcControllerEventListener {
	
	public $events = array(
		'initialize'
		);
		
	public function initialize(CakeEvent $event) {
		$Controller = $event->subject();
		$Controller->helpers[] = 'Ogp.Ogp';
	}
	
}