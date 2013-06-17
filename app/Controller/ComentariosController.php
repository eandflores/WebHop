<?php
	class ComentariosController extends AppController {
		
		public function index() {
			$this->set('comentarios', $this->Comentario->find('all'));
		}

		public function view($id) {
			$this->Comentario->id = $id;
			$this->set('comentario', $this->Comentario->read());
		}

		public function add() {
			if ($this->request->is('post')) {
				if ($this->Comentario->save($this->request->data)) {
					$this->Session->setFlash('El comentario ha sido enviado exitosamente.');
					$this->redirect(array('action' => 'index'));
				}
			}
		}

		function edit($id = null) {
			$this->Comentario->id = $id;
			if ($this->request->is('get')) {
				$this->request->data = $this->Comentario->read();
			} 
			elseif ($this->Comentario->save($this->request->data)) {
				$this->Session->setFlash('El comentario ha sido actualizado exitosamente.');
				$this->redirect(array('action' => 'index'));
			}
		}

		function delete($id) {
			if (!$this->request->is('post')) {
				throw new MethodNotAllowedException();
			}
			if ($this->Comentario->delete($id)) {
				$this->Session->setFlash('El comentario no pudo ser eliminado');
				$this->redirect(array('action' => 'index'));
			}
		}
	}
?>