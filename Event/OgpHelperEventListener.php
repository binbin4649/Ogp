<?php
App::uses('BcAuthComponent',  'Controller/Component');

class OgpHelperEventListener extends BcHelperEventListener {
	
	public $events = array(
        'Form.afterForm',
    );
	
	public function formAfterForm(CakeEvent $event) {
		if(BcAuthComponent::user()){
			$View = $event->subject();
			$Plugin = ClassRegistry::init('Plugin');
	        $inOgp = $Plugin->findByName('Ogp');
	        if(!empty($inOgp) && $inOgp['Plugin']['status'] === true){
		        if($event->data['id'] == 'BlogPostForm' || $event->data['id'] == 'PageForm'){
					$OgpConfig = ClassRegistry::init('Ogp.OgpConfig');
					if(!empty($OgpConfig)){
						$add_blog = $OgpConfig->find('first', ['conditions'=>['OgpConfig.name'=>'add_blog']])['OgpConfig']['value'];
						$add_content = $OgpConfig->find('first', ['conditions'=>['OgpConfig.name'=>'add_content']])['OgpConfig']['value'];
					}else{
						$add_blog = '';
						$add_content = '';
					}
					if($add_blog == '1' || $add_content == '1'){
						$add_title = [
							'title' => 'OGPタイトル',
							'input' => 
								$View->BcForm->input('Ogp.id', array('type' => 'hidden')).
								$View->BcForm->input('Ogp.title', array('type' => 'text', 'size'=>'70')).
								$View->BcForm->error('Ogp.title')
						];
						$add_description = [
							'title' => 'OGP詳細',
							'input' => 
								$View->BcForm->input('Ogp.description', array('type' => 'text', 'size'=>'80')).
								$View->BcForm->error('Ogp.description')
						];
						$add_image = [
							'title' => 'OGPイメージ',
							'input' => 
								$View->BcForm->input('Ogp.image', array('type' => 'text', 'placeholder'=>'full url', 'size'=>'70')).
								$View->BcForm->error('Ogp.image')
						];
						
						if($event->data['id'] == 'BlogPostForm' && $add_blog == '1') {//ブログ
							$event->data['fields'][] = $add_title;
							$event->data['fields'][] = $add_description;
							$event->data['fields'][] = $add_image;
						}
						if($event->data['id'] == 'PageForm' && $add_content == '1') {//固定ページ
							$event->data['fields'][] = $add_title;
							$event->data['fields'][] = $add_description;
							$event->data['fields'][] = $add_image;
						}
					}
				}
	        }
		}
	}
	
}