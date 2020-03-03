<?php

class OgpModelEventListener extends BcModelEventListener {
	
	public $events = array(
        'Blog.BlogPost.afterSave',
        'Blog.BlogPost.beforeFind',
        'Page.afterSave',
        'Page.beforeFind'
    );
    
    public function blogBlogPostAfterSave(CakeEvent $event) {
        $BlogPost = $event->subject();
        $data = $BlogPost->data;
        // 入力があれば保存する
        if(
        	!empty($data['Ogp']['id']) ||
        	!empty($data['Ogp']['title']) ||
        	!empty($data['Ogp']['description']) ||
        	!empty($data['Ogp']['image'])
         ){
	        $data['Ogp']['blog_post_id'] = $data['BlogPost']['id'];
	        $Ogp = ClassRegistry::init('Ogp.Ogp');
	        $Ogp->save($data['Ogp']);
	        return true;
        }
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
	        $Ogp->save($data['Ogp']);
	        return true;
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