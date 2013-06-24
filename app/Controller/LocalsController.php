<?php
	class LocalsController extends AppController {

		public $name = 'Locals';

		var $uses = array('User','Region','Comuna','Local','CategoriaLocal');
		
		var $sacaffold;

		public function index() {
			$this->set('locales', $this->Local->find('all'));
		}

		public function view($id) {
			$this->Local->id = $id;
			$this->set('local', $this->Local->read());
		}

		public function add() {
			$this->set('categorias',$this->CategoriaLocal->find('all',array(
				'order' => array('CategoriaLocal.nombre')
			)));
			$this->set('regiones',$this->Region->find('all'));
			$this->set('comunas',$this->Comuna->find('all'));

			if ($this->request->is('post')) {
				$nombre = $this->request->data['nombre'];
				
				if(!$this->Local->existe($nombre)){
					$current_user = $this->Auth->user();
					$usuario = $this->User->find('first',array(
						'conditions' => array('User.username' => $current_user['username'])
					)); 
					$this->request->data['user_id'] = $usuario['User']['id'];
					$this->request->data['region_id'] = 8;

					if ($this->Local->save($this->request->data)) {
						$this->Session->setFlash('El local ha sido guardado exitosamente.','default', array("class" => "alert alert-success"));
						$this->redirect(array('action' => 'add'));
					} else {
						$this->Session->setFlash('El local no fue guardado, intente nuevamente.','default', array("class" => "alert alert-error"));
						$this->redirect(array('action' => 'add'));
					}
				} else{
					$this->Session->setFlash('El local ya existe.','default', array("class" => "alert alert-error"));
					$this->redirect(array('action' => 'add'));
				}
			}
		}

		function edit($id = null) {
			$this->Local->id = $id;
			if ($this->request->is('get')) {
				$this->request->data = $this->Local->read();
			} elseif ($this->Local->save($this->request->data)) {
				$this->Session->setFlash('El local ha sido actualizado exitosamente.', array("class" => "alert alert-success"));
				$this->redirect(array('action' => 'edit'));
			} else {
				$this->Session->setFlash('El local no fue actualizado, intente nuevamente.','default', array("class" => "alert alert-error"));
				$this->redirect(array('action' => 'edit'));
			}
		}

		function delete($id) {
			if (!$this->request->is('post')) {
				throw new MethodNotAllowedException();
			}
			if ($this->Local->delete($id)) {
				$this->Session->setFlash('El local ha sido eliminado','default', array("class" => "alert alert-success"));
				$this->redirect(array('action' => 'delete'));
			}
			$this->Session->setFlash('El local no fue eliminado.','default', array("class" => "alert alert-error"));
        	$this->redirect(array('action' => 'delete'));
		}
	}
?>