<?php
class ContactLog extends AppModel {
	var $name = 'ContactLog';
	
	var $belongsTo = array(
		'SingleAdult' => array(
			'className' => 'SingleAdult',
			'foreignKey' => 'single_adult_id'
		)
	); 
}
?>
