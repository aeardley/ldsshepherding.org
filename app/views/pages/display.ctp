<script type="text/javascript">
	$(document).ready(function(){
		$("a.trigger").click(function () {
		   $(this).next().animate({
			  height: 'toggle', opacity: 'toggle'
			}, "slow");
			$(this).toggleClass("opened");
			return false;
		}); 
	});
</script>
<style>
	
	a {
		text-decoration:none;
		color:#0099FF;
		padding-left:18px;
	}
	* {
		margin:0;
		padding:0;
	}
	ul li {
		list-style:none;
	}
	.trigger {
		background-image:url(http://images-cdn01.associatedcontent.com/siteimg/tool_font_plus.gif);
		background-position:0 3px;
		background-repeat:no-repeat;
	}
	.opened {
		background-image:url(http://images-cdn01.associatedcontent.com/siteimg/tool_font_minus.gif);
		color:#FF9900;
	}
	ul li ul li a:hover {
		color:#FF9900;
	}
	.level1 {
		display:none;
		width:580px;
		padding-left:20px;
	}
	.level2 {
		display:none;
		width:460px;
		padding-left:20px;
	}
	#leftSide {
		width:600px;
		padding:15px;
		background:#eee;
		border:1px solid #aaa;
	}
</style>
<input type="button" value="Add/Edit Users" onClick="javascript:window.location='/users/index'" />
<input type="button" value="Add Church Unit" onClick="javascript:window.location='/church_units/add'" />
<h2>Select a ward below to view: </h2>
<div id="leftSide">
	<?php
		//debug($stakes);
		foreach($stakes as $key=>$stake) {
			echo('<a class="trigger" href="#">'.$stake['ChurchUnit']['name'].'</a>');
			echo('<ul class="level1">');
			foreach($stake['ChurchUnit']['wards'] as $key=>$ward) {
				echo('<li><a href="/single_adults/index/id:'.$key.'">'.$ward.'</a></li>');
			}
			echo('</ul>');
		}
	?>
		
	</div>