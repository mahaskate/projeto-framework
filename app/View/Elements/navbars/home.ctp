<div class="navbar navbar-fixed-top" style="z-index:1;">
	<div class="navbar-inner">
		<div class="container">
			<ul class="nav">
				<li><?php echo $this->Html->link("<i class='icon-home'></i>",array('controller'=>'/'),array('escape'=>false,'title'=>'Página inicial','class'=>'ttb'));?></li>
			</ul>
			<ul class="nav pull-right">
				<li><?php echo $this->Html->link('Contato',array('controller'=>'contatos','action'=>'add'));?></li>
			</ul>
		</div>
	</div>
</div>

