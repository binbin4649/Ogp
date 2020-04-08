<?php

class OgpHelper extends AppHelper {
	public $helpers = array('BcBaser', 'BcHtml', 'Blog', 'BcUpload');
	
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
	
	public function ogpImageInfoFullUrl($uri){
		$image_uri = $root_uri = $image_width = $image_height = false;
		$image_info = @getimagesize($uri);
		if(!empty($image_info[0])){
			$image_width = $image_info[0];
			$image_height = $image_info[1];
			$image_uri = $uri;
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
	
	public function ogpInfo(){
		$OgpConfig = ClassRegistry::init('Ogp.OgpConfig');
		$return = [];
		if($OgpConfig->find('count') > 1){
			$configs = $OgpConfig->find('all');
			foreach($configs as $config){
				$return[$config['OgpConfig']['name']] = $config['OgpConfig']['value'];
			}
		}
		if(empty($return)){
			$return = [
				'locale' => '',
				'locale_alternate' => '',
				'twitter_id' => '',
				'facebook_app_id' => '',
			];
		}
		return $return;
	}
	
	public function defaultImage(){
		$image_info['image_uri'] = false;
		$ogpInfo = $this->ogpInfo();
		if(!empty($ogpInfo['default_image'])){
			//webroot/img にデフォルトイメージがあるか？
			$uri = '/img/'.$ogpInfo['default_image'];
			$image_info = $this->ogpImageInfo($uri);
			// テーマ内にデフォルトイメージがあるか？
			if(!$image_info['image_uri']){
				$uri = $this->BcBaser->getThemeUrl().'img/'.$ogpInfo['default_image'];
				$image_info = $this->ogpImageInfo($uri);
			}
		}
		// それでもなければロゴ出す
		if(!$image_info['image_uri']){
			$uri = $this->BcBaser->getThemeUrl().'img/logo.png';
			$image_info = $this->ogpImageInfo($uri);
		}
		return $image_info;
	}
	
	public function ogpBlog($post){
		$title = $description = $uri = $image_info = '';
		$siteName = $this->BcBaser->getSiteName();
		$Ogp = ClassRegistry::init('Ogp.Ogp');
		$current_ogp = $Ogp->find('first', ['conditions'=>['Ogp.blog_post_id'=>$post['BlogPost']['id']]]);
		if($current_ogp){
			$title = $current_ogp['Ogp']['title'];
			$description = $current_ogp['Ogp']['description'];
			$image_info = $this->ogpImageInfoFullUrl($current_ogp['Ogp']['image']);
		}
		if(empty($title)){
			$title = $this->Blog->getPostTitle($post, false).' | '.$siteName;
		}
		if(empty($description)){
			$description = $this->Blog->getTitle() . '｜' . $this->Blog->getPostContent($post, true, false, 50);
		}
		if(empty($image_info['image_uri'])){
			if(!empty($post['BlogPost']['eye_catch'])){
				$uri = $this->Blog->getEyeCatch($post, array('link' => false, 'imgsize'=>'large', 'class'=>null, 'output'=>'url'));
				$uri = strtok( $uri, '?');
				$image_uri = $this->BcBaser->getUri($uri);
				$image_info = $this->ogpImageInfoFullUrl($image_uri);
			}else{
				$image_info = $this->defaultImage();
			}
		}
		$return = [
			'siteName' => $siteName,
			'title' => $title,
			'description' => $description,
			'uri' => $uri,
			'image_uri' => $image_info['image_uri'],
			'root_uri' => $image_info['root_uri'],
			'image_width' => $image_info['image_width'],
			'image_height' => $image_info['image_height']
		];
		return $return;
	}
	
	public function ogpPage(){
		$title = $description = $uri = $image_info = '';
		$siteName = $this->BcBaser->getSiteName();
		$page = $this->request->data['Page'];
		$Ogp = ClassRegistry::init('Ogp.Ogp');
		$current_ogp = $Ogp->find('first', ['conditions'=>['Ogp.page_id'=>$page['id']]]);
		if($current_ogp){
			$title = $current_ogp['Ogp']['title'];
			$description = $current_ogp['Ogp']['description'];
			$image_info = $this->ogpImageInfoFullUrl($current_ogp['Ogp']['image']);
		}
		if(empty($title)){
			if($this->BcBaser->isHome()){
				$title = $siteName;
			}else{
				$title = $page['title'].' | '.$siteName;
			}
		}
		if(empty($description)){
			$description = $this->BcBaser->getDescription();
		}
		if(empty($image_info['image_uri'])){
			if(!empty($page['eyecatch'])){
				$uri = $this->BcUpload->uploadImage('Content.eyecatch', $page['eyecatch'], array('imgsize'=>'large', 'link'=>false, 'output'=>'url'));
				$uri = strtok( $uri, '?');
				$image_info = $this->ogpImageInfo($uri);
			}else{
				$image_info = $this->defaultImage();
			}
		}
		$return = [
			'siteName' => $siteName,
			'title' => $title,
			'description' => $description,
			'uri' => $uri,
			'image_uri' => $image_info['image_uri'],
			'root_uri' => $image_info['root_uri'],
			'image_width' => $image_info['image_width'],
			'image_height' => $image_info['image_height']
		];
		return $return;
	}
	
}