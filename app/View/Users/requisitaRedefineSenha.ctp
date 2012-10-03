<div class="well">
<?php
echo $this->Form->create('User');
	echo "<legend>Redefinir Senha</legend>";
	echo $this->Form->input('username',array('type'=>'email','label'=>'Email','help'=>'Digite o email que você usa para acessar a sua conta'));
	echo $this->Form->submit('Redefinir senha',array('class'=>'btn btn-primary'));
echo $this->Form->end();
?>
</div>