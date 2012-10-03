<div class="navbar navbar-inverse navbar-fixed-top" style="z-index:1;">
	<div class="navbar-inner">
		<div class="container">
			<ul class="nav">
				<li><?php echo $this->Html->link("<i class='icon-home icon-white'></i>",array('action'=>'meuperfil'),array('escape'=>false));?></li>
				<li class="divider-vertical"></li>
				<li><?php echo $this->Html->link('Usuários',array('controller'=>'users','action'=>'admin_index'));?></li>
				<li><?php echo $this->Html->link('Mensagens',array('controller'=>'contatos','action'=>'admin_index'));?></li>
			</ul>	
			<div class="btn-group pull-right">
				<button class="btn btn-small dropdown-toggle" data-toggle="dropdown"><?php echo $this->Html->image('/attachments/photos/small/'.$thumb,array('width'=>20)).' '.$username;?> <span class="caret"></span></button>
				<ul class="dropdown-menu">
					<li><?php echo $this->Html->link('Ajuda',array('controller'=>'users','action'=>'settingsconta'))?></li>
					<li class="divider"></li>
					<li><?php echo $this->Html->link('Sair',array('action'=>'logout'))?></li>
				</ul>
			</div>
		</div>
	</div>
</div>

