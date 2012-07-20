<?php
	class UsersController extends AppController {
	var $helpers = array ('Html','Form');
	var $name = 'Users';
	
	function beforeFilter(){
		$this->Auth->allow('login');
		$this->Auth->autoRedirect = false;
		
		parent::beforeFilter();
    }

	
	function login() {
		if ($this->Auth->user()) {
			$user = $this->User->find('first',
				array(
					'conditions' => array(
						'User.id' => $this->Session->read('Auth.User.id')
					),
					'recursive' => -1
				)
			);
			//save list of accessable church units in session
			$this->loadModel('ChurchUnit');
			$children = $this->ChurchUnit->children($this->Session->read('Auth.User.church_unit_id'),false,array('id'));
			
			$accessable_units[] = $this->Session->read('Auth.User.church_unit_id');
			foreach($children as $child) {
				$accessable_units[] = $child['ChurchUnit']['id'];
			}
			$this->Session->write('Auth.church_units',$accessable_units);
			$my_church_unit = $this->ChurchUnit->find('first', 
				array(
					'conditions' => array(
						'ChurchUnit.id' => $this->Session->read('Auth.User.church_unit_id')
					)
				)
			);
			//debug($my_church_unit); die;
			$this->Session->write('Auth.User.church_unit_name',$my_church_unit['ChurchUnit']['name']);		
			$this->Session->write('Auth.User.church_unit_type',$my_church_unit['ChurchUnit']['church_unit_type']);
			$this->Session->write('Auth.User.selected_unit',$my_church_unit['ChurchUnit']['id']);			
			$this->redirect($this->Auth->redirect());
		}
	}
	
	function logout() {
		$this->redirect($this->Auth->logout());
	}
	
	function add() {
		if($this->data) {
			$this->User->create();
			if($this->User->save($this->data)) {
				$this->Session->setFlash('User created successfully.');
				$this->redirect(array('controller' => 'users', 'action' => 'index'));
			}
			else {
				$this->Session->setFlash('User creation failed, please try again.');
			}
		}
	}
	
	
}
    
?>
