<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('bootstrap');
		//echo $this->Html->css('cerulean');
		echo $this->Html->css('estilos');

		echo $this->Html->script('jquery');
		echo $this->Html->script('bootstrap');
		echo $this->Html->script('chocolate');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#container-flash").hide();
			$("#container-flash").fadeIn('slow');
		});
	</script>
</head>
<body>
<div class="container-flash" id="container-flash">
	<?php echo $this->Session->flash(); ?>
</div>
<?php echo $this->element('navbars/profile'); ?>
<br style="clear:both;">
<div class="container" style="margin-top:40px;">
	<div class="row">
		<div class="span3">
			<?php echo $this->element('sidebars/settings'); ?>
		</div>
		<div class="span8 well">
			<?php echo $this->fetch('content'); ?>
		</div>
	</div>
</div>
	<?php //echo $this->element('sql_dump'); ?>
</body>
</html>
