<?php
	class SugerenciasController extends AppController {

		public $name = 'Sugerencias';
		
		var $uses = array('User','Sugerencia');

		public function beforeFilter() {
			$this->Auth->allow('add');
			$this->current_user = $this->Auth->user();
			$this->logged_in = $this->Auth->loggedIn();
			$this->set('logged_in',$this->logged_in);
			$this->set('current_user',$this->current_user);
		}
		
		public function index() {
			$this->set('sugerencias', $this->Sugerencia->find('all'));
		}

		public function view($id) {
			$this->set('sugerencia', $this->Sugerencia->read(null,$id));
		}

		public function add() {
			if ($this->request->is('post')) {
				if ($this->Sugerencia->save($this->request->data)) {
					$this->Session->setFlash('La sugerencia ha sido enviada exitosamente.','default', array("class" => "alert alert-success"));
					$this->redirect(array('controller' => 'Users' , 'action' => 'index'));
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