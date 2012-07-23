<input type="button" value="<-Back" onClick="window.location='/single_adults/view/id:<?php echo($ysa_id); ?>'" />
<h3>Log a visit or contact with: <?php echo($ysa_name); ?></h3>
<?php echo $this->Form->create('ContactLog', array('type' => 'post')); 
echo $this->Form->input('single_adult_id', array('type' => 'hidden', 'value' => $ysa_id));
echo $this->Form->input('notes');
echo $this->Form->input('contact_date');
echo('<input type="hidden" name="data[ContactLog][user_id]" value="'.$this->Session->read('Auth.User.id').'" />');
echo $this->Form->end('Save'); ?>