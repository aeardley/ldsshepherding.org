<?php
	echo $this->Session->flash('auth');
	echo $this->Form->create('ChurchUnit');
	echo $this->Form->input('parent_id', array( 'label' => 'Parent Church Unit' ));
	echo $this->Form->input('name');
	echo $this->Form->input('church_unit_type', array('options' => $church_unit_types));
	echo $this->Form->end('Add');
?>
