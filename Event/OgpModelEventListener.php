<?php

class OgpModelEventListener extends BcModelEventListener {
	
	public $events = array(
        'Blog.BlogPost.afterSave',
        'Blog.BlogPost.beforeSave',
        'Blog.BlogPost.beforeFind',
        'Page.afterSave',
        'Page.beforeSave',
        'Page.beforeFind'
    );
    
    public function blogBlogPostBeforeSave(CakeEvent $event) {
	    $BlogPost = $event->subject();
		$data = $BlogPost->data;
	    $Ogp = ClassRegistry::init('Ogp.Ogp');
		$Ogp->set($data['Ogp']);
		return $Ogp->validates();
    }
    
    public function blogBlogPostAfterSave(CakeEvent $event) {
        $BlogPost = $event->subject();
        $data = $BlogPost->data;
        
        //$blog_post_id = $BlogPost->find('first', ['conditions'=>['BlogPost.no'=>'4']]);
        // 入力があれば保存する
        if(
        	!empty($data['Ogp']['id']) ||
        	!empty($data['Ogp']['title']) ||
        	!empty($data['Ogp']['description']) ||
        	!empty($data['Ogp']['image'])
         ){
	        $data['Ogp']['blog_post_id'] = $data['BlogPost']['id'];
	        $Ogp = ClassRegistry::init('Ogp.Ogp');
	        return $Ogp->save($data['Ogp']);
        }
    }
    
    public function pageBeforeSave(CakeEvent $event) {
	    $Page = $event->subject();
		$data = $Page->data;
	    $Ogp = ClassRegistry::init('Ogp.Ogp');
		$Ogp->set($data['Ogp']);
		return $Ogp->validates();
    }
    
    public function pageAfterSave(CakeEvent $event){
	    $Page = $event->subject();
	    $data = $Page->data;
	    if(
        	!empty($data['Ogp']['id']) ||
        	!empty($data['Ogp']['title']) ||
        	!empty($data['Ogp']['description']) ||
        	!empty($data['Ogp']['image'])
         ){
	        $data['Ogp']['page_id'] = $data['Page']['id'];
	        $Ogp = ClassRegistry::init('Ogp.Ogp');
	        return $Ogp->save($data['Ogp']);
        }
    }
    
    public function blogBlogPostBeforeFind(CakeEvent $event) {
        $BlogPost = $event->subject();
        $BlogPost->bindModel(array('hasOne' => array(
            'Ogp' => array(
                'className' => 'Ogp.Ogp',
                'foreignKey' => 'blog_post_id',
            )
        )), false);   
    }
    
    public function pageBeforeFind(CakeEvent $event) {
        $Page = $event->subject();
        $Page->bindModel(array('hasOne' => array(
            'Ogp' => array(
                'className' => 'Ogp.Ogp',
                'foreignKey' => 'page_id',
            )
        )), false);   
    }
    
}