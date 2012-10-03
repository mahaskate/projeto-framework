<?php
echo $this->Form->create('User',array('type'=>'file','class'=>'form-horizontal'));
	echo "<legend>Perfil</legend>";
	echo "<div class='control-group'>";
		echo "<label class='control-label'>Foto</label>";
		echo "<div class='controls'>";
			echo $this->Html->image('/attachments/photos/med/'.$thumb,array('width'=>80));
		echo "</div>";
	echo "</div>";
	echo $this->Form->input('user',array('label'=>false,'type'=>'file','help'=>'Escolha uma foto com no máximo 2mb.'));
	echo $this->Form->input('nome');
	echo $this->Form->submit('Salvar alterações',array('class'=>'btn btn-primary'));
echo $this->Form->end();

?>