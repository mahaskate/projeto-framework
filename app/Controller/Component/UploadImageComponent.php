<?php
App::uses('Component', 'Controller');
class UploadImageComponent extends Component{
	public function uploadImage($foto){
		//verifica se tem informação, caso contrario sai da função
		//if($foto['error']==4)
		//	return false;
		//Configuração de extensão e tamanho de arquivo
		$extValida = 'image/jpeg';
		$tamanhoValido = 2000000; // 2MB
		//informações sobre o arquivo
		$path = $foto['tmp_name'];
		$nomeFoto = $foto['name'];
		$tamanho = $foto['size'];
		$ext = $foto['type'];
		//Teste de tipo de arquivo e tamanho
		if($ext != $extValida){
			$descErro = "Deve ser jpg";
			$erro = true;
		}else if($tamanho > $tamanhoValido){
			$descErro = "O tamanho do arquivo é ".$tamanho." e deve ser menor que ".$tamanhoValido;
			$erro = true;
		}
		if(!isset($erro)){
			$i=0;
			do {
				if($i>0) {
					$nomeFotoExp = explode('.',$nomeFoto);
					if($i==1){
						$nomeFoto = substr($nomeFoto,0,-4).'['.$i.'].'.array_pop($nomeFotoExp);
					} else {
						$nomeFoto = substr($nomeFoto,0,-7).'['.$i.'].'.array_pop($nomeFotoExp);									
					}
				}
				$i++;
			} while(file_exists('img/profile/'.$nomeFoto));
			copy($path,'img/profile/'.$nomeFoto);
			return true;
		}else{
			return false;
		}
	}
}

?>