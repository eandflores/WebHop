<?php
	class ComentariosController extends AppController {

		public function beforeFilter() {
			$this->current_user = $this->Auth->user();
			$this->logged_in = $this->Auth->loggedIn();
			$this->set('logged_in',$this->logged_in);
			$this->set('current_user',$this->current_user);
		}
		
		public function index() {
			$this->set('comentarios', $this->Comentario->find('all'));
		}

		public function view($id) {
			$this->set('comentario', $this->Comentario->read(nul,$id));
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
			$this->set('comentario', $this->Comentario->read(null,$id));
			
			if($this->request->is('post')){

				$id = $this->request->data['id'];
				$texto = $this->request->data['texto'];

				$this->set('id', $id);
				$this->set('texto', $texto);
				
				$conditions = array("Comentario.texto" => $texto,"Comentario.id !=" => $id);

				if($this->Comentario->find('first', array('conditions' => $conditions))){
					$this->Session->setFlash('El comentario ingresado ya existe.','default', array("class" => "alert alert-error"));
				} 
				else{
					if($this->Comentario->save($this->request->data)){
						$this->Session->setFlash('El comentario ha sido actualizado exitosamente.','default', array("class" => "alert alert-success"));
						$this->redirect(array('action' => 'index'));
					} 
					else{
						$this->Session->setFlash('El comentario ha sido actualizado, intente nuevamente.','default', array("class" => "alert alert-error"));
					}
				}
			}
		}

		function delete($id) {
			if ($this->request->is('post')) {
				throw new MethodNotAllowedException();
			}
			if ($this->Comentario->delete($id)) {
				$this->Session->setFlash('El comentario ha sido eliminado.','default', array("class" => "alert alert-success"));
				$this->redirect(array('action' => 'index'));
			}
			else{
				$this->Session->setFlash('El comentario no pudo ser elimonado, intente nuevamente.','default', array("class" => "alert alert-error"));
				$this->redirect(array('action' => 'index'));
			}	
		}

	}
?>