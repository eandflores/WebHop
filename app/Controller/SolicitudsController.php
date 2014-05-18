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
			$this->set('solicitud', $this->Solicitud->read(null,$id));
			$admin_id = $this->Solicitud->data['Solicitud']['admin_id'];
			$admin = $this->User->read(null,$admin_id);
			$admin_username = $admin['User']['username'];
			$this->set('admin_username', $admin_username);
		}

		function delete($id) {
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

		function aprobar($id) {
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

		function rechazar($id) {
			if ($this->request->is('post')) {
				throw new MethodNotAllowedException();
			} 
			else {
				
				$this->Solicitud->read(null,$id);
				$this->Solicitud->set(array('estado' => "Rechazado"));
				$this->Solicitud->set(array('admin_id' => $this->current_user['id']));
				$this->Solicitud->set(array('modified' => date("d-m-Y H:i:s")));
				$this->Solicitud->data['Solicitud']['admin_username'] = $admin_username;

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


	}
?>