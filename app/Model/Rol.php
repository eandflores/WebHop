<?php
	class Rol extends AppModel {
		public $name = 'Rol';

		public function index() {
			$this->set('roles', $this->Rol->find('all'));
		}

		public function view($id) {
			$this->Rol->id = $id;
			$this->set('rol', $this->Rol->read());
		}

		public function add() {
			if ($this->request->is('post')) {
				if ($this->Rol->save($this->request->data)) {
					$this->Session->setFlash('El rol ha sido guardado exitosamente.');
					$this->redirect(array('action' => 'index'));
				}
			}
		}

		function edit($id = null) {
			$this->Rol->id = $id;
			if ($this->request->is('get')) {
				$this->request->data = $this->Rol->read();
			} 
			elseif ($this->Rol->save($this->request->data)) {
				$this->Session->setFlash('El rol ha sido actualizado exitosamente.');
				$this->redirect(array('action' => 'index'));
			}
		}

		function delete($id) {
			if (!$this->request->is('post')) {
				throw new MethodNotAllowedException();
			}
			if ($this->Rol->delete($id)) {
				$this->Session->setFlash('El rol no pudo ser eliminado');
				$this->redirect(array('action' => 'index'));
			}
		}
	}
?>