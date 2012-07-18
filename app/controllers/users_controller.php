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
			$children = $this->ChurchUnit->children($this->Session->read('Auth.User.church_unit_id'));
			$children[] = $this->Session->read('Auth.User.church_unit_id');
			$this->Session->write('Auth.church_units',$children);
			$my_church_unit = $this->ChurchUnit->find('first', 
				array(
					'conditions' => array(
						'ChurchUnit.id' => $this->Session->read('Auth.User.church_unit_id')
					)
				)
			);
			//debug($my_church_unit); die;
			$this->Session->write('Auth.User.church_unit_name',$my_church_unit['ChurchUnit']['name']);
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
