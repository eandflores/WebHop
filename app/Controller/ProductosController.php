<?php
	class ProductosController extends AppController {
		
		public $name = 'Productos';

		var $uses = array('Producto','CategoriaProducto','User','Oferta');

		public function index() {
			$this->set('productos', $this->Producto->find('all',array(
				'order' => array('Producto.nombre')
			)));
		}

		public function add() {
			$this->set('categorias',$this->CategoriaProducto->find('all',array(
				'order' => array('CategoriaProducto.nombre')
			)));

			if ($this->request->is('post')) {
				if(!$this->Producto->findBynombre($this->request->data['nombre'])){
					$current_user = $this->Auth->user();
					$usuario = $this->User->find('first',array(
						'conditions' => array('User.username' => $current_user['username'])
					)); 
					$this->request->data['user_id'] = $usuario['User']['id'];

					if ($this->Producto->save($this->request->data)) {
						$this->Session->setFlash('El producto ha sido guardado exitosamente.','default', array("class" => "alert alert-success"));
						$this->redirect(array('action' => 'index'));
					} 
					else 
						$this->Session->setFlash('El producto no fue guardado, intente nuevamente.','default', array("class" => "alert alert-error"));
				} 
				else
					$this->Session->setFlash('El nombre del producto ya existe.','default', array("class" => "alert alert-error"));
			}
		}

		function edit($id = null) {
			$this->set('producto', $this->Producto->read(null,$id));

			$this->set('categorias',$this->CategoriaProducto->find('all',array(
				'order' => array('CategoriaProducto.nombre')
			)));

			if (!$this->request->is('get')) {
				if (!$this->Producto->findBynombre($this->request->data['nombre'])) {
					if ($this->Producto->save($this->request->data)) {
						$this->Session->setFlash('El producto ha sido actualizado exitosamente.','default', array("class" => "alert alert-success"));
						$this->redirect(array('action' => 'index'));
					} 
					else 
						$this->Session->setFlash('El producto no fue actualizado, intente nuevamente.','default', array("class" => "alert alert-error"));
				}
				else
					$this->Session->setFlash('El nombre del producto ya existe.','default', array("class" => "alert alert-error"));
			} 
		}

		function delete($id) {
			if ($this->request->is('post')) {
				throw new MethodNotAllowedException();
			}
			if(!$this->Oferta->findByproducto_id($id)){
				if ($this->Producto->delete($id)) {
					$this->Session->setFlash('El producto ha sido eliminado','default', array("class" => "alert alert-success"));
					$this->redirect(array('action' => 'index'));
				}
				else {
					$this->Session->setFlash('El producto no fue eliminado.','default', array("class" => "alert alert-success"));
		        	$this->redirect(array('action' => 'index'));
		        }
		    }
		    else {
				$this->Session->setFlash('El producto no fue eliminado porque esta asociado a algun local.','default', array("class" => "alert alert-error"));
				$this->redirect(array('action' => 'index'));
			}
		}
	}
?>