<?php
	class SolicitudsController extends AppController {
		public $name = 'Solicituds';
		var $uses = array('Solicitud','User','Local');

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
			$this->set('solicitud', $this->Solicitud->read(null,$id));
			$admin_id = $this->Solicitud->data['Solicitud']['admin_id'];
			$admin = $this->User->read(null,$admin_id);
			$admin_username = $admin['User']['username'];
			$this->set('admin_username', $admin_username);
		}
		public function delete($id) {
			if ($this->request->is('post')) {
				throw new MethodNotAllowedException();
			}
			if ($this->Solicitud->delete($id)) {
				$this->Session->setFlash('La solicitud ha sido eliminada.','default', array("class" => "alert alert-success"));
				$this->redirect(array('action' => 'index'));
			}
			else{
				$this->Session->setFlash('La solicitud no pudo ser eliminada, intente nuevamente.','default', array("class" => "alert alert-error"));
				$this->redirect(array('action' => 'index'));
			}	
		}
		public function aprobar($id) {
			if ($this->request->is('post')) {
				throw new MethodNotAllowedException();
			} 
			else {
				$this->set('solicitud', $this->Solicitud->read(null,$id));
				$consulta=$this->Solicitud->data['Solicitud']['sql'];
				$this->Solicitud->query("$consulta");
				$this->Solicitud->set(array('estado' => "Aprobado"));
				$this->Solicitud->set(array('admin_id' => $this->current_user['id']));
				$this->Solicitud->set(array('modified' => date("d-m-Y H:i:s")));
								
				if ($this->Solicitud->save()) {
					$this->Session->setFlash('El Solicitud ha sido aprobada','default', array("class" => "alert alert-success"));
					$this->redirect(array('action' => 'index'));
				} 
				else {
					$this->Session->setFlash('El Solicitud no fue deshabilitado.','default', array("class" => "alert alert-error"));
	        		$this->redirect(array('action' => 'index'));
				}
			}
		}
		public function rechazar($id) {
			if ($this->request->is('post')) {
				throw new MethodNotAllowedException();
			} 
			else {
				
				$this->Solicitud->read(null,$id);
				$this->Solicitud->set(array('estado' => "Rechazado"));
				$this->Solicitud->set(array('admin_id' => $this->current_user['id']));
				$this->Solicitud->set(array('modified' => date("d-m-Y H:i:s")));
				
				if ($this->Solicitud->save()) {
					$this->Session->setFlash('La Solicitud ha sido rechazada','default', array("class" => "alert alert-success"));
					$this->redirect(array('action' => 'index'));
				} 
				else {
					$this->Session->setFlash('El Solicitud no fue habilitado.','default', array("class" => "alert alert-error"));
	        		$this->redirect(array('action' => 'index'));
				}
			}
		}

		public function informe() {
			$fecha_inicio = $this->request->data['fechaIni1'];
			$fecha_fin = $this->request->data['fechaFin1'];
			$estado = $this->request->data['estado'];

			$this->set('fecha_inicio', $fecha_inicio);
			$this->set('fecha_fin', $fecha_fin);
			$this->set('estado', $estado);

			$solicitudes = array();

			if($estado == "Todos"){
				$solicitudes = $this->Solicitud->find('all',array(
		 						'order' => 'Solicitud.created',
		 						'conditions' => array(
		 											'Solicitud.estado' => array("Aprobado","Rechazado"),
		 											'Solicitud.modified >=' => $fecha_inicio.' 00:00:00',
		 											'Solicitud.modified <=' => $fecha_fin.' 23:59:59',
		 										)
		 					));
			}
			else if($estado == "Creadas"){
				$solicitudes = $this->Solicitud->find('all',array(
		 						'order' => 'Solicitud.created',
		 						'conditions' => array(
		 											'Solicitud.created >=' => $fecha_inicio.' 00:00:00',
		 											'Solicitud.created <=' => $fecha_fin.' 23:59:59',
		 										)
		 					));
			}
			else{
				$solicitudes = $this->Solicitud->find('all',array(
		 						'order' => 'Solicitud.created',
		 						'conditions' => array(
		 											'Solicitud.estado' => $estado,
		 											'Solicitud.modified >=' => $fecha_inicio.' 00:00:00',
		 											'Solicitud.modified <=' => $fecha_fin.' 23:59:59',
		 										)
		 					));
			}

			$this->set('usuarios', $this->User->find('all'));
			$this->set('solicitudes', $solicitudes);
		}

		public function informe_local() {
			$fecha_inicio = $this->request->data['fechaIni1'];
			$fecha_fin = $this->request->data['fechaFin1'];
			$estado = $this->request->data['estado'];

			$this->set('fecha_inicio', $fecha_inicio);
			$this->set('fecha_fin', $fecha_fin);
			$this->set('estado', $estado);

			$solicitudes = array();
			$localesId = array();

			$conditionsl = array("Local.admin_id" => $this->current_user['id']);
			$locales = $this->Local->find('all',array('conditions' => $conditionsl, 'order' => array('Local.nombre')));

			foreach ($locales as $index => $local) {
				array_push($localesId,$local['Local']['id']);
			}

			if($estado == "Todos"){
				$solicitudes = $this->Solicitud->find('all',array(
		 						'order' => 'Solicitud.created',
		 						'conditions' => array(
		 											'Solicitud.estado' => array("Aprobado","Rechazado"),
		 											'Solicitud.modified >=' => $fecha_inicio.' 00:00:00',
		 											'Solicitud.modified <=' => $fecha_fin.' 23:59:59',
		 											'Solicitud.local_id' => $localesId
		 										)
		 					));
			}
			else if($estado == "Creadas"){
				$solicitudes = $this->Solicitud->find('all',array(
		 						'order' => 'Solicitud.created',
		 						'conditions' => array(
		 											'Solicitud.created >=' => $fecha_inicio.' 00:00:00',
		 											'Solicitud.created <=' => $fecha_fin.' 23:59:59',
		 											'Solicitud.local_id' => $localesId
		 										)
		 					));
			}
			else{
				$solicitudes = $this->Solicitud->find('all',array(
		 						'order' => 'Solicitud.created',
		 						'conditions' => array(
		 											'Solicitud.estado' => $estado,
		 											'Solicitud.modified >=' => $fecha_inicio.' 00:00:00',
		 											'Solicitud.modified <=' => $fecha_fin.' 23:59:59',
		 											'Solicitud.local_id' => $localesId
		 										)
		 					));
			}

			$this->set('usuarios', $this->User->find('all'));
			$this->set('solicitudes', $solicitudes);
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
					if($solicitud['Solicitud']['estado'] == "Aprobada")
						$this->Solicitud->query($solicitud['Solicitud']['sql']);
					
					$mensaje = 'EXITO'; 
					
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