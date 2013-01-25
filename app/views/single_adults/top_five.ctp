<?php
	//debug($top_five); exit;
	//debug($this->Session->read());
?>
<script type="text/javascript" >
function text_to_div() {
	$('.text_area').each(function(index) {
		$(this).replaceWith('<div style="width:'+Math.round($(this).width())+'px;" class="div_area">'+this.value+'</div>');
	});
	$('#ready_to_print').replaceWith('<input id="back_to_edit" type="button" value="Edit" onClick="javascript: div_to_text();" />');
}

function div_to_text() {
	$('.div_area').each(function(index) {
		$(this).replaceWith('<textarea class="text_area" style="width:'+Math.round($(this).width())+'px;">'+$(this).text()+'</textarea>');
	});
	$('#back_to_edit').replaceWith('<input id="ready_to_print" type="button" value="Ready to Print" onClick="javascript: text_to_div();" />');
}
</script>
<input type="button" value="<-Back" onClick="window.location='/single_adults/index'" />
<input id="ready_to_print" type="button" value="Ready to Print" onClick="javascript: text_to_div();" />
<h2><?php echo($this->Session->read('Auth.User.church_unit_name')); ?> Young Single Adult Report</h2>
<h3> <?php echo(date('F Y')); ?> &nbsp; &nbsp; &nbsp; &nbsp; Shepherding Couple: <?php echo($this->Session->read('Auth.User.full_name')); ?></h3>
<table class="detail_table">
<tr>
		<th>Name</th>
		<th>Membership Location</th>
		<th>Personal Contact Date</th>
		<th>Other Contact Date</th>
		<th>Actiity Level (LA, A, VA)</th>
		<th>Future Plans</th>
		<th>Present Employment</th>
		<th>Present Church Calling</th>
		<th>Comments & Recommendations for Priesthood Leaders</th>
	</tr>
	<?php
		foreach($top_five as $ysa) {
			echo('<tr>
				<td><textarea class="text_area" style="width: 90px;">'.$ysa['SingleAdult']['full_name'].'</textarea></td>');
				$membership_location = '';
				if($ysa['SingleAdult']['current_records_ward']) {
					$membership_location .= $ysa['SingleAdult']['current_records_ward'];
					if(!stripos($ysa['SingleAdult']['current_records_ward'],'ward')) {
						$membership_location .= ' ward';
					}
				}
				if($ysa['SingleAdult']['current_records_stake']) {
					if($membership_location != '') {
						$membership_location .= '/';
					}
					$membership_location .= $ysa['SingleAdult']['current_records_stake'];
					if(!stripos($ysa['SingleAdult']['current_records_stake'],'stake')) {
						$membership_location .= ' stake';
					}
				}
				echo('<td><textarea class="text_area" style="width: 90px;">'.$membership_location.'</textarea></td>');
				echo('<td><textarea class="text_area" style="width: 80px;">'.date('m/d/y',strtotime($ysa['SingleAdult']['last_contact_date'])).'</textarea></td>');
				echo('<td><textarea class="text_area" style="width: 80px;"></textarea></td>');
				echo('<td><textarea class="text_area" style="width: 100px;">'.$ysa['SingleAdult']['activity_level'].'</textarea></td>');
				echo('<td><textarea class="text_area" style="width: 200px;">'.$ysa['SingleAdult']['future_plans'].'</textarea></td>');
				echo('<td><textarea class="text_area" style="width: 150px;">'.$ysa['SingleAdult']['current_employment'].'</textarea></td>');
				echo('<td><textarea class="text_area" style="width: 150px;">'.$ysa['SingleAdult']['current_calling'].'</textarea></td>');
				echo('<td><textarea class="text_area" style="width: 250px;"></textarea></td>');
				
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
 			
			
					
				