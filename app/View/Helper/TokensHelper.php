<?php

App::uses('AppHelper', 'View/Helper');

class TokensHelper extends AppHelper{

	public function token(){
		$a = rand(1,100).'das540'.rand(1,50);
		$a=md5($a);
		$a=md5($a);
		$a=md5($a);
		return $a;
	}

}
?>