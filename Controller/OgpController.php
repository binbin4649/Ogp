<?php

class OgpsController extends OgpAppController {
  
  public $name = 'Ogps';
  
  public $uses = array('Ogp.Ogp');
  //public $ogp = null;
  
  public $components = array('BcAuth', 'Cookie', 'BcAuthConfigure', 'BcManager');
  
  public function beforeFilter() {
    parent::beforeFilter();
  }
 

  
}