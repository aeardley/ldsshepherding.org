<?php
	class UsersController extends AppController {
	var $helpers = array ('Html','Form');
	var $name = 'Users';
	
	function beforeFilter(){
		$this->Auth->allow('add','login');
		//$this->Auth->autoRedirect = false;
		
		parent::beforeFilter();
    }

	
	function login() {
		/*if ($this->Auth->user()) {
			$user = $this->User->find('first',
				array(
					'conditions' => array(
						'User.id' => $this->Session->read('Auth.User.id')
					),
					'recursive' => -1
				)
			);
			
			$this->redirect($this->Auth->redirect());
		}*/
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
