<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

	//public $scaffold;
	public $components = array('UploadImage','Attachment');
	public $helpers = array('Chocolate','Form'=> array('className' => 'TwitterBootstrap.BootstrapForm'),'Paginator' => array('className' => 'TwitterBootstrap.BootstrapPaginator'));
	public $paginate = array('limit'=>10);

	public function beforeFilter() {
	    parent::beforeFilter();
	    $this->Auth->allow('add','redefinesenha','requisitaredefinesenha');
	}

	public function teste(){
		$this->layout = 'home';
		$id = $this->Auth->user('id');
		$this->set('user',$this->User->read(null, $id));
	}

	public function requisitaRedefineSenha(){
		$this->layout = 'home';
		$this->set('title_for_layout','Redefinir senha');
		if ($this->Auth->login()){
			$this->Redirect(array('action'=>'meuperfil'));
		}
		if ($this->request->is('post')) {
			if($this->request->data['User']['username'] ==""){
				$this->Session->setFlash('Você não digitou o seu email','flashError');
				$this->redirect(array('action'=>'requisitaredefinesenha'));
			}
			$email = $this->request->data['User']['username'];
			$flag = $this->User->find('first',array('conditions'=>array('username'=>$email)));
			$id = $flag['User']['id'];
			$this->User->id = $id;
			if (!$this->User->exists()) {
				$this->Session->setFlash('O email que você digitou não consta nos nossos registros','flashError');	
			} else {
				$token = md5(rand(1,100)."fds564fds54f".rand(1,32));
				$this->User->set(array('senhaToken'=>$token));
				$this->User->save();
				$this->Session->setFlash('Você receberá uma mensagem no email <strong>'.$email.'</strong> com as instruções para você recuperar a sua senha','flashSuccess');
				$this->redirect(array('action'=>'requisitaredefinesenha'));
			}
		}
	}

	public function redefineSenha($username = null, $token = null){
		$this->layout = 'home';
		$this->set('title_for_layout','Redefinir senha');
		$this->set('username',$username);//Passa o username para a view para quando trocar a senha já usar o username e a nova senha para logar
		$i = $this->User->find('first',array('conditions'=>array('username'=>$username)));
		$id = $i['User']['id'];
		$username = $i['User']['username'];
		$this->User->id = $id;
		if (!$this->User->exists() || $token != $i['User']['senhaToken'] || $token == null) {
			$this->redirect(array('controller'=>'/'));
		} else{
			if($this->request->is('post')){
				if($this->User->save($this->request->data)){
					$this->Session->setFlash('A sua senha foi trocada com sucesso','flashSuccess');
					if($this->Auth->login())
						$this->Auth->redirect();
					else
						$this->Session->setFlash('Sua senha foi trocada mas deu erro no login, tente outra vez','flashError');
				}
			}
		}
	}

	public function admin_index() {
		$this->layout = 'admin';
		$username = $this->Auth->user('username');
		$this->set('username',$username);
		$thumb = $this->Auth->user('user_file_path');
		$this->set('thumb',$thumb);
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	public function login(){
		$this->layout = 'home';
		$this->set('title_for_layout','Entrar');
		if ($this->Auth->login())//Se já estiver logado não acessa a página de login
			$this->Redirect(array('controller'=>'users','action'=>'meuperfil'));
		if ($this->request->is('post')) {
	        if ($this->Auth->login()) {
	            $this->redirect($this->Auth->redirect());
	        } else {
	            $this->Session->setFlash('O email ou a senha estão incorretos.','flashError');
	            $this->request->data['User']['password'] = "";
	        }
	    }

	}

	public function logout(){
		$this->redirect($this->Auth->logout());	
	}

	public function settingsSenha(){
		$this->layout = 'settings';
		$this->set('title_for_layout','Configurações de senha');
		$this->User->id = $this->Auth->user('id');
		$username = $this->User->field('username');
		$this->set('username',$username);
		$thumb = $this->Auth->user('user_file_path');
		$this->set('thumb',$thumb);
		if($this->request->is('post')){
			$id = $this->Auth->user('id');
			$novaSenha = $this->request->data['User']['novaSenha'];
			$confirmaSenha = Security::hash($this->request->data['User']['password'],null,true);
			$flag = $this->User->read(null, $id);
			$senhaAtual = $flag['User']['password'];

			if($this->request->data['User']['novaSenha'] == ""){
				$this->User->invalidate('novaSenha','Você deve digitar uma nova senha');
			}else if($this->request->data['User']['password'] == ""){
				$this->User->invalidate('password','Você deve confirmar a sua senha atual');
			}else{
				if($senhaAtual == $confirmaSenha){
					$this->User->id = $id;
					$this->User->set(array('password'=>$novaSenha));
					if($this->User->save()){
						$this->request->data['User']['novaSenha'] = "";
						$this->request->data['User']['password'] = "";
						$this->Session->setFlash('Sua senha foi alterada corretamente','flashSuccess');
						$this->redirect(array('action'=>'settingssenha'));
					}
					else
						$this->Session->setFlash('Erro ao salvar no banco de dados','flashError');
				}else{
					$this->request->data['User']['password'] = "";
					$this->Session->setFlash('Sua senha atual é inválida','flashError');
				}
			}
		}
	}

	public function reativa(){
		$id = $this->Auth->user('id');
		$this->User->id = $id;
		$this->User->set(array('status'=>'ativado'));
		$this->User->save();
		$this->Session->setFlash('A sua conta foi reativada com sucesso e está pronta para ser usada','flashSuccess');
		$this->redirect(array('action'=>'meuperfil'));
	}

	public function desativa(){
		$this->set('title_for_layout','Desativar conta');
		$id = $this->Auth->user('id');
		$this->User->id = $id;
		$username = $this->User->field('username');
		$this->set('username',$username);
		$thumb = $this->Auth->user('user_file_path');
		$this->set('thumb',$thumb);
		if($this->request->is('post')){
			if ($this->request->data['User']['password'] == "") {
				$this->Session->setFlash('Para sua segurança você deve confirmar a sua senha.','flashError');
				$this->redirect(array('action'=>'desativa'));				
			}
			$password = $this->User->field('password');
			$cpassword = $this->request->data['User']['password'];
			$cpassword = Security::hash($cpassword,null,true);
			if ($cpassword == $password){
				$this->User->set(array('status'=>'desativado'));
				if($this->User->save()){
					$this->Session->setFlash('Sua conta foi desativa. Esperamos que volte logo <strong>=)</strong>','flashSuccess');
					$this->Redirect($this->Auth->logout());
				} else {
					$this->Session->setFlash('Ocorreu um erro ao desativar a sua conta','flashError');
					$this->redirect(array('action'=>'desativa'));
				}
			} else {
				$this->Session->setFlash('A senha que você digitou é inválida','flashError');	
				$this->redirect(array('action'=>'desativa'));
			}

		}
	}
	public function settingsConta(){
		$this->layout = 'settings';
		$this->set('title_for_layout','Configurações de conta');
		$id = $this->Auth->user('id');
		$this->User->id = $id;
		$username = $this->User->field('username');
		$this->set('nome',$this->Auth->user('nome'));
		$this->set('username',$username);
		$thumb = $this->User->field('user_file_path');
		$this->set('thumb',$thumb);
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if($this->request->data['User']['username'] == $this->Auth->user('username')){
				$this->Redirect(array('action'=>'settingsconta'));	
			}
			$confirmaSenha = $this->request->data['User']['confirmarSenha'];
			if($confirmaSenha == ""){
				$this->Session->setFlash('Você deve confirmar a sua senha','flashError');
				$this->Redirect(array('action'=>'settingsconta'));
			}
			$confirmaSenha = Security::hash($confirmaSenha,null,true);
			$senha = $this->User->field('password');
			if($senha !=$confirmaSenha){
				$this->Session->setFlash('Você não confirmou a sua senha corretamente','flashError');
				$this->Redirect(array('action'=>'settingsconta'));
			}
			$novoUsername = $this->request->data['User']['username'];
			if($novoUsername != $this->Auth->user('username')){ // Só troca se o username for diferente do atual
				$token = md5(rand(1,100)."fds564fds54f".rand(1,32));
				$this->User->set(array('usernameToken'=>$token,'usernameTemp'=>$novoUsername));
				$this->User->save();
				$this->request->data = $this->User->read(null, $id);
				$this->Session->setFlash('Enviamos uma mensagem para você confirmar o seu novo endereço de e-mail.','flashInfo');
				$this->redirect(array('action'=>'meuperfil'));
			} else {
				//$this->Session->setFlash('O e-mail que você inseriu é igual ao e-mail atual que está em uso.','flashError');
			}
		} else {
			$this->request->data = $this->User->read(null, $id);
		}
	}

	public function trocaUsername($token = null){
		$id = $this->Auth->user('id');
		$this->User->id = $id;
		$tokenBd = $this->User->field('usernameToken');
		if($token != null && $tokenBd == $token) {
			$usernameTemp = $this->User->field('usernameTemp');
			$this->User->set(array('usernameToken'=>null,'usernameTemp'=>null,'username'=>$usernameTemp));
			if($this->User->save()){
				$username = $this->User->field('username');
				$this->Session->setFlash('O seu email de acesso foi trocado para <strong>'.$username.'</strong>','flashSuccess');
				$this->redirect(array('action'=>'meuperfil'));
			}else {
				$this->Session->setFlash('Não salvou','flashError');
			}
		} else {
			$this->Session->setFlash('Token para troca de username invalido','flashError');
			$this->redirect(array('controller'=>'users','action'=>'meuperfil'));
		}
	}

	public function meuPerfil() {
		$id = $this->Auth->user('id');
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->set('title_for_layout',$this->User->field('nome'));
		$username = $this->User->field('username');
		$this->set('username',$username);
		$thumb = $this->User->field('user_file_path');
		$this->set('thumb',$thumb);
		$this->set('user', $this->User->read(null, $id));
		$user = $this->User->read(null, $id);
		if($user['User']['usernameToken'] != ""){
			$this->set('usernameFlag',true); //Diz para a view que tem confirmação de email pendente
		}
	}

	public function add() {
		$this->layout = 'home';
		$this->set('title_for_layout','Criar perfil');

		if($this->Auth->login())//Se já estiver logado não acessa a página de login
			$this->Redirect(array('controller'=>'users','action'=>'meuperfil'));
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash('Você criou a sua conta com sucesso!','flashSuccess');
				$this->Auth->login();
				$this->redirect(array('action' => 'meuperfil'));
			} else {
			}
		}
	}

	public function cancelaTrocaUsername(){
		$id = $this->Auth->user('id');
		$this->User->id = $id;
		$this->User->set(array('usernameToken'=>null,'usernameTemp'=>null));
		$this->User->save();
		$this->redirect(array('action'=>'meuperfil'));
	}

	public function settingsPerfil() {
		$this->layout = 'settings';
		$this->set('title_for_layout','Editar perfil');
		$id = $this->Auth->user('id');
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$username = $this->Auth->user('username');
		$this->set('username',$username);
		$thumb = $this->User->field('user_file_path');
		$this->set('thumb',$thumb);
		if ($this->request->is('post') || $this->request->is('put')) {
			$thumbAntigo = $this->User->field('user_file_path');
			if($this->Attachment->upload($this->request->data['User'])){
				if($thumbAntigo != 'noAvatar.jpg'){ // Teste p n deletar o noAvatar
					$this->Attachment->delete_files($thumbAntigo);
				}
			}
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash('As suas alterações foram salvas com sucesso','flashSuccess');
				$this->redirect(array('action' => 'settingsperfil'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->User->read(null, $id);
		}
	}

	public function ativa($token = null) {
		if($token == $this->Auth->user('statusToken')){
			$this->User->id = $this->Auth->user('id');
			$status = $this->User->set(array('status'=>'ativado'));
			if($this->User->save($status)){
				$this->Session->setFlash('A sua conta foi ativada com sucesso e está pronta para ser usada.','flashSuccess');
				$this->redirect(array('action'=>'meuperfil'));
			}
		}else{
			echo "deu ruim";
		}	
	}

	public function delete() {
	}
}