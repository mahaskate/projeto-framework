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
<div id="container-flash" class="container-flash">
	<?php echo $this->Session->flash(); ?>
</div>
<?php echo $this->element('navbars/admin'); ?>
<br style="clear:both;">
<div class="container" style="margin-top:40px;">
	<?php echo $this->fetch('content'); ?>
</div>
<div class="container">
	<?php echo $this->element('footer'); ?>
</div>
<div class="container">
	<?php //echo $this->element('sql_dump'); ?>
</div>
</body>
</html>
