<b>De</b> <?php echo $contato['Contato']['nome'];?> - <?php echo $contato['Contato']['email'];?>
<br>
<b>Assunto</b> <?php echo $contato['Contato']['titulo'];?>
<br>
<b>Data</b> <?php echo $this->Time->format('d/m/y h:m',$contato['Contato']['created']);?>
<hr>
<p> <?php echo $contato['Contato']['texto'];?></p>
