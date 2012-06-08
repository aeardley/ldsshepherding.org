<?php
	class ContactLogsController extends AppController {
	var $helpers = array ('Html','Form');
	var $name = 'ContactLogs';
	
	private function update_last_contact_date($ysa_id) {
		if(isset($ysa_id)) {
			$ysa_data['SingleAdult']['id'] = $ysa_id;
			$last_contact = $this->ContactLog->find('first',
				array(
					'conditions' => array(
						'ContactLog.single_adult_id' => $ysa_id,
						'ContactLog.status' => 'active'
					),
					'order' => 'ContactLog.contact_date desc',
					'recursive' => -1
				)
			);
			//debug($last_contact); exit;
			if(!isset($last_contact['ContactLog']['contact_date'])) {
				$ysa_data['SingleAdult']['last_contact_date'] = NULL;
			}
			else {
				$ysa_data['SingleAdult']['last_contact_date'] = $last_contact['ContactLog']['contact_date'];
			}			
			//update single adult table with date last contacted
			$this->loadModel('SingleAdult');
			$this->SingleAdult->validate = array(); //disable validation in this case.
			$this->SingleAdult->save($ysa_data);
		}
	}
	
	function add() {
		//debug($this->data);
		//Has any form data been POSTed?
		if(!empty($this->data)) {
			//If the form data can be validated and saved...
			if($this->ContactLog->save($this->data)) {
				//this may not be the most recent contact logged. Find the most recent and update the single adults table.
				$this->update_last_contact_date($this->data['ContactLog']['single_adult_id']);
				//Set a session flash message and redirect.
				$this->Session->setFlash("Contact/Visit Logged!");
				$this->redirect('/single_adults/view/id:'.$this->data['ContactLog']['single_adult_id']);
			}
			else {
				$this->Session->setFlash("Single Adult information not Saved!");
			}
		}
		else {
			$this->set('ysa_id', $this->passedArgs['ysa_id']);
			$this->loadModel('SingleAdult');
			$ysa_info = $this->SingleAdult->find('first',
				array(
					'fields' => array('full_name'),
					'conditions' => array(
						'SingleAdult.id' => $this->passedArgs['ysa_id']
					),
					'recursive' => -1
				)
			);
			$this->set('ysa_name', $ysa_info['SingleAdult']['full_name']);
		}
	}
	
	function edit() {
		//debug($this->data); exit;
		//Has any form data been POSTed?
		if(!empty($this->data)) {
			//If the form data can be validated and saved...
			if($this->ContactLog->save($this->data)) {
				//this may not be the most recent contact logged. Find the most recent and update the single adults table.
				$this->update_last_contact_date($this->data['ContactLog']['single_adult_id']);
				//Set a session flash message and redirect.
				$this->Session->setFlash("Contact/Visit Log Updated!");
				$this->redirect('/contact_logs/view/ysa_id:'.$this->data['ContactLog']['single_adult_id']);
			}
			else {
				$this->Session->setFlash("Single Adult information not Saved!");
			}
		}
		else {
			$this->set('id', $this->passedArgs['id']);
			$contact_info = $this->ContactLog->find('first', 
				array(
					'conditions' => array(
						'ContactLog.id' => $this->passedArgs['id']
					)
				)
			);
			//debug($contact_info);
			$this->set('contact_info', $contact_info);
		}
	}
	
	function delete() {
		$this->autoRender=false;
		//debug($this->passedArgs);
		if(isset($this->passedArgs['id'])) {
			$ysa_id = $this->passedArgs['ysa_id'];
			unset($this->passedArgs['ysa_id']);
			$deleted_contact['ContactLog'] = $this->passedArgs;
			$deleted_contact['ContactLog']['status'] = 'deleted';
			//debug($deleted_contact);
			//debug($this->ContactLog->save($deleted_contact)); exit;
			$result = $this->ContactLog->save($deleted_contact);
			//this may be the most recent contact. Update the single adult table with most recent contact log
			$this->update_last_contact_date($ysa_id);
			//debug($result); exit;
			if($result) {
				//Set a session flash message and redirect.
				$this->Session->setFlash("Contact log removed!");
				$this->redirect('/contact_logs/view/ysa_id:'.$ysa_id);
			}
		}
	}
	
	function view() {
		$this->set('ysa_id', $this->passedArgs['ysa_id']);
		if(isset($this->passedArgs['back']) && $this->passedArgs['back'] == 'pages-display') {
			$this->set('back', '/pages/display');
		}
		else {
			$this->set('back', '/single_adults/view/id:'.$this->passedArgs['ysa_id']);
		}
		$this->set('contact_list', $this->ContactLog->find('all',
			array(
				'conditions' => array(
					'ContactLog.single_adult_id' => $this->passedArgs['ysa_id'],
					'ContactLog.status' => 'active'
				),
				'order' => 'ContactLog.contact_date DESC',
				'recursive' => -1
			)
		));
	}
}
    
?>
