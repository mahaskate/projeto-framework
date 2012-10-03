<?php
App::uses('AppController', 'Controller');
/**
 * Contatos Controller
 *
 * @property Contato $Contato
 */
class ContatosController extends AppController {

	public $helpers = array('Time','Chocolate','Form'=> array('className' => 'TwitterBootstrap.BootstrapForm'),'Paginator' => array('className' => 'TwitterBootstrap.BootstrapPaginator'));
	public $paginate = array('limit'=>10);

	public function beforeFilter() {
	    parent::beforeFilter();
	    $this->Auth->allow('add','view','index','admin_index','admin_view');
	}

	public function add() {
		$this->layout = 'home';
		$this->set('title_for_layout','Contato');
		$id = $this->Auth->user('id');
		if($id!="")
			$this->Redirect(array('controller'=>'users','action'=>'meuperfil'));
		if ($this->request->is('post')) {
			$this->Contato->create();
			if ($this->Contato->save($this->request->data)) {
				$this->Session->setFlash('A sua mensagem foi enviada com sucesso, estaremos respondendo em breve','flashSuccess');
				$this->redirect(array('controller'=>'homes','action'=>'index'));
			} else {
			}
		}
	}

	public function admin_index() {
		$this->layout = 'admin';
		$username = $this->Auth->user('username');
		$this->set('username',$username);
		$thumb = $this->Auth->user('user_file_path');
		$this->set('thumb',$thumb);
		$this->Contato->recursive = 0;
		$this->set('contatos', $this->paginate());
	}

	public function admin_view($id = null) {
		$this->layout = 'admin';
		$username = $this->Auth->user('username');
		$this->set('username',$username);
		$thumb = $this->Auth->user('user_file_path');
		$this->set('thumb',$thumb);
		$this->Contato->id = $id;
		if (!$this->Contato->exists()) {
			throw new NotFoundException(__('Invalid contato'));
		}
		$this->set('contato', $this->Contato->read(null, $id));
	}

	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Contato->id = $id;
		if (!$this->Contato->exists()) {
			throw new NotFoundException(__('Invalid contato'));
		}
		if ($this->Contato->delete()) {
			$this->flash(__('Contato deleted'), array('action' => 'index'));
		}
		$this->flash(__('Contato was not deleted'), array('action' => 'index'));
		$this->redirect(array('action' => 'index'));
	}
}
