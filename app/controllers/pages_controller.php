<?php
	class PagesController extends AppController {
	var $helpers = array ('Html','Form');
	var $name = 'Pages';
	var $uses = null;
	
	
	function display() {
		//check to see if they belong to a ward or branch
		if($this->Session->read('Auth.User.church_unit_type') > 4) {
			//if so redirect directly to ysa page
			$this->redirect(array('controller' => 'single_adults', 'action' => 'index'));
		}
		else {
			$this->loadModel('ChurchUnit');
			//get list of stakes 
			$stakes = $this->ChurchUnit->find('all',
				array(
					'conditions' => array(
						'ChurchUnit.church_unit_type' => array(3,4),
						'ChurchUnit.id' => $this->Session->read('Auth.church_units')
					),
					'recursive' => -1,
					'order' => 'ChurchUnit.name'
				)
			);
			
			//loop through list of stakes and find all wards that belong to that stake
			foreach($stakes as $key=>$stake) {
				$wards = $this->ChurchUnit->find('list',
					array(
						'conditions' => array(
							'ChurchUnit.church_unit_type' => array(5,6),
							'ChurchUnit.id' => $this->Session->read('Auth.church_units')
						),
						'recursive' => -1,
						'order' => 'ChurchUnit.name'
					)
				);
				$stakes[$key]['ChurchUnit']['wards'] = $wards;
				//debug($wards);
			}
			//debug($stakes);
			$this->set('stakes',$stakes);
		}
	}
}
    
?>
