<?php

	class UsersController extends AppController {
		
		var $uses = array('User','Region','Comuna');
		var $sacaffold;

		public function beforeFilter(){
			parent::beforeFilter();
			$this->Auth->allow('add');
		}
		
		public function index() {
			$this->set('usuarios', $this->User->find('all'));
		}

		public function view($id) {
			$this->User->id = $id;
			$this->set('usuario', $this->User->read());
		}

		public function add() {
			$this->set('regiones',$this->Region->find('all'));
			$this->set('comunas',$this->Comuna->find('all'));

			if ($this->request->is('post')) {
				$this->request->data['aportes_totales'] = 0;
				$this->request->data['aportes_aprobados'] = 0;
				$this->request->data['cant_votos_positivos'] = 0;
				$this->request->data['cant_votos_negativos'] = 0;
				$this->request->data['cant_comentarios'] = 0;
				$this->request->data['fecha_actualizacion'] = date('Y-m-d');
				$this->request->data['estado'] = true;
				$this->request->data['rol_id'] = 1;

				if ($this->User->save($this->request->data)) {
					$this->Session->setFlash('El usuario ha sido guardado exitosamente.');
					$this->redirect(array('action' => 'index'));
				}
				else {
					$this->Session->setFlash('El usuario no fue guardado, intente nuevamente.');
					$this->redirect(array('action' => 'index'));
				}
			}
		}

		function edit($id = null) {
			$this->User->id = $id;
			if ($this->request->is('get')) {
				$this->request->data = $this->User->read();
			} 
			elseif ($this->User->save($this->request->data)) {
					$this->Session->setFlash('El usuario ha sido actualizado exitosamente.');
					$this->redirect(array('action' => 'index'));
			}
			else {
				$this->Session->setFlash('El usuario no fue actualizado, intente nuevamente.');
				$this->redirect(array('action' => 'index'));
			}
			
		}

		public function delete($id) {
			if (!$this->request->is('post')) {
				throw new MethodNotAllowedException();
			}
			if ($this->User->delete($id)) {
				$this->Session->setFlash('El usuario ha sido eliminado.');
				$this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash('El usuario no fue eliminado.');
        	$this->redirect(array('action' => 'index'));
		}

		public function login(){
			if($this->request->is('post')){
				if($this->Auth->login()){
					$this->redirect($this->Auth->redirect());
				}
				else{
					$this->set("error",true);
				}
			}
		}

		public function logout(){
			$this->redirect($this->Auth->logout());
		}
	}
?>