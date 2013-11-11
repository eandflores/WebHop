<?php

	class UsersController extends AppController {
		
		public $name = 'Users';

		var $uses = array('User','Rol','Region','Comuna');

		var $sacaffold;

		public function beforeFilter(){
			parent::beforeFilter();
			$this->Auth->allow('index','add');
		}
		
		public function index(){

		}

		public function all() {
			$this->set('usuarios', $this->User->find('all',array(
				'order' => array('User.nombre')
			)));
		}

		public function view($id) {
			$this->set('usuario', $this->User->read(null,$id));
		}

		public function add() {
			$this->set('regiones',$this->Region->find('all',array(
				'order' => array('Region.nombre')
			)));
			$this->set('comunas',$this->Comuna->find('all',array(
				'order' => array('Comuna.nombre')
			)));
			$this->set('roles',$this->Rol->find('all',array(
				'order' => array('Rol.nombre')
			)));

			if ($this->request->is('post')) {
				$rut = $this->request->data['rut'];
				$username = $this->request->data['username'];
				$email = $this->request->data['email'];
				
				if($this->User->findByrut($rut)){
					$this->Session->setFlash('El rut '.$rut.' ya esta registrado.','default', array("class" => "alert alert-error"));
					$this->redirect(array('action' => 'add'));
				} 
				elseif($this->User->findByusername($username)){
					$this->Session->setFlash('El username '.$username.' ya esta registrado.','default', array("class" => "alert alert-error"));
					$this->redirect(array('action' => 'add'));
				} 
				elseif($this->User->findByemail($email)){
					$this->Session->setFlash('El mail '.$email.' ya esta registrado.','default', array("class" => "alert alert-error"));
					$this->redirect(array('action' => 'add'));
				} 
				else{
					if ($this->User->save($this->request->data)) {
						$this->Session->setFlash('El usuario ha sido guardado exitosamente.','default', array("class" => "alert alert-success"));
						$this->redirect(array('action' => 'index'));
					} 
					else 
						$this->Session->setFlash('El usuario no fue guardado, intente nuevamente.','default', array("class" => "alert alert-error"));
				} 
			}
		}

		function edit($id = null) {
			$this->set('usuario', $this->User->read(null,$id));

			$this->set('roles',$this->Rol->find('all',array(
				'order' => array('Rol.nombre')
			)));
			$this->set('regiones',$this->Region->find('all',array(
				'order' => array('Region.nombre')
			)));
			$this->set('comunas',$this->Comuna->find('all',array(
				'order' => array('Comuna.nombre')
			)));
			if (!$this->request->is('get')) {
				$rut = $this->request->data['rut'];
				$email = $this->request->data['email'];

				if($this->User->findByrut($rut)){
					$this->Session->setFlash('El rut '.$rut.' ya esta esta registrado.','default', array("class" => "alert alert-error"));
				} 
				elseif($this->User->findByemail($email)){
					$this->Session->setFlash('El mail '.$email.' ya esta registrado.','default', array("class" => "alert alert-error"));
				} 
				else{
					if ($this->User->save($this->request->data)) {
						$this->Session->setFlash('El usuario ha sido actualizado exitosamente.','default', array("class" => "alert alert-success"));
						$this->redirect(array('action' => 'index'));
					} 
					else 
						$this->Session->setFlash('El usuario no fue actualizado, intente nuevamente.','default', array("class" => "alert alert-error"));
				}
			} 
		}

		function disable($id) {
			if ($this->request->is('post')) {
				throw new MethodNotAllowedException();
			} 
			else {
				$this->User->read(null,$id);
				$this->User->set(array('estado' => false));

				if ($this->User->save()) {
					$this->Session->setFlash('El usuario ha sido deshabilitado','default', array("class" => "alert alert-success"));
					$this->redirect(array('action' => 'index'));
				} 
				else {
					$this->Session->setFlash('El usuario no fue deshabilitado.','default', array("class" => "alert alert-error"));
	        		$this->redirect(array('action' => 'index'));
				}
			}
			
		}

		function enable($id) {
			if ($this->request->is('post')) {
				throw new MethodNotAllowedException();
			} 
			else {
				$this->User->read(null,$id);
				$this->User->set(array('estado' => true));

				if ($this->User->save()) {
					$this->Session->setFlash('El usuario ha sido habilitado','default', array("class" => "alert alert-success"));
					$this->redirect(array('action' => 'index'));
				} 
				else {
					$this->Session->setFlash('El usuario no fue habilitado.','default', array("class" => "alert alert-error"));
	        		$this->redirect(array('action' => 'index'));
				}
			}
		}

		public function login(){
			$logged_in = $this->Auth->loggedIn();

			if(!empty($logged_in)){
				$this->Session->setFlash('Usted ya ha iniciado sesión.','default', array("class" => "alert alert-warning"));
				$this->redirect(array('action' => 'index'));
			}

			if($this->request->is('post')){
				if($this->Auth->login()){
					$this->redirect($this->Auth->redirect());
				}
				else{
					$this->Session->setFlash('Error iniciando sesión, compruebe que su username y/o password sean correctos.','default', array("class" => "alert alert-error"));
        			$this->redirect(array('action' => 'login'));
				}
			}
		}

		public function logout(){
			$this->redirect($this->Auth->logout());
		}
	}
?>