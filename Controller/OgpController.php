<?php
App::uses('AppController', 'Controller');

class OgpController extends AppController {
  
  public $name = 'Ogp';
  
  public $uses = array();
  public $ogp = null;
  
  public $components = array('BcAuth', 'Cookie', 'BcAuthConfigure', 'BcManager');
  
  public function beforeFilter() {
    parent::beforeFilter();
  }
 
  public function admin_index() {
	  $writableInstall = is_writable(APP . 'Config' . DS . 'install.php');
	  if(!$writableInstall) $this->setMessage('install.php に書き込み権限がありません。', true);
	  $data['OGP']['twitter_id'] = Configure::read('OGP.twitter_id');
	  $data['OGP']['twitter_card'] = Configure::read('OGP.twitter_card');
	  $data['OGP']['facebook_app_id'] = Configure::read('OGP.facebook_app_id');
	  if ($this->data) {
		  if ($writableInstall) {
			  $data = $this->data;
			  $this->BcManager->setInstallSetting('OGP.twitter_id', "'" . $data['OGP']['twitter_id'] . "'");
			  $this->BcManager->setInstallSetting('OGP.twitter_card', "'" . $data['OGP']['twitter_card'] . "'");
			  $this->BcManager->setInstallSetting('OGP.facebook_app_id', "'" . $data['OGP']['facebook_app_id'] . "'");
			  $this->setMessage('OGP設定を保存しました。');
		  }
	  }
	  $twitter_cards = ['summary'=>'summary','summary_large_image'=>'summary_large_image','photo'=>'photo','gallery'=>'gallery','app'=>'app'];
	  $this->set('twitter_cards', $twitter_cards);
	  $this->set('OGP', $data);
  }
  
}