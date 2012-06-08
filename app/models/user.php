<?php
class User extends AppModel {
	var $name = 'User';
	
	var $hasMany = array(
		'SingleAdult' => array(
			'className' => 'SingleAdult',
			'foreignKey' => 'user_id'
		)
	); 
}
?>
