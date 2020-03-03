<?php

class OgpHelperEventListener extends BcHelperEventListener {
	
	public $events = array(
        'Form.afterForm',
    );
	
	public function formAfterForm(CakeEvent $event) {
		$View = $event->subject();
		$OgpConfig = ClassRegistry::init('OgpConfig');
		$add_blog = $OgpConfig->find('first', ['conditions'=>['OgpConfig.name'=>'add_blog']])['OgpConfig']['value'];
		$add_content = $OgpConfig->find('first', ['conditions'=>['OgpConfig.name'=>'add_content']])['OgpConfig']['value'];
		
		$add_title = [
			'title' => 'OGPタイトル',
			'input' => 
				$View->BcForm->input('Ogp.id', array('type' => 'hidden')).
				$View->BcForm->input('Ogp.title', array('type' => 'text', 'size'=>'80'))
		];
		$add_description = [
			'title' => 'OGP詳細',
			'input' => 
				$View->BcForm->input('Ogp.description', array('type' => 'text', 'size'=>'80'))
		];
		$add_image = [
			'title' => 'OGPイメージ',
			'input' => 
				$View->BcForm->input('Ogp.image', array('type' => 'text', 'placeholder'=>'full url', 'size'=>'80'))
		];
		
		if($event->data['id'] == 'BlogPostForm' && $add_blog == '1') {//ブログ
			$event->data['fields'][] = $add_title;
			$event->data['fields'][] = $add_description;
			$event->data['fields'][] = $add_image;
		}
		if($event->data['id'] == 'PageAdminEditForm' && $add_content == '1') {//固定ページ
			$event->data['fields'][] = $add_title;
			$event->data['fields'][] = $add_description;
			$event->data['fields'][] = $add_image;
		}
	}
	
}