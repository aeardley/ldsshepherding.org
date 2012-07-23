<script type="text/javascript" >
	function validate_top_five() {
		if($("input:checked").length > 0) { //make sure they checked at least 1 ysa
			$('#ysa_list').submit();
		}
		else {
			alert('Check at least one ysa to continue.');
		}
	}
	function delete_ysa(id) {
		var response = confirm('Click Ok if you are sure you want to remove this YSA.');
		if(response) {
			window.location="/single_adults/delete/id:"+id;
		}
	}
</script>
<h2>Young Single Adults</h2>
<form name="ysa_list" id="ysa_list" action="/single_adults/top_five" method="post">
<table>
	<tr>
	<?php
	//if they belong to a stake/district or above give them a back button
	if($this->Session->read('Auth.User.church_unit_type') < 5) {
		echo('
		<td><input type="button" value="<-Back" onClick="javascript: window.location=\'/pages/display\';" /></td>
		');
	}?>
		<td><input type="button" value="Print Top Five" onClick="validate_top_five();" /></td>
		<td><input type="button" onclick='javascript: window.location="/single_adults/add"' value="Add Single Adult" /></td>
	</tr>
</table>
<table>	
	<tr>
		<th align="center">#</th>
		<th align="center"></th>
		<th align="left"><a href="/single_adults/index/sort:full_name">Full Name</a></th>
		<th align="left"><a href="/single_adults/index/sort:birthday">Birthday</a></th>
		<th align="left"><a href="/single_adults/index/sort:email">Email</a></th>
		<th align="left"><a href="/single_adults/index/sort:home_phone">Home Phone</a></th>
		<th align="left"><a href="/single_adults/index/sort:mobile_phone">Mobile Phone</a></th>
		<th align="left"><a href="/single_adults/index/sort:last_contact_date">Last Contact</a></th>
	</tr>
	<?php
	//debug($ysas);
	$i=1;
	foreach($ysas as $ysa) {
		echo('<tr>');
		echo('<td>'.$i.'.</td><td><input type="checkbox" name="id['.$ysa['SingleAdult']['id'].']" value="'.$ysa['SingleAdult']['id'].'" />&nbsp;
		<a href="/single_adults/edit/'.$ysa['SingleAdult']['id'].'"><img src="/img/edit_icon.png" alt="Edit Single Adult" /></a>&nbsp;
		<a href="javascript: delete_ysa('.$ysa['SingleAdult']['id'].');"><img src="/img/delete_icon.png" alt="Delete Single Adult" /></a>
		</td>');
		echo('<td><a href="/single_adults/view/id:'.$ysa['SingleAdult']['id'].'">'.$ysa['SingleAdult']['full_name'].'</a></td>');
		$birthday = null;
		if(isset($ysa['SingleAdult']['birthday']) && $ysa['SingleAdult']['birthday'] != '0000-00-00'){ 
			$birthday = date('M j',strtotime($ysa['SingleAdult']['birthday']));
		}		
		echo('<td>'.$birthday.'</td>');
		echo('<td>'.$ysa['SingleAdult']['email'].'</td>');
		echo('<td>'.$ysa['SingleAdult']['home_phone'].'</td>');
		echo('<td>'.$ysa['SingleAdult']['mobile_phone'].'</td>');
		if(isset($ysa['SingleAdult']['last_contact_date'])) {
			echo('<td><a href="/contact_logs/view/ysa_id:'.$ysa['SingleAdult']['id'].'/back:pages-display">'.date('m/d/Y', strtotime($ysa['SingleAdult']['last_contact_date'])).'</a></td>');
		}
		else {
			echo('<td>Not contacted</td>');
		}
		echo('</tr>');
		$i++;
	}
	?>
</table>
</form>