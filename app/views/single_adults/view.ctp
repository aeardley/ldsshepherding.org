<input type="button" value="<-Back" onClick="window.location='/pages/display'" />
<input type="button" value="Log a Contact/Visit" onClick="window.location='/contact_logs/add/ysa_id:<?php echo($ysa_detail['SingleAdult']['id']); ?>'" />
<table class="detail_table">	
	<tr>
		<td width="50%"><b>Date:</b> <?php echo(date('m/d/Y')); ?></td>
		<td><b>Current Ward/Stake:</b> <?php echo($ysa_detail['SingleAdult']['current_records_ward'].'/'.$ysa_detail['SingleAdult']['current_records_stake']); ?></td>
	</tr>
	<tr>
		<td colspan="2" bgcolor="silver"><b><u>Personal Information</u></b></td>
	</tr>	
	<tr>
		<td><b>Full Name:</b> <?php echo($ysa_detail['SingleAdult']['full_name']); ?></td>
		<td><b>Home Ward/Stake:</b> <?php echo($ysa_detail['SingleAdult']['home_ward'].'/'.$ysa_detail['SingleAdult']['home_stake']); ?></td>
	</tr>
	<tr>
		<td><b>Preferred Name:</b> <?php echo($ysa_detail['SingleAdult']['preferred_name']); ?></td>
		<td><b>email:</b> <?php echo($ysa_detail['SingleAdult']['email']); ?></td>
	</tr>
	<tr>
		<td><b>Birth Month & Day:</b> <?php echo(date('M j', strtotime($ysa_detail['SingleAdult']['birthday']))); ?></td>
		<td><b>Birth Year:</b> <?php echo($ysa_detail['SingleAdult']['birth_year']); ?></td>
	</tr>
	<tr>
		<td><b>Phone Number:</b> <?php echo($ysa_detail['SingleAdult']['home_phone']); ?></td>
		<td><b>Address:</b> <?php echo($ysa_detail['SingleAdult']['address']); ?></td>
	</tr>
	<tr>
		<td><b>Mobile Number:</b> <?php echo($ysa_detail['SingleAdult']['mobile_phone']); ?></td>
		<td><b>Parents:</b> <?php echo($ysa_detail['SingleAdult']['parent_names']); ?></td>
	</tr>
	<tr>
		<td><b>High School Attended:</b> <?php echo($ysa_detail['SingleAdult']['high_school']); ?></td>
		<td><b>Years of Seminary:</b> <?php echo($ysa_detail['SingleAdult']['years_seminary']); ?></td>
	</tr>
	<tr>
		<td colspan="2" bgcolor="silver"><b><u>Shepherding Information</u></b></td>
	</tr>
	<tr>
		<td><b>Priesthood Office:</b> <?php echo($ysa_detail['SingleAdult']['priesthood_office']); ?></td>
		<td><b>Church Calling:</b> <?php echo($ysa_detail['SingleAdult']['current_calling']); ?></td>
	</tr>
	<tr>
		<td colspan="2"><b>Post High School Plans:</b> <?php echo($ysa_detail['SingleAdult']['post_high_school_plans']); ?></td>
		
	</tr>
	<?php
		$checkbox_fields = array();
		$checkbox_fields[] = 'OC-ordinance_current';
		$checkbox_fields[] = 'IE-institute_enrolled';
		$checkbox_fields[] = 'AWR-attending_meetings_where_records_are';
		$checkbox_fields[] = 'CC-current_calling';
		$checkbox_fields[] = 'RM-returned_missionary';
		$checkbox_fields[] = 'NI-attendance_needs_improvement';
		$checkbox_fields[] = 'T-temple_recommend';
		$checkbox_fields[] = 'IS-institute_signed_up';
		$checkbox_fields[] = 'PM-preparing_mission';
		$checkbox_fields[] = 'NA_not_active';
		$checkbox_fields[] = 'PT-preparing_for_temple';
		$checkbox_fields[] = 'has_ht_vt';
		
		$i = 1;
		foreach($checkbox_fields as $field) {
			$img = 'unchecked.png';
			if($ysa_detail['SingleAdult'][$field]) {
				$img = 'checked.png';
			}
			if($i%2 == 1) {
				echo('<tr>');
			}
			echo('<td><b>'.str_replace('_', ' ', $field).':</b>&nbsp;<img src="/img/'.$img.'" /></td>');
			if($i%2 == 0) {
				echo('</tr>');
			}
			$i++;
		}
	?>
	<tr>
		<td colspan="2"><b>Notes:</b> <?php echo($ysa_detail['SingleAdult']['notes']); ?></td>
	</tr>
</table>
<div>There have been <?php echo($contact_count); ?> contacts/visits logged for <?php echo($ysa_detail['SingleAdult']['full_name']); ?>. 
<a href="/contact_logs/view/ysa_id:<?php echo($ysa_detail['SingleAdult']['id']); ?>">Click here to view a full list</a>.</div>