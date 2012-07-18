<?php
	class ChurchUnitsController extends AppController {
	var $helpers = array ('Html','Form');
	var $name = 'ChurchUnits';
	var $actsAs = array('Tree');
	
	function beforeFilter(){
		$this->Auth->allow();
		//$this->Auth->autoRedirect = false;
		
		parent::beforeFilter();
    }

	
	function index() {
		//$this->ChurchUnit->recover();
		$this->data = $this->ChurchUnit->generatetreelist(null, null, null, '&nbsp;&nbsp;&nbsp;');
		debug ($this->data); die; 
	}
	
	
	
	function add() {
		if($this->data) {
			$this->ChurchUnit->create();
			if($this->ChurchUnit->save($this->data)) {
				$this->Session->setFlash('Unit successfully.');
				$this->redirect(array('controller' => 'church_units', 'action' => 'index'));
			}
			else {
				$this->Session->setFlash('Unit creation failed, please try again.');
			}
		}
		else {
			$parents = $this->ChurchUnit->find('list',
				array(
					'conditions' => array( 
						'ChurchUnit.id' => $this->Session->read('Auth.church_units')
					)
				)
			);
			//debug($parents);
			$this->set('parents', $parents);
			
			$this->loadModel('ChurchUnitType');
			$unit_types = $this->ChurchUnitType->find('list');
			$this->set('church_unit_types',$unit_types);
		}
	}	
}
    
?>
