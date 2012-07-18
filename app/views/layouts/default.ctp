<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php __('CakePHP: the rapid development php framework:'); ?>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
		
		echo $javascript->link("jquery-1.7.min");

		echo $scripts_for_layout; 
	?>
</head>
<body>
	<?php //debug($this->Session->read('Auth')); ?>
	<div id="container">
		<div id="header">
			<table class="detail_table" >
				<tr>
					<td style="background-color:#324465;"><img src="/img/lds.png" /></td>
					<td><font size="4"><u>Shepherding Information</u></font>
					<br/><?php echo('Shepherds: '.$this->Session->read('Auth.User.full_name')); ?>
					<br/>Date: <?php echo(date('m/d/Y')); ?>
					<br/><?php echo($this->Session->read('Auth.User.church_unit_name')); ?>
					</td>
				</tr>
			</table>
		</div>
		<div id="content">
		<div style="float: right;"><a href="/users/logout">Logout</a></div>
			<?php echo $this->Session->flash(); ?>

			<?php echo $content_for_layout; ?>

		</div>
		<div id="footer">
			<?php echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt'=> __('CakePHP: the rapid development php framework', true), 'border' => '0')),
					'http://www.cakephp.org/',
					array('target' => '_blank', 'escape' => false)
				);
			?>
		</div>
	</div>
	<?php 
	//echo $this->element('sql_dump'); 
	?>
</body>
</html>
