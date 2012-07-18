<?php
	class PagesController extends AppController {
	var $helpers = array ('Html','Form');
	var $name = 'Pages';
	var $uses = null;
	
	
	function display() {
		$this->loadModel('ChurchUnit');
		$my_church_units = $this->ChurchUnit->children();
		//debug($my_church_units);
	}
}
    
?>
