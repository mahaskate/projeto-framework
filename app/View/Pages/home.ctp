<div class="hero-unit">
   	<h1>Chocolate php!</h1>
 	<p>Um Framework em php que deixa o desenvolvimento de sistemas web açuquinha no bigode.</p>
    <p>
    	<?php echo $this->Html->link("<i class='icon-share-alt icon-white'></i> Entrar",array('controller'=>'users','action'=>'login'),array('class'=>'btn btn-primary btn-large','escape'=>false))?>
    	<?php echo $this->Html->link("<i class='icon-tint'></i> Criar conta",array('controller'=>'users','action'=>'add'),array('class'=>'btn btn-large','escape'=>false))?>
    </p>
</div>