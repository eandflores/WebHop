<?php
	class ProductosController extends AppController {
		
		public $name = 'Productos';

		var $uses = array('Producto','SubcategoriaProducto','CategoriaProducto','User','Oferta','Solicitud');

		public function beforeFilter() {
			$this->Auth->allow('productos');

			$this->current_user = $this->Auth->user();
			$this->logged_in = $this->Auth->loggedIn();
			$this->set('logged_in',$this->logged_in);
			$this->set('current_user',$this->current_user);
		}

		public function index() {
			$this->set('productos', $this->Producto->find('all',array(
				'order' => array('Producto.nombre')
			)));
		}

		public function add() {
			$this->set('subcategorias',$this->SubcategoriaProducto->find('all',array(
				'order' => array('SubcategoriaProducto.nombre')
			)));

			if ($this->request->is('post')) {

				$this->set('nombre', $this->request->data['nombre']);
				$this->set('_subcategoria', $this->request->data['subcategoria_producto_id']);

				if(!$this->Producto->findBynombre($this->request->data['nombre'])){
					if($this->current_user['rol_id'] == 1){
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

					elseif($this->current_user['rol_id'] != 1){
						$subcategoriap = $this->SubcategoriaProducto->read(null,$this->request->data['subcategoria_producto_id']);
						$this->request->data['estado'] = "Pendiente";
						$this->request->data['sql'] = "INSERT INTO productos (\"nombre\",\"subcategoria_producto_id\",\"user_id\",\"created\",\"modified\") VALUES ('".$this->request->data['nombre']."','".$this->request->data['subcategoria_producto_id']."','".$this->current_user['id']."','".date("d-m-Y H:i:s")."','".date("d-m-Y H:i:s")."')";
						$this->request->data['accion'] = "Agregar";
						$this->request->data['tabla'] = "Productos";
						$this->request->data['campos'] = "Nombre: ".$this->request->data['nombre'].", SubcategoriaProducto: ".$subcategoriap['SubcategoriaProducto']['nombre'].", Usuario: ".$this->current_user['username'];
						$this->request->data['user_id'] = $this->current_user['id'];

						if ($this->Solicitud->save($this->request->data)) {
							$this->Session->setFlash('Su solicitud fue enviada exitosamente.','default', array("class" => "alert alert-success"));
							$this->redirect(array('controller' => 'Users' , 'action' => 'index'));
						} 
						else 
							$this->Session->setFlash('Su solicitud no fue enviada, intente nuevamente.','default', array("class" => "alert alert-error"));
					}	

				} 
				else
					$this->Session->setFlash('El nombre del producto ya existe.','default', array("class" => "alert alert-error"));
			}
		}

		public function edit($id = null) {
			$this->set('producto', $this->Producto->read(null,$id));

			$this->set('subcategorias',$this->SubcategoriaProducto->find('all',array(
				'order' => array('SubcategoriaProducto.nombre')
			)));

			if ($this->request->is('post')) {

				$id = $this->request->data['id'];
				$nombre = $this->request->data['nombre'];

				$this->set('nombre', $nombre);
				$this->set('_subcategoria', $this->request->data['subcategoria_producto_id']);

				$conditions = array("Producto.nombre" => $nombre,"Producto.id !=" => $id);

				if($this->Producto->find('first', array('conditions' => $conditions))){
					$this->Session->setFlash('El nombre del producto ya existe.','default', array("class" => "alert alert-error"));
				}
				else{
					if ($this->Producto->save($this->request->data)) {
						$this->Session->setFlash('El producto ha sido actualizado exitosamente.','default', array("class" => "alert alert-success"));
						$this->redirect(array('action' => 'index'));
					} 
					else{
						$this->Session->setFlash('El producto no fue actualizado, intente nuevamente.','default', array("class" => "alert alert-error"));
					}
				}
			} 
		}

		public function delete($id) {
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

		public function informe() {
			$fecha_inicio = $this->request->data['fechaIni4'];
			$fecha_fin = $this->request->data['fechaFin4'];
			$categoria = $this->request->data['categoria'];
			$subcategoria = $this->request->data['subcategoria'];

			$this->set('fecha_inicio', $fecha_inicio);
			$this->set('fecha_fin', $fecha_fin);
			$this->set('categoria', $categoria);
			$this->set('subcategoria', $subcategoria);

			$productos = array();

			if($subcategoria != "Todas"){

				$this->set('subcat',$this->SubcategoriaProducto->read(null,$subcategoria));
				
				$productos = $this->Producto->find('all',array(
	 						'order' => 'Producto.created',
	 						'conditions' => array(
	 											'Producto.created >=' => $fecha_inicio.' 00:00:00',
	 											'Producto.created <=' => $fecha_fin.' 23:59:59',
	 											"Producto.subcategoria_producto_id" => $subcategoria
	 										)
	 					));
			} else {
				
				if($categoria == "Todas"){

					$productos = $this->Producto->find('all',array(
		 						'order' => 'Producto.created',
		 						'conditions' => array(
		 											'Producto.created >=' => $fecha_inicio.' 00:00:00',
		 											'Producto.created <=' => $fecha_fin.' 23:59:59',
		 										)
		 					));
				}
				else{

					$this->set('cat',$this->CategoriaProducto->read(null,$categoria));
				
					$productos = $this->Producto->find('all',array(
		 						'order' => 'Producto.created',
		 						'conditions' => array(
		 											'Producto.created >=' => $fecha_inicio.' 00:00:00',
		 											'Producto.created <=' => $fecha_fin.' 23:59:59',
		 											"SubcategoriaProducto.categoria_producto_id" => $categoria
		 										)
		 					));
				}
			}
			
			$this->set('categorias', $this->CategoriaProducto->find('all'));
			$this->set('productos', $productos);
		}

		#========================Android==========================#

		public function productos(){
			$this->autoRender = false;

			$productos = $this->Producto->find('all');
			$productos_ = array();

			foreach ($productos as $index => $producto) {

				$productos_[$index] = $producto['Producto'];
			}

			echo json_encode($productos_);
		}
	}
?>