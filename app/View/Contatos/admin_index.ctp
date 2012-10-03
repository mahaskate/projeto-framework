	<h2><?php echo 'Mensagens'; ?></h2>
	<?php
		echo $this->Paginator->counter(array('format' => " <span class='label label-info'>Página {:page} - {:pages} de total de um {:count} mensagem(s)</span>"));
		echo "<br>";
		echo "<br>";
	?>
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th style="width:250px;">De</th>
				<th>Assunto</th>
				<th style="width:35px;">Ação</th>
			</tr>
		</thead>
	<?php
	foreach ($contatos as $contato): ?>
	<tr>
		<td><?php echo $this->Html->link($contato['Contato']['nome'],array('action'=>'view',$contato['Contato']['id']),array('title'=>$contato['Contato']['email'])); ?></td>
		<td><?php echo $this->Html->link($contato['Contato']['titulo'],array('action'=>'view',$contato['Contato']['id'])); ?></td>
		<td>
			<?php echo $this->Form->postLink("<i class='icon-trash icon-white'></i>", array('action' => 'delete', $contato['Contato']['id']),array('escape'=>false,'class'=>'btn btn-danger btn-small'), __('Tem certeza que deseja deletar a mensagem # %s?', $contato['Contato']['titulo'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<ul class="pagination">
		<?php echo $this->Paginator->numbers();?>
	</ul>
