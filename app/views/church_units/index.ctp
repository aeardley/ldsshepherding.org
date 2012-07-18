<script type="text/javascript" >
	
	function delete_contact(id,ysa_id) {
		var response = confirm('Click Ok if you are sure you want to remove this logged contact.');
		if(response) {
			window.location="/contact_logs/delete/id:"+id+"/ysa_id:"+ysa_id
		}
	}
</script>
<input type="button" value="<-Back" onClick="window.location='<?php echo($back); ?>'" />
<table class="detail_table">
	
	<?php 
	if(count($contact_list) > 0) {
		echo('<tr>
			<th></td>
			<th>Date Contacted</th>
			<th>Notes</th>
		</tr>');
		foreach($contact_list as $contact) {
			echo('<tr>');
			echo('<td width="60px">
			<a href="/contact_logs/edit/id:'.$contact['ContactLog']['id'].'"><img src="/img/edit_icon.png" alt="Edit Contact Info" /></a>&nbsp;
			<a href="javascript: delete_contact('.$contact['ContactLog']['id'].','.$ysa_id.');"><img src="/img/delete_icon.png" alt="Delete Contact Info" /></a>
			</td>');
			echo('<td>'.date('m/d/Y',strtotime($contact['ContactLog']['contact_date'])).'</td>');
			if(strlen($contact['ContactLog']['notes']) > 60) {
				echo('<td>'.substr($contact['ContactLog']['notes'],0,60).'...</td>');
			}
			else {
				echo('<td>'.$contact['ContactLog']['notes'].'</td>');
			}
			
			echo('</tr>');
		}
	}
	else {
		echo('<tr><td>No Contacts/Visits logged for this single adult yet.</td></tr>');
	}
		
	?>
</table>