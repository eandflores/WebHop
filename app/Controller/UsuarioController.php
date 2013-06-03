<?php
	class UsuarioController extends AppController {

		public $components = array('Auth', 'Session');

		public function beforeFilter(){
			parent::beforeFilter();
	     	$this->Auth->authenticate = 'Form';
		}

		public function index() {
			$this->set('usuarios', $this->Usuario->find('all'));
		}

		public function view($id) {
			$this->Usuario->usu_id = $id;
			$this->set('usuario', $this->Usuario->read());
		}

		public function add() {
			if ($this->request->is('post')) {
				if ($this->Usuario->save($this->request->data)) {
					$this->Session->setFlash('El usuario ha sido guardado exitosamente.');
					$this->redirect(array('action' => 'index'));
				}
				else 
                	$this->Session->setFlash('El usuario no pudo ser guardado. Por favor, intentelo de nuevo.'));
			}
		}

		public function edit($id = null) {
			$this->Usuario->usu_id = $id;
			if ($this->request->is('get')) {
				$this->request->data = $this->Usuario->read();
			} 
			else{
				if ($this->Usuario->save($this->request->data)) {
					$this->Session->setFlash('El usuario ha sido actualizado exitosamente.');
					$this->redirect(array('action' => 'index'));
				}
				else 
                	$this->Session->setFlash('El ususario no pudo ser actualizado. intentelo de nuevo.'));
			}
		}

		public function delete($id) {
			if (!$this->request->is('post')) {
				throw new MethodNotAllowedException();
			}
			if ($this->Usuario->delete($id)) {
				$this->Session->setFlash('El usuario ha sido eliminado.');
				$this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('El usuario no fue eliminado.'));
        	$this->redirect(array('action' => 'index'));
		}

		public function login() {
		    if ($this->request->is('post')) {
		        if ($this->Auth->login()) {
		            $this->redirect($this->Auth->redirect());
		        } else 
		            $this->Session->setFlash('Username o password invalido, intentelo de nuevo'));
		    }
		}

		public function logout() {
		    $this->redirect($this->Auth->logout());
		}
	}
?>