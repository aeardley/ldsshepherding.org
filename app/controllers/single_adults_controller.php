<?php
	class SingleAdultsController extends AppController {
	var $helpers = array ('Html','Form');
	var $name = 'SingleAdults';
	
	function index() {
		//debug($this->Session->read('Auth.User'));	
		//check to see if unit id is set in passed args
		if(isset($this->passedArgs['id']) && in_array($this->passedArgs['id'], $this->Session->read('Auth.church_units'))) {
			$this->Session->write('Auth.User.selected_unit',$this->passedArgs['id']);
		}
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
		
		//debug($this->Session->read());
		$ysas = $this->SingleAdult->find('all',
			array(
				'order' => $order_by,
				'conditions' => array(
					'SingleAdult.church_unit_id' => $this->Session->read('Auth.User.selected_unit'),
					'SingleAdult.status' => 'active',
				),
				'recursive' => -1
			)
		);
		//debug($ysas);
		$this->set('ysas', $ysas);		
	}
	
	function add() {
		$this->loadModel('ChurchUnit');
		$church_units = $this->ChurchUnit->find('list',
			array(
				'conditions' => array(
					'ChurchUnit.id' => $this->Session->read('Auth.church_units'),
					'ChurchUnit.church_unit_type' => array(5,6)
				)
				
			)
		);
		$this->set('church_units', $church_units);
		//debug($church_units);
		//debug($this->Session->read()); exit;
		//debug($this->data);
		//Has any form data been POSTed?
		if(!empty($this->data)) {
			$this->data['SingleAdult']['church_unit_id'] = $this->Session->read('Auth.User.selected_unit');
			//If the form data can be validated and saved...
			if($this->SingleAdult->save($this->data)) {
				//Set a session flash message and redirect.
				$this->Session->setFlash("Single Adult information Saved!");
				$this->redirect('/single_adults/index');
			}
			else {
				$this->Session->setFlash("Single Adult information not Saved!");
			}
		}
	}
	
	function edit() {
		$this->loadModel('ChurchUnit');
		$church_units = $this->ChurchUnit->find('list',
			array(
				'conditions' => array(
					'ChurchUnit.id' => $this->Session->read('Auth.church_units'),
					'ChurchUnit.church_unit_type' => array(5,6)
				)
				
			)
		);
		$this->set('church_units', $church_units);
		//debug($this->Session->read()); exit;
		//Has any form data been POSTed?
		if(!empty($this->data)) {
			//debug($this->data); exit;
			//If the form data can be validated and saved...
			if($this->SingleAdult->save($this->data)) {
				//Set a session flash message and redirect.
				$this->Session->setFlash("Single Adult information Saved!");
				$this->redirect('/single_adults/index');
			}
			else {
				$this->Session->setFlash("Single Adult information not Saved!");
			}
		}
		else {
			$this->data = $this->SingleAdult->read();
		}
	}
	
	function delete() {
		$this->autoRender=false;
		//debug($this->passedArgs);
		if(isset($this->passedArgs['id'])) {
			$deleted_user['SingleAdult'] = $this->passedArgs;
			$deleted_user['SingleAdult']['status'] = 'deleted';
			//debug($deleted_user);
			unset($this->SingleAdult->validate['full_name']); 
			//debug($this->SingleAdult->save($deleted_user)); exit;
			if($this->SingleAdult->save($deleted_user)) {
				//Set a session flash message and redirect.
				$this->Session->setFlash("Single Adult removed!");
				$this->redirect('/single_adults/index');
			}
		}
	}
	
	function view() {
		 $ysa_detail = $this->SingleAdult->find('first',
			array(
				'conditions' => array(
					'SingleAdult.id' => $this->passedArgs['id']
				)
			)
		);
		$this->set('ysa_detail',$ysa_detail);
		$this->loadModel('ContactLog');
		$contact_count = $this->ContactLog->find('count',
			array(
				'conditions' => array(
					'ContactLog.single_adult_id' => $this->passedArgs['id'],
					'ContactLog.status' => 'active'
				)
			)
			
		);
		$this->set('contact_count', $contact_count);
		
		$this->loadModel('ChurchUnit');
		$home_ward = $this->ChurchUnit->find('first',
			array(
				'conditions' => array(
					'ChurchUnit.id' => $ysa_detail['SingleAdult']['church_unit_id']
				),
				'recursive' => -1
			)
		);
		$this->set('home_ward',$home_ward);
		$home_stake = $this->ChurchUnit->getparentnode($ysa_detail['SingleAdult']['church_unit_id']);
		$this->set('home_stake',$home_stake);
	}
	
	function top_five() {
		$top_five= $this->SingleAdult->find('all',
			array(
				'conditions' => array(
					'SingleAdult.id' => $_POST['id']
				)
			)
		);
		$this->set('top_five', $top_five);
		

	}
}
    
?>
