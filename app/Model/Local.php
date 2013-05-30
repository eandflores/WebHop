<?php
	class Local extends AppModel {
		public $name = 'Local';

		public function index() {
			$this->set('locales', $this->Local->find('all'));
		}

		public function view($id) {
			$this->Local->id = $id;
			$this->set('local', $this->Local->read());
		}

		public function add() {
			if ($this->request->is('post')) {
				if ($this->Local->save($this->request->data)) {
					$this->Session->setFlash('El local ha sido guardado exitosamente.');
					$this->redirect(array('action' => 'index'));
				}
			}
		}

		function edit($id = null) {
			$this->Local->id = $id;
			if ($this->request->is('get')) {
				$this->request->data = $this->Local->read();
			} 
			elseif ($this->Local->save($this->request->data)) {
				$this->Session->setFlash('El local ha sido actualizado exitosamente.');
				$this->redirect(array('action' => 'index'));
			}
		}

		function delete($id) {
			if (!$this->request->is('post')) {
				throw new MethodNotAllowedException();
			}
			if ($this->Local->delete($id)) {
				$this->Session->setFlash('El local no pudo ser eliminado');
				$this->redirect(array('action' => 'index'));
			}
		}
	}
?>