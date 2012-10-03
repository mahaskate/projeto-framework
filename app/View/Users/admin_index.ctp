	<h2><?php echo 'Usuários'; ?></h2>
	<?php
		echo $this->Paginator->counter(array('format' => " <span class='label label-info'>Página {:page} - {:pages} de um total de {:count} usuários(s)</span>"));
		echo "<br>";
		echo "<br>";
	?>
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th style="width:20px;">#</th>
				<th style="width:350px;">Email</th>
				<th>Nome</th>
			</tr>
		</thead>
	<?php
	foreach ($users as $user): ?>
	<tr>
		<td><?php echo $user['User']['id'];?></td>
		<td><?php echo $user['User']['username'];?></td>
		<td><?php echo $user['User']['nome'];?></td>
	</tr>
<?php endforeach; ?>
	</table>
	<ul class="pagination">
		<?php echo $this->Paginator->numbers();?>
	</ul>
