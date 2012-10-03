<div class="well">
<?php echo $this->Form->create('Contato',array('class'=>'form-horizontal formLogin')); ?>
	<fieldset>
		<legend>Enviar mensagem</legend>
	<?php
		echo $this->Form->input('nome',array('class'=>'txtLogin'));
		echo $this->Form->input('email',array('class'=>'txtLogin'));
		echo $this->Form->input('titulo',array('label'=>'Assunto','class'=>'txtLogin'));
		echo $this->Form->input('texto',array('label'=>false,'style'=>'width:400px;','placeholder'=>'Mensagem','help'=>'*Máximo de 500 caracteres'));
		echo $this->Form->submit('Enviar mensagem',array('class'=>'btn btn-primary'));
	?>
	</fieldset>
<?php echo $this->Form->end(); ?>
</div>