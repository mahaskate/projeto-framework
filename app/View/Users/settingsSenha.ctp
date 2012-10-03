<?php
echo $this->Form->create('User',array('class'=>'form-horizontal'));
	echo "<legend>Senha</legend>";
	echo $this->Form->input('novaSenha',array('type'=>'password'));
	echo $this->Form->input('confirmarNovaSenha',array('type'=>'password'));
	echo $this->Form->input('password',array('label'=>'Senha atual'));
	echo $this->Form->submit('Salvar alterações',array('class'=>'btn btn-primary'));
echo $this->Form->end();
?>
