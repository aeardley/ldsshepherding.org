<?php
	class SingleAdultsController extends AppController {
	var $helpers = array ('Html','Form');
	var $name = 'SingleAdults';
	
	function add() {
		//debug($this->Session->read()); exit;
		//debug($this->data);
		//Has any form data been POSTed?
		if(!empty($this->data)) {
			$this->data['SingleAdult']['user_id'] = $this->Session->read('Auth.User.id');
			//If the form data can be validated and saved...
			if($this->SingleAdult->save($this->data)) {
				//Set a session flash message and redirect.
				$this->Session->setFlash("Single Adult information Saved!");
				$this->redirect('/pages/display');
			}
			else {
				$this->Session->setFlash("Single Adult information not Saved!");
			}
		}
	}
	
	function edit() {
		//debug($this->Session->read()); exit;
		//Has any form data been POSTed?
		if(!empty($this->data)) {
			//debug($this->data); exit;
			$this->data['SingleAdult']['user_id'] = $this->Session->read('Auth.User.id');
			//If the form data can be validated and saved...
			if($this->SingleAdult->save($this->data)) {
				//Set a session flash message and redirect.
				$this->Session->setFlash("Single Adult information Saved!");
				$this->redirect('/pages/display');
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
				$this->redirect('/pages/display');
			}
		}
	}
	
	function view() {
		$this->set('ysa_detail', $this->SingleAdult->find('first',
			array(
				'conditions' => array(
					'SingleAdult.id' => $this->passedArgs['id']
				)
			)
		));
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
