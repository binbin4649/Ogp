<?php

class OgpsController extends OgpAppController {
  
  public $name = 'Ogps';
  
  public $uses = array('Ogp.Ogp');
  //public $ogp = null;
  
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
	  $data['OGP']['default_image'] = Configure::read('OGP.default_image');
	  $data['OGP']['locale'] = Configure::read('OGP.locale');
	  $data['OGP']['locale_alternate'] = Configure::read('OGP.locale_alternate');
	  if ($this->data) {
		  if ($writableInstall) {
			  $data = $this->data;
			  $this->BcManager->setInstallSetting('OGP.twitter_id', "'" . $data['OGP']['twitter_id'] . "'");
			  $this->BcManager->setInstallSetting('OGP.twitter_card', "'" . $data['OGP']['twitter_card'] . "'");
			  $this->BcManager->setInstallSetting('OGP.facebook_app_id', "'" . $data['OGP']['facebook_app_id'] . "'");
			  $this->BcManager->setInstallSetting('OGP.default_image', "'" . $data['OGP']['default_image'] . "'");
			  $this->BcManager->setInstallSetting('OGP.locale', "'" . $data['OGP']['locale'] . "'");
			  $this->BcManager->setInstallSetting('OGP.locale_alternate', "'" . $data['OGP']['locale_alternate'] . "'");
			  $this->setMessage('OGP設定を保存しました。');
		  }
	  }
	  if(empty($data['OGP']['locale'])){
		  $data['OGP']['locale'] = 'ja_JP';
	  }
	  if(empty($data['OGP']['locale_alternate'])){
		  $data['OGP']['locale_alternate'] = 'en_US';
	  }
	  $twitter_cards = ['summary'=>'summary','summary_large_image'=>'summary_large_image','photo'=>'photo','gallery'=>'gallery','app'=>'app'];
	  $this->set('twitter_cards', $twitter_cards);
	  $this->set('OGP', $data);
  }
  
}