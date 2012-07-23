<input type="button" value="<-Back" onClick="window.location='/single_adults/index'" />
<?php echo $this->Form->create('SingleAdult', array('type' => 'post')); 
echo $this->Form->input('full_name');
echo $this->Form->input('church_unit_id', array('label' => 'Home Ward/Branch', 'options' => $church_units, 'default'=> $this->Session->read('Auth.User.selected_unit')));
echo $this->Form->input('preferred_name');
echo $this->Form->input('email');
echo $this->Form->input('address');
echo $this->Form->input('birthday', 
	array( 
		'label' => 'Birth Month & Day',
		'dateFormat' => 'MD',
		'empty' => true,
		'minYear' => date('Y') - 40,
		'maxYear' => date('Y') - 15 
	)
);
echo('<input type="hidden" name="data[SingleAdult][birthday][year]" value="1969" />');
echo $this->Form->input('birth_year');
echo $this->Form->input('parent_names');
echo $this->Form->input('home_phone');
echo $this->Form->input('mobile_phone');
echo $this->Form->input('current_records_ward');
echo $this->Form->input('current_records_stake');
echo $this->Form->input('high_school');
echo $this->Form->input('years_seminary');
echo $this->Form->input('priesthood_office');
echo $this->Form->input('current_calling');
echo $this->Form->input('OC-ordinance_current');
echo $this->Form->input('IE-institute_enrolled');
echo $this->Form->input('AWR-attending_meetings_where_records_are');
echo $this->Form->input('CC-current_calling');
echo $this->Form->input('RM-returned_missionary');
echo $this->Form->input('NI-attendance_needs_improvement');
echo $this->Form->input('T-temple_recommend');
echo $this->Form->input('IS-institute_signed_up');
echo $this->Form->input('PM-preparing_mission');
echo $this->Form->input('NA_not_active');
echo $this->Form->input('PT-preparing_for_temple');
echo $this->Form->input('has_ht_vt');
echo $this->Form->input('post_high_school_plans');
echo $this->Form->input('notes');
echo $this->Form->end('Save'); ?>