<?php
	class Sugerencia extends AppModel {
		public $name = 'Sugerencia';

		public function index() {
			$this->set('sugerencias', $this->Sugerencia->find('all'));
		}

		public function view($id) {
			$this->Sugerencia->id = $id;
			$this->set('sugerencia', $this->Sugerencia->read());
		}

		public function add() {
			if ($this->request->is('post')) {
				if ($this->Sugerencia->save($this->request->data)) {
					$this->Session->setFlash('La sugerencia ha sido enviada exitosamente.');
					$this->redirect(array('action' => 'index'));
				}
			}
		}

		function edit($id = null) {
			$this->Sugerencia->id = $id;
			if ($this->request->is('get')) {
				$this->request->data = $this->Sugerencia->read();
			} 
			elseif ($this->Sugerencia->save($this->request->data)) {
				$this->Session->setFlash('La sugerencia ha sido actualizada exitosamente.');
				$this->redirect(array('action' => 'index'));
			}
		}

		function delete($id) {
			if (!$this->request->is('post')) {
				throw new MethodNotAllowedException();
			}
			if ($this->Sugerencia->delete($id)) {
				$this->Session->setFlash('La sugerencia no pudo ser eliminada');
				$this->redirect(array('action' => 'index'));
			}
		}
	}
?>