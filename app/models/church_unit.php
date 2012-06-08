<?php
class ChurchUnit extends AppModel {
	var $name = 'ChurchUnit';
	var $actsAs = array('Tree');
	
	var $hasMany = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'church_unit_id'
		),
		'SingleAdult' => array(
			'className' => 'SingleAdult',
			'foreignKey' => 'church_unit_id'
		)
	); 
}
?>
