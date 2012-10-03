<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class PagesController extends AppController {
	public $helpers = array('Form'=> array('className' => 'TwitterBootstrap.BootstrapForm'),'Paginator' => array('className' => 'TwitterBootstrap.BootstrapPaginator'));
	
	public function beforeFilter() {
	    parent::beforeFilter();
	    $this->Auth->allow('home');
	}

	public function home(){
		$this->layout = 'home';
		$this->set('title_for_layout','Página Inicial');
		$id = $this->Auth->user('id');
		if($id!="")
			$this->Redirect(array('controller'=>'users','action'=>'meuperfil'));
	}
}

?>