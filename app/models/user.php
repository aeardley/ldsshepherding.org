<?php
class User extends AppModel {
	var $name = 'User';
	
	var $belongsTo = array(
		'ChurchUnit' => array(
			'className' => 'ChurchUnit',
			'foreignKey' => 'church_unit_id'
		)
	); 
}
?>
