<?php
	class SubcategoriaProductosController extends AppController {
		
		public $name = 'SubcategoriaProductos';

		var $uses = array('SubcategoriaProducto','CategoriaProducto','Producto','User','Solicitud');

		public function beforeFilter() {
			$this->current_user = $this->Auth->user();
			$this->logged_in = $this->Auth->loggedIn();
			$this->set('logged_in',$this->logged_in);
			$this->set('current_user',$this->current_user);
		}

		public function index() {
			$this->set('subcategoriaproductos', $this->SubcategoriaProducto->find('all',array(
				'order' => array('SubcategoriaProducto.nombre')
			)));
		}

		public function add() {
			$this->set('categorias',$this->CategoriaProducto->find('all',array(
				'order' => array('CategoriaProducto.nombre')
			)));

			if ($this->request->is('post')) {

				$this->set('nombre', $this->request->data['nombre']);
				$this->set('_categoria', $this->request->data['categoria_producto_id']);

				if(!$this->SubcategoriaProducto->findBynombre($this->request->data['nombre'])){
					if($this->current_user['rol_id'] == 1){
						$current_user = $this->Auth->user();
						$usuario = $this->User->find('first',array(
							'conditions' => array('User.username' => $current_user['username'])
						)); 
						$this->request->data['user_id'] = $usuario['User']['id'];

						if ($this->SubcategoriaProducto->save($this->request->data)) {
							$this->Session->setFlash('El producto ha sido guardado exitosamente.','default', array("class" => "alert alert-success"));
							$this->redirect(array('action' => 'index'));
						} 
						else 
							$this->Session->setFlash('El producto no fue guardado, intente nuevamente.','default', array("class" => "alert alert-error"));
					}

					elseif($this->current_user['rol_id'] != 1){
						$categoriap = $this->CategoriaProducto->read(null,$this->request->data['categoria_producto_id']);
						$this->request->data['estado'] = "Pendiente";
						$this->request->data['sql'] = "INSERT INTO productos (\"nombre\",\"categoria_producto_id\",\"user_id\") VALUES ('".$this->request->data['nombre']."','".$this->request->data['categoria_producto_id']."','".$this->current_user['id']."')";
						$this->request->data['accion'] = "Agregar";
						$this->request->data['tabla'] = "Productos";
						$this->request->data['campos'] = "Nombre: ".$this->request->data['nombre'].", CategoriaProducto: ".$categoriap['CategoriaProducto']['nombre'].", Usuario: ".$this->current_user['username'];
						$this->request->data['user_id'] = $this->current_user['id'];

						if ($this->Solicitud->save($this->request->data)) {
							$this->Session->setFlash('Su solicitud fue enviada exitosamente.','default', array("class" => "alert alert-success"));
							$this->redirect(array('action' => 'index'));
						} 
						else 
							$this->Session->setFlash('Su solicitud no fue enviada, intente nuevamente.','default', array("class" => "alert alert-error"));
					}	

				} 
				else
					$this->Session->setFlash('El nombre del producto ya existe.','default', array("class" => "alert alert-error"));
			}
		}

		function edit($id = null) {
			$this->set('subcategoria', $this->SubcategoriaProducto->read(null,$id));

			$this->set('categorias',$this->CategoriaProducto->find('all',array(
				'order' => array('CategoriaProducto.nombre')
			)));

			if ($this->request->is('post')) {

				$id = $this->request->data['id'];
				$nombre = $this->request->data['nombre'];

				$this->set('nombre', $nombre);
				$this->set('_categoria', $this->request->data['categoria_producto_id']);

				$conditions = array("SubcategoriaProducto.nombre" => $nombre,"SubcategoriaProducto.id !=" => $id);

				if($this->Producto->find('first', array('conditions' => $conditions))){
					$this->Session->setFlash('El nombre de la subcategoría de producto ya existe.','default', array("class" => "alert alert-error"));
				}
				else{
					if ($this->SubcategoriaProducto->save($this->request->data)) {
						$this->Session->setFlash('La subcategoría de producto ha sido actualizado exitosamente.','default', array("class" => "alert alert-success"));
						$this->redirect(array('action' => 'index'));
					} 
					else{
						$this->Session->setFlash('La subcategoría de producto no fue actualizada, intente nuevamente.','default', array("class" => "alert alert-error"));
					}
				}
			} 
		}

		function delete($id) {
			if ($this->request->is('post')) {
				throw new MethodNotAllowedException();
			}
			if(!$this->Producto->findBysubcategoria_producto_id($id)){
				if ($this->SubcategoriaProducto->delete($id)) {
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