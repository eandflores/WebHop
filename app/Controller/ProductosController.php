<?php
	class ProductosController extends AppController {
		
		public $name = 'Productos';

		var $uses = array('User','Producto','CategoriaProducto');
		
		var $sacaffold;

		public function index() {
			$this->set('productos', $this->Producto->find('all'));
		}

		public function view($id) {
			$this->Producto->id = $id;
			$this->set('producto', $this->Producto->read());
		}

		public function add() {
			$this->set('categorias',$this->CategoriaProducto->find('all',array(
				'order' => array('CategoriaProducto.nombre')
			)));

			if ($this->request->is('post')) {
				$nombre = $this->request->data['nombre'];

				if(!$this->Producto->existe($nombre)){
					$current_user = $this->Auth->user();
					$usuario = $this->User->find('first',array(
						'conditions' => array('User.username' => $current_user['username'])
					)); 
					$this->request->data['user_id'] = $usuario['User']['id'];

					if ($this->Producto->save($this->request->data)) {
						$this->Session->setFlash('El producto ha sido guardado exitosamente.','default', array("class" => "alert alert-success"));
						$this->redirect(array('action' => 'add'));
					} else {
						$this->Session->setFlash('El producto no fue guardado, intente nuevamente.','default', array("class" => "alert alert-error"));
						$this->redirect(array('action' => 'add'));
					} 
				} else{
					$this->Session->setFlash('El producto ya existe.','default', array("class" => "alert alert-error"));
					$this->redirect(array('action' => 'add'));
				}
			}
		}

		function edit($id = null) {
			$this->Producto->id = $id;
			if ($this->request->is('get')) {
				$this->request->data = $this->Producto->read();
			} 
			elseif ($this->Producto->save($this->request->data)) {
				$this->Session->setFlash('El producto ha sido actualizado exitosamente.','default', array("class" => "alert alert-success"));
				$this->redirect(array('action' => 'edit'));
			} else {
				$this->Session->setFlash('El producto no fue actualizado, intente nuevamente.','default', array("class" => "alert alert-error"));
				$this->redirect(array('action' => 'edit'));
			}
		}

		function delete($id) {
			if (!$this->request->is('post')) {
				throw new MethodNotAllowedException();
			}
			if ($this->Producto->delete($id)) {
				$this->Session->setFlash('El producto no pudo ser eliminado','default', array("class" => "alert alert-success"));
				$this->redirect(array('action' => 'delete'));
			}
			$this->Session->setFlash('El producto no fue eliminado.','default', array("class" => "alert alert-success"));
        	$this->redirect(array('action' => 'delete'));
		}
	}
?>