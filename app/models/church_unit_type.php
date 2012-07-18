<?php
class ChurchUnitType extends AppModel {
	var $name = 'ChurchUnitType';
	var $actsAs = array('Tree');
	
	var $hasMany = array(
		'ChurchUnit' => array(
			'className' => 'ChurchUnit',
			'foreignKey' => 'church_unit_type'
		)
	); 
}
?>
