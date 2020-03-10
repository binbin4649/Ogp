<?php
$BcSite = Configure::read('BcSite');
if(substr($BcSite['version'], 0, 1) == '3'){
	$this->Plugin->initDb('plugin', 'Ogp', array('dbDataPattern'	=> $dbDataPattern));
}else{
	$this->Plugin->initDb('Ogp');
}