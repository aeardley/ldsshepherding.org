<?php
	class ChurchUnitsController extends AppController {
	var $helpers = array ('Html','Form');
	var $name = 'ChurchUnits';
	
	function beforeFilter(){
		$this->Auth->allow();
		//$this->Auth->autoRedirect = false;
		
		parent::beforeFilter();
    }

	
	function index() {
		$this->ChurchUnit->recover();
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
	}
	
	
}
    
?>
