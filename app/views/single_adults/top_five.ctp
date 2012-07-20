<?php
	//debug($top_five); exit;
?>
<input type="button" value="<-Back" onClick="window.location='/single_adults/index'" />
<table class="detail_table">
<tr>
		<th>Name, Address, Phone Number</th>
		<th>Shepherding Indicators</th>
		<th>Help Needed</th>
	</tr>
	<?php
		foreach($top_five as $ysa) {
			echo('<tr>
				<td>'.$ysa['SingleAdult']['full_name']);
				if($ysa['SingleAdult']['address'] != '') {
					echo(', <br/>'.$ysa['SingleAdult']['address']); 
				}
				if($ysa['SingleAdult']['mobile_phone'] != '') {
					echo(', <br/.'.$ysa['SingleAdult']['mobile_phone']); 
				}				
				echo('</td>');
				$indicators = '';
				if($ysa['SingleAdult']['OC-ordinance_current']) {
					$indicators .= 'OC';
				}
				if($ysa['SingleAdult']['IE-institute_enrolled']) {
					$indicators .= ', IE';
				}
				if($ysa['SingleAdult']['AWR-attending_meetings_where_records_are']) {
					$indicators .= ', AWR';
				}
				if($ysa['SingleAdult']['CC-current_calling']) {
					$indicators .= ', CC';
				}
				if($ysa['SingleAdult']['RM-returned_missionary']) {
					$indicators .= ', RM';
				}
				if($ysa['SingleAdult']['NI-attendance_needs_improvement']) {
					$indicators .= ' ,NI';
				}
				if($ysa['SingleAdult']['T-temple_recommend']) {
					$indicators .= ', T';
				}
				if($ysa['SingleAdult']['IS-institute_signed_up']) {
					$indicators .= ', IS';
				}
				if($ysa['SingleAdult']['PM-preparing_mission']) {
					$indicators .= ', PM';
				}
				if($ysa['SingleAdult']['NA_not_active']) {
					$indicators .= ', NA';
				}
				if($ysa['SingleAdult']['PT-preparing_for_temple']) {
					$indicators .= ', PT';
				}
				
				echo('<td><textarea style="width: 200px;" class="print_hide">'.$indicators.'</textarea></td>');
				echo('<td><textarea style="width: 400px;" class="print_hide"></textarea></td>');
			echo('</tr>');
			//debug($ysa);
		}
	?>
	
</table>
<p><b>Shepherding Indicators Key:</b></p>
<table>
	<tr>
		<td>AWR - Attending Meetings Where Records Are</td>
		<td>CC - Current Calling</td>
		<td>RM - Returned Missionary</td>
	</tr>
	<tr>
		<td>NI - Attendance Needs Improvement</td>
		<td>OC - Ordinance Current</td>
		<td>T - Temple Recommend</td>
	</tr><tr>
		<td>IS - Institute Signed Up</td>
		<td>PM - Preparing Mission</td>
		<td>NA - Not Active</td>
	</tr><tr>
		<td>IE - Institute Enrolled</td>
		<td>PT - Preparing for Temple</td>
		<td></td>
	</tr>
</table>
 			
			
					
				