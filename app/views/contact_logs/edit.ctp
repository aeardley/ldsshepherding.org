<input type="button" value="<-Back" onClick="window.location='/contact_logs/view/ysa_id:<?php echo($contact_info['SingleAdult']['id']); ?>'" />
<h3>Edit a Logged visit or contact with: <?php echo($contact_info['SingleAdult']['full_name']); ?></h3>
<?php echo $this->Form->create('ContactLog', array('type' => 'post')); 
echo $this->Form->input('single_adult_id', array('type' => 'hidden', 'value' => $contact_info['SingleAdult']['id']));
echo $this->Form->input('id', array('type' => 'hidden', 'value' => $contact_info['ContactLog']['id']));
echo $this->Form->input('notes', array('value' => $contact_info['ContactLog']['notes']));
echo $this->Form->input('contact_date', array('value' => $contact_info['ContactLog']['contact_date']));
echo $this->Form->end('Save'); ?>