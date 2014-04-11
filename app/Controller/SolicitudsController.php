<?php
	class SolicitudsController extends AppController {

		public $name = 'Solicituds';
		var $uses = array('Solicitud','User');

		public function beforeFilter() {
			$this->current_user = $this->Auth->user();
			$this->logged_in = $this->Auth->loggedIn();
			$this->set('logged_in',$this->logged_in);
			$this->set('current_user',$this->current_user);
		}
		
		public function index() {
			$this->set('solicitudes', $this->Solicitud->find('all',array(
				'order' => array('Solicitud.estado')
			)));
		}

		public function view($id) {
			$this->Solicitud->id = $id;
			$this->set('solicitud', $this->Solicitud->read());
		}


		/*
		public function view($id) {
			$this->set('solicitud', $this->Solicitud->read(null,$id));
		}
		*/

		public function add() {
			if ($this->request->is('post')) {
				if ($this->Solicitud->save($this->request->data)) {
					$this->Session->setFlash('La solicitud ha sido enviada exitosamente.');
					$this->redirect(array('action' => 'index'));
				}
			}
		}

		function edit($id = null) {
			$this->set('solicitud', $this->Solicitud->read(null,$id));
			
			if($this->request->is('post')){

				$id = $this->request->data['id'];
				$texto = $this->request->data['texto'];

				$this->set('id', $id);
				$this->set('texto', $texto);
				
				$conditions = array("Solicitud.texto" => $texto,"Solicitud.id !=" => $id);

				if($this->Solicitud->find('first', array('conditions' => $conditions))){
					$this->Session->setFlash('La solicitud ingresada ya existe.','default', array("class" => "alert alert-error"));
				} 
				else{
					if($this->Solicitud->save($this->request->data)){
						$this->Session->setFlash('La sugerencia ha sido actualizada exitosamente.','default', array("class" => "alert alert-success"));
						$this->redirect(array('action' => 'index'));
					} 
					else{
						$this->Session->setFlash('La solicitud ha sido actualizada, intente nuevamente.','default', array("class" => "alert alert-error"));
					}
				}
			}
		}

		function delete($id) {
			if ($this->request->is('post')) {
				throw new MethodNotAllowedException();
			}
			if ($this->Solicitud->delete($id)) {
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