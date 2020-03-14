<?php 
class OgpConfigsSchema extends CakeSchema {

	public $file = 'ogp_configs.php';

	public function before($event = array()) {
		return true;
	}

	public function after($event = array()) {
		$OgpConfig = ClassRegistry::init('OgpConfig');
		$first_data = [
			['OgpConfig' => [
				'name' => 'add_blog',
				'value' => '0'
			]],
			['OgpConfig' => [
				'name' => 'add_content',
				'value' => '0'
			]],
			['OgpConfig' => [
				'name' => 'locale',
				'value' => ''
			]],
			['OgpConfig' => [
				'name' => 'locale_alternate',
				'value' => ''
			]],
			['OgpConfig' => [
				'name' => 'twitter_id',
				'value' => ''
			]],
			['OgpConfig' => [
				'name' => 'facebook_app_id',
				'value' => ''
			]],
		];
		$OgpConfig->saveAll($first_data);
	}

	public $ogp_configs = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 20, 'unsigned' => false, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 255, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'value' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 255, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

}