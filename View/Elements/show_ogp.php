<?php 
	$siteName = $this->BcBaser->getSiteName();
	$content = $this->BcBaser->getCurrentContent();
	$twitter_id = Configure::read('OGP.twitter_id');
	$twitter_card = Configure::read('OGP.twitter_card');
	$facebook_app_id = Configure::read('OGP.facebook_app_id');
	$default_image = Configure::read('OGP.default_image');
	$locale = Configure::read('OGP.locale');
	$locale_alternate = Configure::read('OGP.locale_alternate');
	
	$image_width = $image_height = $image_uri = '';
	$url = $this->BcBaser->getUri($this->BcBaser->getHere());
	
	if($this->BcBaser->isBlog() && !empty($post)){
		$title = $this->Blog->getPostTitle($post, false).' | '.$siteName;
		
		$description = $this->Blog->getTitle() . '｜' . $this->Blog->getPostContent($post, false, false, 50);
		if(!empty($post['BlogPost']['eye_catch'])){
			$uri = $this->Blog->getEyeCatch($post, array('link' => false, 'imgsize'=>'large', 'class'=>null, 'output'=>'url'));
			$uri = strtok( $uri, '?');
			$image_info = $this->Ogp->ogpImageInfo($uri);
			extract($image_info);
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
			$image_info = $this->Ogp->ogpImageInfo($uri);
			extract($image_info);
		}
	}
	
	//アイキャッチがない場合、webroot/img にデフォルトイメージがあるか？
	if(empty($image_uri)){
		$uri = '/img/'.$default_image;
		$image_info = $this->Ogp->ogpImageInfo($uri);
		extract($image_info);
	}
	
	// テーマ内にデフォルトイメージがあるか？
	if(empty($image_uri)){
		$uri = $this->BcBaser->getThemeUrl().'img/'.$default_image;
		$image_info = $this->Ogp->ogpImageInfo($uri);
		extract($image_info);
	}
	
	// それでもなければロゴ出す
	if(empty($image_uri)){
		$uri = $this->BcBaser->getThemeUrl().'img/logo.png';
		$image_info = $this->Ogp->ogpImageInfo($uri);
		extract($image_info);
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
<?php if($locale): ?>
	<meta property="og:locale" content="<?php echo $locale; ?>" />
<?php else: ?>
	<meta property="og:locale" content="ja_JP" />
<?php endif; ?>
<?php if($locale_alternate): ?>
	<meta property="og:locale:alternate" content="<?php echo $locale_alternate; ?>" />
<?php else: ?>
	<meta property="og:locale:alternate" content="en_US" />
<?php endif; ?>
<?php if($twitter_id): ?>
	<?php if($twitter_card): ?>
		<meta name="twitter:card" content="<?php echo $twitter_card; ?>">
	<?php else: ?>
		<meta name="twitter:card" content="summary">
	<?php endif; ?>
	<meta name="twitter:site" content="@<?php echo $twitter_id; ?>">
<?php endif; ?>
<?php if($facebook_app_id): ?>
	<meta property="fb:app_id" content="<?php echo $facebook_app_id; ?>" />
<?php endif; ?>
