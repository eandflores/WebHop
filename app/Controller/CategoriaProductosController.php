<?php
	class CategoriaProductosController extends AppController {
		
		public $name = 'CategoriaProductos';

		var $uses = array('CategoriaProducto','Producto','User','Solicitud');

		public function beforeFilter() {
			$this->current_user = $this->Auth->user();
			$this->logged_in = $this->Auth->loggedIn();
			$this->set('logged_in',$this->logged_in);
			$this->set('current_user',$this->current_user);
		}

		public function index() {
			$this->set('categoriaproductos', $this->CategoriaProducto->find('all',array(
				'order' => array('CategoriaProducto.nombre')
			)));
		}

		public function add() {
			if ($this->request->is('post')) {

				$this->set('nombre', $this->request->data['nombre']);

				if($this->current_user['rol_id']== 1){
					if(!$this->CategoriaProducto->findBynombre($this->request->data['nombre'])){
						if ($this->CategoriaProducto->save($this->request->data)) {
							$this->Session->setFlash('La categoria ha sido guardada exitosamente.','default', array("class" => "alert alert-success"));
							$this->redirect(array('action' => 'index'));
						} 
						else 
							$this->Session->setFlash('La categoria no fue guardada, intente nuevamente.','default', array("class" => "alert alert-error"));
					} 
					else
						$this->Session->setFlash('La categoria ya existe.','default', array("class" => "alert alert-error"));
				}
				elseif($this->current_user['rol_id']!= 1){
					if(!$this->CategoriaProducto->findBynombre($this->request->data['nombre'])){
						
						$this->request->data['estado'] = "Pendiente";
						$this->request->data['sql'] = "INSERT INTO categoria_productos (\"nombre\") VALUES ('".$this->request->data['nombre']."')";
						$this->request->data['accion'] = "Agregar";
						$this->request->data['tabla'] = "CategoriaProductos";
						$this->request->data['campos'] = "Nombre: ".$this->request->data['nombre'];
						$this->request->data['user_id'] = $this->current_user['id'];
						

						if ($this->Solicitud->save($this->request->data)) {
							$this->Session->setFlash('Su solicitud fue enviada exitosamente.','default', array("class" => "alert alert-success"));
							$this->redirect(array('action' => 'index'));
						} 
						else 
							$this->Session->setFlash('Su solicitud no fue enviada, intente nuevamente.','default', array("class" => "alert alert-error"));
					} 
					else
						$this->Session->setFlash('La categoria ya existe.','default', array("class" => "alert alert-error"));
				}
			}
		}

		function edit($id = null) {
			$this->set('categoria', $this->CategoriaProducto->read(null,$id));
			
			if (!$this->request->is('get')) {
				if(!$this->CategoriaProducto->findBynombre($this->request->data['nombre'])){
					if ($this->CategoriaProducto->save($this->request->data)) {
						$this->Session->setFlash('La categoria ha sido actualizada exitosamente.','default', array("class" => "alert alert-success"));
						$this->redirect(array('action' => 'index'));
					} 
					else 
						$this->Session->setFlash('La categoria no fue actualizada, intente nuevamente.','default', array("class" => "alert alert-error"));
				}
				else
					$this->Session->setFlash('La categoria ya existe.','default', array("class" => "alert alert-error"));
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