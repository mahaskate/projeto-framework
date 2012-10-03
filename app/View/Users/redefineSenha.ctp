<?php

echo $this->Form->create('User');
	echo "<legend>Redefinir senha</legend>";
	echo $this->Form->input('senhaToken',array('type'=>'hidden','value'=>$username)); //deixa o username escondido para quando trocar a senha já logar
	echo $this->Form->input('password',array('label'=>'Nova senha'));
	echo $this->Form->input('cpassword',array('label'=>'Confirmar nova senha'));
	echo $this->Form->input('senhaToken',array('type'=>'hidden','value'=>null));
	echo $this->Form->submit('Redefinir Senha',array('class'=>'btn btn-primary'));
echo $this->Form->end();

?>