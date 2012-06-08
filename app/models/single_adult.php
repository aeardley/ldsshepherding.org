<?php
class SingleAdult extends AppModel {
	var $name = 'SingleAdult';
	
	var $hasMany = array(
		'ContactLog' => array(
			'className' => 'ContactLog',
			'foreignKey' => 'single_adult_id'
		)
	); 
	
	var $validate = array(
		'full_name' => array(
			'rule' => 'notEmpty',
			'required' => true
		)
	);
	
	function afterFind($results) {
		//debug($results);
		foreach ($results as $key => $val) {
			if (isset($val['SingleAdult']['mobile_phone']) && strlen($val['SingleAdult']['mobile_phone']) == 10) {
				$results[$key]['SingleAdult']['mobile_phone'] = '('.substr($val['SingleAdult']['mobile_phone'],0,3).') '.substr($val['SingleAdult']['mobile_phone'],3,3).'-'.substr($val['SingleAdult']['mobile_phone'],5,4);
			}
			if (isset($val['SingleAdult']['home_phone']) && strlen($val['SingleAdult']['home_phone']) == 10) {
				$results[$key]['SingleAdult']['home_phone'] = '('.substr($val['SingleAdult']['home_phone'],0,3).') '.substr($val['SingleAdult']['home_phone'],3,3).'-'.substr($val['SingleAdult']['home_phone'],5,4);
			}
		}
		return $results;
    }
    

}
?>
