<?php
	class Usuario extends AppModel {
		public $name = 'Usuario';

		public function index() {
			$this->set('usuarios', $this->Usuario->find('all'));
		}

		public function view($id) {
			$this->Usuario->id = $id;
			$this->set('usuario', $this->Usuario->read());
		}

		public function add() {
			if ($this->request->is('post')) {
				if ($this->Usuario->save($this->request->data)) {
					$this->Session->setFlash('El usuario ha sido guardado exitosamente.');
					$this->redirect(array('action' => 'index'));
				}
			}
		}

		function edit($id = null) {
			$this->Usuario->id = $id;
			if ($this->request->is('get')) {
				$this->request->data = $this->Usuario->read();
			} 
			elseif ($this->Usuario->save($this->request->data)) {
				$this->Session->setFlash('El usuario ha sido actualizado exitosamente.');
				$this->redirect(array('action' => 'index'));
			}
		}

		function delete($id) {
			if (!$this->request->is('post')) {
				throw new MethodNotAllowedException();
			}
			if ($this->Usuario->delete($id)) {
				$this->Session->setFlash('El usuario no pudo ser eliminado');
				$this->redirect(array('action' => 'index'));
			}
		}
	}
?>