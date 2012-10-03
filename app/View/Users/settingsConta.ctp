<?php

echo $this->Form->create('User',array('class'=>'form-horizontal'));
	echo "<legend>Conta</legend>";
	echo $this->Form->input('username',array('label'=>'Email'));
	echo $this->Form->input('confirmarSenha',array('type'=>'password'));
	echo $this->Form->submit('Salvar alterações',array('class'=>'btn btn-primary'));
echo $this->Form->end();
echo $this->Html->link('Desativar conta',array('action'=>'desativa'),array('style'=>'margin-left:160px;'));

?>