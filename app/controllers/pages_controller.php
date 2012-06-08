<?php
	class PagesController extends AppController {
	var $helpers = array ('Html','Form');
	var $name = 'Pages';
	var $uses = null;
	
	
	function display() {
		//debug($this->Session->read('Auth.User'));		
		if(isset($this->passedArgs['sort'])) {
			$order_by = $this->passedArgs['sort'];
			if($this->passedArgs['sort'] == $this->Session->read('Auth.User.last_ysa_sort_col')) {
				$order_by .= ' desc';
			}
			$this->Session->write('Auth.User.last_ysa_sort_col',$this->passedArgs['sort']);
		}
		else {
			$order_by = 'full_name';
			$this->Session->write('Auth.User.last_ysa_sort_col', 'full_name');
		}
		
	
		$this->loadModel('SingleAdult');
		//debug($this->Session->read());
		$ysas = $this->SingleAdult->find('all',
			array(
				'order' => $order_by,
				'conditions' => array(
					'SingleAdult.user_id' => $this->Session->read('Auth.User.id'),
					'SingleAdult.status' => 'active',
				),
				'recursive' => -1
			)
		);
		//debug($ysas);
		$this->set('ysas', $ysas);		
	}
}
    
?>
