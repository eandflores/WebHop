<?php
	class SolicitudsController extends AppController {

		public $name = 'Solicituds';
		var $uses = array('Solicitud','User');

		public function beforeFilter() {
			parent::beforeFilter();
			$this->Auth->allow('solicitudes','actualizarSolicitud');

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

		public function add() {
			if ($this->request->is('post')) {
				if ($this->Solicitud->save($this->request->data)) {
					$this->Session->setFlash('La solicitud ha sido enviada exitosamente.');
					$this->redirect(array('action' => 'index'));
				}
			}
		}

		public function edit($id = null) {
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

		public function delete($id) {
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

		//--------------------------ANDROID-------------------------//

		public function solicitudes(){
			$this->autoRender = false;

			$solicitudes = $this->Solicitud->find('all',array(
						 						'conditions' => array('Solicitud.estado' => "Pendiente")
						 					));
			$solicitudes_ = array();

			foreach ($solicitudes as $index => $solicitud) {

				$solicitudes_[$index] = $solicitud['Solicitud'];
			}
			echo json_encode($solicitudes_);
		}

		public function actualizarSolicitud(){
			$this->autoRender = false;

			$mensaje = '';
			$solicitud = '';
			$accion = '';

			if ($this->request->is('post')){

				$accion = $this->request->data['accion'];

				$solicitud = $this->Solicitud->read(null,$this->request->data['id']);

				if($this->request->data['accion'] == 1)
					$solicitud['Solicitud']['estado'] = "Aprobada";
				else
					$solicitud['Solicitud']['estado'] = "Rechazada";
				
				$solicitud['Solicitud']['admin_id'] = $this->request->data['admin_id'];

				if ($this->Solicitud->save($solicitud)){

					if($solicitud['Solicitud']['estado'] == "Rechazada")
						$mensaje = 'EXITO';
					else{
						$aux= $this->Solicitud->query($solicitud['Solicitud']['sql']);
						if($aux)
							$mensaje = $aux; 
						else{
							$mensaje = 'No se pudo aprobar la solicitd, intentelo nuevamente.'; 
							
							$solicitud['Solicitud']['estado'] = "Pendiente";
							$solicitud['Solicitud']['admin_id'] = null;
							$this->Solicitud->save($solicitud);
						}
					}
				}
				else{
					if($solicitud['Solicitud']['estado'] == "Aprobada")
						$mensaje = 'No se pudo aprobar la solicitd, intentelo nuevamente.'; 
					else
						$mensaje = 'No se pudo rechazar la solicitd, intentelo nuevamente.'; 
				}
			}

			$json['mensaje'] = $mensaje;
			echo json_encode($json);
		}
	}	
?>