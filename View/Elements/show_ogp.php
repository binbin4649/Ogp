<?php 
	$siteName = $this->BcBaser->getSiteName();
	$content = $this->BcBaser->getCurrentContent();
	$twitter_id = Configure::read('OGP.twitter_id');
	$facebook_app_id = Configure::read('OGP.facebook_app_id');
	
	$image_width = $image_height = $image_uri = '';
	$url = $this->BcBaser->getUri($this->BcBaser->getHere());
	
	if($this->BcBaser->isBlog() && !empty($post)){
		$title = $this->Blog->getPostTitle($post, false).' | '.$siteName;
		
		$description = $this->Blog->getTitle() . '｜' . $this->Blog->getPostContent($post, false, false, 50);
		if(!empty($post['BlogPost']['eye_catch'])){
			$uri = $this->Blog->getEyeCatch($post, array('link' => false, 'imgsize'=>'large', 'class'=>null, 'output'=>'url'));
			$uri = strtok( $uri, '?');
			$image_uri = $this->BcBaser->getUri($uri);
			$root_uri = WWW_ROOT.$uri;
			$root_uri = str_replace('//', '/', $root_uri);
			if(file_exists($root_uri)){
				$image_info = getimagesize($root_uri);
				$image_width = $image_info[0];
				$image_height = $image_info[1];
			}else{
				$image_uri = false;
			}
		}
	}else{
		if($this->BcBaser->isHome()){
			$title = $siteName;
		}else{
			$title = $content['title'].' | '.$siteName;
		}
		$description = $content['description'];
		if(!empty($content['eyecatch'])){
			$uri = $this->BcUpload->uploadImage('Content.eyecatch', $content['eyecatch'], array('imgsize'=>'large', 'link'=>false, 'output'=>'url'));
			$uri = strtok( $uri, '?');
			$image_uri = $this->BcBaser->getUri($uri);
			$root_uri = WWW_ROOT.$uri;
			$root_uri = str_replace('//', '/', $root_uri);
			if(file_exists($root_uri)){
				$image_info = getimagesize($root_uri);
				$image_width = $image_info[0];
				$image_height = $image_info[1];
			}else{
				$image_uri = false;
			}
		}
	}
	
	//アイキャッチがない場合はロゴを出力
	if(empty($image_uri)){
		$uri = $this->BcBaser->getThemeUrl().'img/logo.png';
		$image_uri = $this->BcBaser->getUri($uri);
		$root_uri = WWW_ROOT.$uri;
		$root_uri = str_replace('//', '/', $root_uri);
		if(file_exists($root_uri)){
			$image_info = getimagesize($root_uri);
			$image_width = $image_info[0];
			$image_height = $image_info[1];
		}else{
			$image_uri = false;
		}
	}
	
	if($this->BcBaser->isHome()){
		$type = 'website';
	}else{
		$type = 'article';
	}
	
?>
<meta property="og:title" content="<?php echo $title; ?>" />
<meta property="og:type" content="<?php echo $type; ?>" />
<meta property="og:description" content="<?php echo $description; ?>" />
<meta property="og:url" content="<?php echo $url; ?>" />
<?php if($image_uri): ?>
	<meta property="og:image" content="<?php echo $image_uri; ?>" />
	<meta property="og:image:width" content="<?php echo $image_width; ?>"/>
	<meta property="og:image:height" content="<?php echo $image_height; ?>"/>
<?php endif; ?>
<meta property="og:site_name" content="<?php echo $siteName; ?>" />
<meta property="og:locale" content="ja_JP" />
<meta property="og:locale:alternate" content="en_US" />
<?php if($twitter_id): ?>
	<meta name="twitter:card" content="summary">
	<meta name="twitter:site" content="@<?php echo $twitter_id; ?>">
<?php endif; ?>
<?php if($facebook_app_id): ?>
	<meta property="fb:app_id" content="<?php echo $facebook_app_id; ?>" />
<?php endif; ?>
