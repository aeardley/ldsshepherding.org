<script type="text/javascript" >
	
	function delete_user(id) {
		var response = confirm('Click Ok if you are sure you want to remove this user.');
		if(response) {
			window.location="/users/delete/id:"+id;
		}
	}
</script>
<h2>Users</h2>
<table>
	<tr>
	<?php
	//if they belong to a stake/district or above give them a back button
	if($this->Session->read('Auth.User.church_unit_type') < 5) {
		echo('
		<td><input type="button" value="<-Back" onClick="javascript: window.location=\'/pages/display\';" /></td>
		');
	}?>
		<td><input type="button" onclick='javascript: window.location="/users/add"' value="Add User" /></td>
	</tr>
</table>
<table>	
	<tr>
		<th align="center">#</th>
		<th align="center"></th>
		<th align="left"><a href="/users/index/sort:full_name">Full Name</a></th>
		<th align="left"><a href="/users/index/sort:email">Email</a></th>
		<th align="left"><a href="/users/index/sort:last_contact_date">Church Unit</a></th>
	</tr>
	<?php
	//debug($users);
	$i=1;
	foreach($users as $user) {
		echo('<tr>');
		echo('<td>'.$i.'.</td><td>
		<a href="/users/edit/'.$user['User']['id'].'"><img src="/img/edit_icon.png" alt="Edit Single Adult" /></a>&nbsp;
		<a href="javascript: delete_user('.$user['User']['id'].');"><img src="/img/delete_icon.png" alt="Delete Single Adult" /></a>
		</td>');
		echo('<td>'.$user['User']['full_name'].'</td>');
		$birthday = null;
		if(isset($user['User']['birthday']) && $user['User']['birthday'] != '0000-00-00'){ 
			$birthday = date('M j',strtotime($user['User']['birthday']));
		}		
		echo('<td>'.$user['User']['username'].'</td>');
		echo('<td>'.$user['ChurchUnit']['name'].'</td>');
		echo('</tr>');
		$i++;
	}
	?>
</table>