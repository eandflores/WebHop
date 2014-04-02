<?php
	class CategoriaProductosController extends AppController {
		
		public $name = 'CategoriaProductos';

		var $uses = array('CategoriaProducto','Producto');
		
		public function index() {
			$this->set('categoriaproductos', $this->CategoriaProducto->find('all',array(
				'order' => array('CategoriaProducto.nombre')
			)));
		}

		public function add() {
			if ($this->request->is('post')) {

				$this->set('nombre', $this->request->data['nombre']);
				
				if(!$this->CategoriaProducto->findBynombre($this->request->data['nombre'])){
					if ($this->CategoriaProducto->save($this->request->data)) {
						$this->Session->setFlash('La categoria ha sido guardada exitosamente.','default', array("class" => "alert alert-success"));
						$this->redirect(array('action' => 'index'));
					} 
					else{
						$this->Session->setFlash('La categoria no fue guardada, intente nuevamente.','default', array("class" => "alert alert-error"));
					}
				} 
				else{
					$this->Session->setFlash('La categoria ya existe.','default', array("class" => "alert alert-error"));
				}
			}
		}

		function edit($id = null) {

			$this->set('categoria', $this->CategoriaProducto->read(null,$id));
			
			if ($this->request->is('post')) {

				$id = $this->request->data['id'];
				$nombre = $this->request->data['nombre'];

				$this->set('id', $id);
				$this->set('nombre', $nombre);

				$conditions = array("CategoriaProducto.nombre" => $nombre,"CategoriaProducto.id !=" => $id);

				if($this->CategoriaProducto->find('first', array('conditions' => $conditions))){
					$this->Session->setFlash('La categoria ya existe.','default', array("class" => "alert alert-error"));
				}
				else{
					if ($this->CategoriaProducto->save($this->request->data)) {
						$this->Session->setFlash('La categoria ha sido actualizada exitosamente.','default', array("class" => "alert alert-success"));
						$this->redirect(array('action' => 'index'));
					} 
					else{
						$this->Session->setFlash('La categoria no fue actualizada, intente nuevamente.','default', array("class" => "alert alert-error"));
					}
				}		
			} 
		}

		function delete($id) {
			if ($this->request->is('post')) {
				throw new MethodNotAllowedException();
			}
			if(!$this->Producto->findBycategoria_producto_id($id)){
				if ($this->CategoriaProducto->delete($id)) {
					$this->Session->setFlash('La categoria ha sido eliminada','default', array("class" => "alert alert-success"));
					$this->redirect(array('action' => 'index'));
				} 
				else {
					$this->Session->setFlash('La categoria no fue eliminada.','default', array("class" => "alert alert-error"));
		        	$this->redirect(array('action' => 'index'));
		        }
		    } 
		    else{
				$this->Session->setFlash('La categoria no fue eliminada porque esta asociada a algun producto.','default', array("class" => "alert alert-error"));
				$this->redirect(array('action' => 'index'));
			}	
		}
	}
?>