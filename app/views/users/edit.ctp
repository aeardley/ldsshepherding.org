<input type="button" value="<-Back" onClick="javascript:window.location='/users/index'" />
<?php
	echo $this->Session->flash('auth');
	echo $this->Form->create('User');
	echo $this->Form->input('full_name');
	echo $this->Form->input('username');
	echo $this->Form->input('church_unit_id', array('label' => 'Church Unit', 'options' => $church_units));
	echo $this->Form->end('Save');
?>
