<div class="well">
<?php
echo $this->Form->create('User',array('class'=>'form-horizontal formLogin'));
	echo "<legend>Criar perfil</legend>";
	echo $this->Form->input('nome',array('class'=>'txtLogin'));
	echo $this->Form->input('user_file_path',array('type'=>'hidden','value'=>'noAvatar.jpg'));
	echo $this->Form->input('username',array('class'=>'txtLogin','label'=>'Email','title'=>'Email'));
	echo $this->Form->input('password',array('class'=>'txtLogin','label'=>'Senha'));
	echo $this->Form->input('cpassword',array('class'=>'txtLogin','type'=>'password','label'=>'Confirmar Senha'));
	echo $this->Form->input('status',array('type'=>'hidden','value'=>'pendente'));
	echo $this->Form->input('role',array('type'=>'hidden','value'=>'regular'));
	echo $this->Form->input('statusToken',array('type'=>'hidden','value'=>$this->Tokens->token()));
	echo $this->Form->submit('Criar perfil',array('class'=>'btn btn-warning btnCriarPerfil'));
echo $this->Form->end();
?>
</div>