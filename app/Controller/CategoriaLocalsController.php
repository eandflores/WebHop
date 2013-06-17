<?php
	class CategoriaLocalsController extends AppController {

		public function index() {
			$this->set('categorialocales', $this->CategoriaLocal->find('all'));
		}

		public function view($id) {
			$this->CategoriaLocal->id = $id;
			$this->set('categorialocal', $this->CategoriaLocal->read());
		}

		public function add() {
			if ($this->request->is('post')) {
				if ($this->CategoriaLocal->save($this->request->data)) {
					$this->Session->setFlash('La categoria ha sido guardada exitosamente.');
					$this->redirect(array('action' => 'index'));
				}
			}
		}

		function edit($id = null) {
			$this->CategoriaLocal->id = $id;
			if ($this->request->is('get')) {
				$this->request->data = $this->CategoriaLocal->read();
			} 
			elseif ($this->CategoriaLocal->save($this->request->data)) {
				$this->Session->setFlash('La categoria ha sido actualizada exitosamente.');
				$this->redirect(array('action' => 'index'));
			}
		}

		function delete($id) {
			if (!$this->request->is('post')) {
				throw new MethodNotAllowedException();
			}
			if ($this->CategoriaLocal->delete($id)) {
				$this->Session->setFlash('La categoria no pudo ser eliminada');
				$this->redirect(array('action' => 'index'));
			}
		}
	}
?>