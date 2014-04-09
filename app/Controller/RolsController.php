<?php
	class RolsController extends AppController {
		
		public $name = 'Rols';

		var $uses = array('Rol','User');

		public function beforeFilter() {
			$this->current_user = $this->Auth->user();
			$this->logged_in = $this->Auth->loggedIn();
			$this->set('logged_in',$this->logged_in);
			$this->set('current_user',$this->current_user);
		}
		
		public function index() {
			$this->set('roles', $this->Rol->find('all',array(
				'order' => array('Rol.nombre')
			)));
		}

		public function add() {
			if($this->request->is('post')){

				$this->set('nombre', $this->request->data['nombre']);

				if(!$this->Rol->findBynombre($this->request->data['nombre'])){
					if ($this->Rol->save($this->request->data)){
						$this->Session->setFlash('El rol ha sido guardado exitosamente.','default', array("class" => "alert alert-success"));
						$this->redirect(array('action' => 'index'));
					} 
					else 
						$this->Session->setFlash('El rol no fue guardado, intente nuevamente.','default', array("class" => "alert alert-error"));
				}
				else{
					$this->Session->setFlash('El rol ingresado ya existe.','default', array("class" => "alert alert-error"));
				}	
			}
		}

		function edit($id = null) {

			$this->set('rol', $this->Rol->read(null,$id));

			if($this->request->is('post')){

				$id = $this->request->data['id'];
				$nombre = $this->request->data['nombre'];

				$this->set('id', $id);
				$this->set('nombre', $nombre);
				
				$conditions = array("Rol.nombre" => $nombre,"Rol.id !=" => $id);

				if($this->Rol->find('first', array('conditions' => $conditions))){
					$this->Session->setFlash('El rol ingresado ya existe.','default', array("class" => "alert alert-error"));
				} 
				else{
					if($this->Rol->save($this->request->data)){
						$this->Session->setFlash('El rol ha sido actualizado exitosamente.','default', array("class" => "alert alert-success"));
						$this->redirect(array('action' => 'index'));
					} 
					else{
						$this->Session->setFlash('El rol no ha sido actualizado, intente nuevamente.','default', array("class" => "alert alert-error"));
					}
				}
			}
		}

		function delete($id) {
			if ($this->request->is('post')) {
				throw new MethodNotAllowedException();
			}
			if(!$this->User->findByrol_id($id)){
				if ($this->Rol->delete($id)) {
					$this->Session->setFlash('El rol ha sido eliminado.','default', array("class" => "alert alert-success"));
					$this->redirect(array('action' => 'index'));
				}
				else{
					$this->Session->setFlash('El rol no pudo ser eliminado, intente nuevamente.','default', array("class" => "alert alert-error"));
					$this->redirect(array('action' => 'index'));
				}
			}
			else{
				$this->Session->setFlash('El rol no fue eliminado porque esta asociado a algun usuario.','default', array("class" => "alert alert-error"));
				$this->redirect(array('action' => 'index'));
			}
		}
	}
?>