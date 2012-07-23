<?php
	class UsersController extends AppController {
	var $helpers = array ('Html','Form');
	var $name = 'Users';
	
	function beforeFilter(){
		$this->Auth->allow('login');
		$this->Auth->autoRedirect = false;
		
		parent::beforeFilter();
    }

	function index() {
		//debug($this->Session->read('Auth.User'));	
		//check to see if unit id is set in passed args
		
		if(isset($this->passedArgs['sort'])) {
			$order_by = $this->passedArgs['sort'];
			if($this->passedArgs['sort'] == $this->Session->read('Auth.User.last_user_sort_col')) {
				$order_by .= ' desc';
			}
			$this->Session->write('Auth.User.last_user_sort_col',$this->passedArgs['sort']);
		}
		else {
			$order_by = 'full_name';
			$this->Session->write('Auth.User.last_user_sort_col', 'full_name');
		}
		
		//debug($this->Session->read());
		$users = $this->User->find('all',
			array(
				'order' => $order_by,
				'conditions' => array(
					'User.status' => 'active'
				),
				//'recursive' => -1
			)
		);
		//debug($users);
		$this->set('users', $users);
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
		$this->loadModel('ChurchUnit');
		$church_units = $this->ChurchUnit->find('list',
			array(
				'conditions' => array(
					'ChurchUnit.id' => $this->Session->read('Auth.church_units'),
				)
				
			)
		);
		$this->set('church_units', $church_units);
		if($this->data) {
			$this->data['User']['status'] = 'active';
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
	
	function edit() {
		
		if($this->data) {
			if($this->User->save($this->data)) {
				$this->Session->setFlash('User updated successfully.');
				$this->redirect(array('controller' => 'users', 'action' => 'index'));
			}
			else {
				$this->Session->setFlash('User update failed, please try again.');
			}
		}
		else {
			$this->loadModel('ChurchUnit');
			$church_units = $this->ChurchUnit->find('list',
				array(
					'conditions' => array(
						'ChurchUnit.id' => $this->Session->read('Auth.church_units'),
					)
					
				)
			);
			$this->set('church_units', $church_units);
			$this->data = $this->User->read();
			//debug($this->data);
		}
	}
	
	function delete() {
		$this->autoRender=false;
		//debug($this->passedArgs);
		if(isset($this->passedArgs['id'])) {
			$deleted_user['User'] = $this->passedArgs;
			$deleted_user['User']['status'] = 'deleted';
			//debug($deleted_user);
			//unset($this->User->validate['full_name']); 
			//debug($this->SingleAdult->save($deleted_user)); exit;
			if($this->User->save($deleted_user)) {
				//Set a session flash message and redirect.
				$this->Session->setFlash("User removed!");
				$this->redirect('/users/index');
			}
		}
	}
	
}
    
?>
