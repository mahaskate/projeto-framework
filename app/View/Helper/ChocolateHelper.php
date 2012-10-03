<?php
App::uses('AppHelper', 'View/Helper');

class ChocolateHelper extends AppHelper{
	
	public $helpers = array('Html');

	public function thumbnail($image,$options=null,$link=null){
		$a = "<ul class='thumbnails'>";
			$a.="<li class=''>";
				if($link ==""){
					$a.=$this->Html->image($image,array('width'=>$options['width'],'class'=>'thumbnail '.$options['class'],'title'=>$options['title']));
				}else{
					if(!isset($link['controller']))
						$a.=$this->Html->image($image,array('width'=>$options['width'],'class'=>'thumbnail','title'=>$options['title'],'url'=>array('action'=>$link['action'])));
					else
						$a.=$this->Html->image($image,array('width'=>$options['width'],'class'=>'thumbnail','title'=>$options['title'],'url'=>array('controller'=>$link['controller'],'action'=>$link['action'])));
				}
			$a.="</li>";
		$a.="</ul>";
		return $a;
	}

}
?>