<div class="well">
	<h3>Desativar conta</h3>
	<p><strong>Iremos manter seus dados de usuário por 30 dias</strong> e então eles serão excluídos permanentemente. Você pode reativar sua conta a qualquer momento dentro destes 30 dias de desativação, basta acessá-la.</p>
	<hr>
<?php
	echo $this->Form->create('User',array('class'=>''));
		//echo "<legend>Entrar</legend>";
		echo $this->Form->input('password',array('class'=>'','label'=>'Senha'));
		echo $this->Form->submit('Desativar conta',array('class'=>'btn btn-primary btn-small btn-danger','before'=>$this->Html->link('Cancelar',array('action'=>'meuperfil'),array('class'=>'btn btn-large btn-primary','style'=>'margin-right:10px;'))));
	echo $this->Form->end();
?>
</div>