<div class="well">
<?php
	//echo $this->Session->flash('auth');
	echo $this->Form->create('User',array('class'=>'form-horizontal formLogin'));
		echo "<legend>Entrar</legend>";
		echo $this->Form->input('username',array('label'=>'Email','class'=>'txtLogin'));
		echo $this->Form->input('password',array('class'=>'txtLogin','label'=>'Senha','help'=>$this->Html->link('Esqueceu sua senha?',array('controller'=>'users','action'=>'requisitaredefinesenha'))));
		echo $this->Form->submit('Entrar',array('class'=>'btn btn-primary btn-large','after'=>' Ainda não tem uma conta? '.$this->Html->link('Clique aqui',array('action'=>'add'))));
	echo $this->Form->end();
?>
</div>