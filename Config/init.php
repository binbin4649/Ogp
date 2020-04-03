<?php
$BcSite = Configure::read('BcSite');
if(substr($BcSite['version'], 0, 1) == '3'){
	$this->Plugin->initDb('plugin', 'Ogp', array('dbDataPattern'	=> $dbDataPattern));
}else{
	$this->Plugin->initDb('Ogp');
}

/*
$OgpConfig = ClassRegistry::init('Ogp.OgpConfig');
$first_data = array(
    'OgpConfig' => array(
        0 => array(
            'name' => 'add_blog',
            'value' => '0'
        ),
        1 => array(
            'name' => 'add_content',
            'value' => '0'
        ),
        2 => array(
            'name' => 'locale',
            'value' => ''
        ),
        3 => array(
            'name' => 'locale_alternate',
            'value' => ''
        ),
        4 => array(
            'name' => 'twitter_id',
            'value' => ''
        ),
        5 => array(
            'name' => 'facebook_app_id',
            'value' => ''
        )
    )
);
$OgpConfig->saveAll($first_data['OgpConfig']);
*/