<?php
class ShepherdingInidicator extends AppModel {
	var $name = 'ShepherdingInidicator';
	
	var $hasAndBelongsToMany = array(
		'ShepherdingInidicatorUser' => array(
			'className' => 'ShepherdingInidicatorUser',
			'foreignKey' => 'user_id'
		)
	); 
}
?>
