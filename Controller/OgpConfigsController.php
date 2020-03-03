<?php
App::uses('AppController', 'Controller');

class OgpConfigsController extends AppController {
  
  public $name = 'OgpConfigs';
  
  //public $uses = array();
  //public $ogp_configs = null;
  public $uses = array('Plugin', 'Ogp.OgpConfig');
  
  public $components = array('BcAuth', 'Cookie', 'BcAuthConfigure', 'BcManager');
  
  public function beforeFilter() {
    parent::beforeFilter();
  }
 
  public function admin_index() {
	  $this->pageTitle = 'OGP設定';
		if(!$this->request->data) {
			$this->request->data['OgpConfig'] = $this->OgpConfig->findExpanded();
		} else {
			if($this->OgpConfig->saveKeyValue($this->request->data)){
				$this->setMessage('OGP設定を保存しました。');
			}else{
				$this->setMessage('エラー', true);
			}
		}
	  $twitter_cards = ['summary'=>'summary','summary_large_image'=>'summary_large_image','photo'=>'photo','gallery'=>'gallery','app'=>'app'];
	  $this->set('twitter_cards', $twitter_cards);
  }
  
}