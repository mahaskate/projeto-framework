<?php if(isset($usernameFlag)): ?>
	<div class="alert">
		<span class="badge badge-info">Importante!</span>
		Enviamos um e-mail de confirmação para o endereço <strong> <?php echo $user['User']['usernameTemp']; ?></strong>. Para a sua segurança seu e-mail só irá mudar após você completar esse passo. <?php echo $this->Html->link('Cancelar mudança.',array('action'=>'cancelatrocausername'));?>
		<br>
		<?php echo $this->Html->link('Link para ativação do novo e-mail [Somente teste, desabilitar versão final]',array('action'=>'trocausername',$user['User']['usernameToken']))?>
	</div>
<?php endif; ?>

<div class="row">
	<div class="span2 well">
		<?php echo $this->Chocolate->thumbnail('/attachments/photos/med/'.$user['User']['user_file_path'],array('width'=>150,'title'=>'Trocar foto'),array('action'=>'settingsperfil')); ?>
		<h4><?php echo $user['User']['nome']?></h4>
	</div>
	<div class="span9 well">
		<?php echo $this->Html->link('Editar o seu perfil',array('action'=>'settingsperfil'),array('class'=>'btn pull-right','style'=>'font-weight:bold;'))?>
	</div>
</div>

<?php if($user['User']['status'] == 'pendente'):?>
	<p>Seu status é <span class='badge badge-danger'><?php echo $user['User']['status'];?></span>, <?php echo $this->Html->link('Clique aqui',array('action'=>'ativa',$user['User']['statusToken']));?> para ativar</p>
<?php endif;?>
<?php if($user['User']['status'] == 'desativado'):?>
	<p>Seu status é <span class='badge badge-danger'><?php echo $user['User']['status'];?></span>, <?php echo $this->Html->link('Clique aqui',array('action'=>'reativa'));?> para reativar</p>
<?php endif;?>

<?php

if($user['User']['senhaToken']!=""){
	echo $this->Html->link('Link para redefinição de senha',array('action'=>'trocausername',$user['User']['senhaToken']));
}

?>