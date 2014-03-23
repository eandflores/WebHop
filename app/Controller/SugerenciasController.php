<?php
	class SugerenciasController extends AppController {
		
		public function index() {
			$this->set('sugerencias', $this->Sugerencia->find('all'));
		}

		public function view($id) {
			$this->Sugerencia->id = $id;
			$this->set('sugerencia', $this->Sugerencia->read());
		}

		/*
		public function view($id) {
			$this->set('sugerencia', $this->Sugerencia->read(null,$id));
		}
		*/

		public function add() {
			if ($this->request->is('post')) {
				if ($this->Sugerencia->save($this->request->data)) {
					$this->Session->setFlash('La sugerencia ha sido enviada exitosamente.');
					$this->redirect(array('action' => 'index'));
				}
			}
		}

		function edit($id = null) {
			$this->set('sugerencia', $this->Sugerencia->read(null,$id));
			
			if($this->request->is('post')){

				$id = $this->request->data['id'];
				$texto = $this->request->data['texto'];

				$this->set('id', $id);
				$this->set('texto', $texto);
				
				$conditions = array("Sugerencia.texto" => $texto,"Sugerencia.id !=" => $id);

				if($this->Sugerencia->find('first', array('conditions' => $conditions))){
					$this->Session->setFlash('La sugerencia ingresada ya existe.','default', array("class" => "alert alert-error"));
				} 
				else{
					if($this->Sugerencia->save($this->request->data)){
						$this->Session->setFlash('La sugerencia ha sido actualizado exitosamente.','default', array("class" => "alert alert-success"));
						$this->redirect(array('action' => 'index'));
					} 
					else{
						$this->Session->setFlash('La sugerencia ha sido actualizado, intente nuevamente.','default', array("class" => "alert alert-error"));
					}
				}
			}
		}

		function delete($id) {
			if ($this->request->is('post')) {
				throw new MethodNotAllowedException();
			}
			if ($this->Sugerencia->delete($id)) {
				$this->Session->setFlash('La sugerencia ha sido eliminada.','default', array("class" => "alert alert-success"));
				$this->redirect(array('action' => 'index'));
			}
			else{
				$this->Session->setFlash('La sugerencia no pudo ser eliminada, intente nuevamente.','default', array("class" => "alert alert-error"));
				$this->redirect(array('action' => 'index'));
			}
		}


	}
?>