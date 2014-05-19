<?php
	class OfertasController extends AppController {

		public $name = 'Ofertas';

		var $uses = array('Oferta','Local','Producto','User','Solicitud');

		public function beforeFilter() {
			$this->Auth->allow('ofertas');

			$this->current_user = $this->Auth->user();
			$this->logged_in = $this->Auth->loggedIn();
			$this->set('logged_in',$this->logged_in);
			$this->set('current_user',$this->current_user);
		}

		public function index() {
			$this->set('ofertas', $this->Oferta->find('all',array(
				'order' => array('Oferta.precio')
			)));
		}

		public function view($local_id = null) {
			$this->set('ofertas', $this->Oferta->find('all',array(
				'order' => array('Oferta.precio')
			)));

			$this->set('local', $this->Local->read(null,$local_id));
		}

		public function add($local_id = null) {
			$conditions = array("Oferta.local_id" => $local_id);

			$ofertas = $this->Oferta->find('all',array(
				'conditions' => $conditions,
				'fields'	     => 'Oferta.producto_id'
			));

			//if(count($ofertas) == 0){
				$this->set('productos',$this->Producto->find('all',array(
				'order' => array('Producto.nombre')
				)));
				
			$this->set('local',$this->Local->findByid($local_id));

			if ($this->request->is('post')) {

				if($this->current_user['rol_id'] != 2){
					$current_user = $this->Auth->user();
					$usuario = $this->User->findByusername($current_user['username']); 
					$productos = $this->request->data['productos'];
					$precios = $this->request->data['precios'];
					$descripciones = $this->request->data['descripciones'];

					$resgitros = array();

					foreach($productos as $index => $producto){
						$registros[$index] = array(
						    'producto_id' => $producto,
						    'user_id' => $usuario['User']['id'],
						    'precio' => $precios[$index],
						    'descripcion' => $descripciones[$index],
						    'local_id' => $this->request->data['local']
						);
					}

					if ($this->Oferta->saveAll($registros)) {
						$this->Session->setFlash('Los productos han sido asociados exitosamente.','default', array("class" => "alert alert-success"));
						$this->redirect(array('action' => 'index'));
					}
					else{
						$this->Session->setFlash('Las productos no fuerón asociados , intente nuevamente.','default', array("class" => "alert alert-error"));
					}
				}

				elseif($this->current_user['rol_id']== 2){
					$current_user = $this->Auth->user();
					$usuario = $this->User->findByusername($current_user['username']); 
					$productos = $this->request->data['productos'];
					$precios = $this->request->data['precios'];
					$descripciones = $this->request->data['descripciones'];

					$resgitros = array();

					foreach($productos as $index => $producto){
					    $producto_id = $producto;
					    $user_id = $usuario['User']['id'];
					    $precio = $precios[$index];
					    $descripcion = $descripciones[$index];
					    $local_id = $this->request->data['local'];

						$producto = $this->Producto->read(null,$producto_id);
						$local = $this->Local->read(null,$local_id);
						$registros[$index] = array(
							
							'local_id' => $local_id,
							'estado' => "Pendiente",
							'sql' => "INSERT INTO ofertas (\"precio\",\"user_id\",\"producto_id\",\"local_id\",\"descripcion\",\"created\",\"modified\") VALUES ('".$precio."','".$this->current_user['id']."','".$producto_id."','".$local_id."','".$descripcion."','".date("d-m-Y H:i:s")."','".date("d-m-Y H:i:s")."')",
							'accion' => "Agregar",
							'tabla' => "Ofertas",
							'campos' => "Producto: ".$producto['Producto']['nombre'].", Precio: ".$precio.", Local: ".$local['Local']['nombre'].", Descripcion: ".$descripcion. ", Usuario: ".$this->current_user['username'],
							'user_id' => $this->current_user['id'],		
						);
					}
						if ($this->Solicitud->saveAll($registros)) {
							$this->Session->setFlash('Su solicitud fue enviada exitosamente.','default', array("class" => "alert alert-success"));
							$this->redirect(array('action' => 'index'));
						}
						else 
							$this->Session->setFlash('Su solicitud no fue enviada, intente nuevamente.','default', array("class" => "alert alert-error"));
					}
						
				}

			}

		public function edit($id = null) {
			$this->set('productos',$this->Producto->find('all',array(
				'order' => array('Producto.nombre')
			)));
			$this->set('locales',$this->Local->find('all',array(
				'order' => array('Local.nombre')
			)));

			$this->set('oferta', $this->Oferta->read(null,$id));

			if ($this->request->is('post')) {
				$id = $this->Oferta->data['Oferta']['id'];
				$precio = $this->request->data['precio'];
				$descripcion = $this->request->data['descripcion'];
				$producto_id = $this->Oferta->data['Oferta']['producto_id'];
				$local_id = $this->Oferta->data['Oferta']['local_id'];
				$user_id = $this->current_user['id'];
				if($this->current_user['rol_id'] == 1){				
					$this->set('id', $id);
					$this->set('precio', $precio);
					$this->set('descripcion', $descripcion);
					$this->set('producto_id', $producto_id);
					$this->set('local_id', $local_id);
					$this->request->data['user_id'] = $this->current_user['id'];
					$this->request->data['modified'] = date("d-m-Y H:i:s");
				
					if ($this->Oferta->save($this->request->data)) {
						$this->Session->setFlash('La oferta ha sido actualizada exitosamente.', 'default', array("class" => "alert alert-success"));
						$this->redirect(array('action' => 'index'));
					}
					else{
							$this->Session->setFlash('La oferta no ha sido actualizada, intente nuevamente.','default', array("class" => "alert alert-error"));
						}
				}
				elseif($this->current_user['rol_id']== 2){
					$producto = $this->Producto->read(null,$producto_id);
					$local = $this->Local->read(null,$local_id);

					$this->request->data['local_id'] = $local_id;
					$this->request->data['estado'] = "Pendiente";
					$this->request->data['sql'] = " UPDATE ofertas Set precio=$precio, user_id=$user_id, producto_id=$producto_id, local_id=$local_id, descripcion='$descripcion' WHERE id=$id ";
					$this->request->data['accion'] = "Editar";
					$this->request->data['tabla'] = "Ofertas";
					$this->request->data['campos'] = "Producto: ".$producto['Producto']['nombre'].", Precio: ".$this->Oferta->data['Oferta']['precio']." => ".$this->request->data['precio'].", Descripción: ".$this->Oferta->data['Oferta']['descripcion']." => ".$this->request->data['descripcion'].", Local: ".$local['Local']['nombre'].", Usuario: ".$this->current_user['username'];
					$this->request->data['user_id'] = $this->current_user['id'];

					if ($this->Solicitud->save($this->request->data)) {
						$this->Session->setFlash('Su solicitud fue enviada exitosamente.','default', array("class" => "alert alert-success"));
						$this->redirect(array('action' => 'index'));
					} 
					else 
						$this->Session->setFlash('Su solicitud no fue enviada, intente nuevamente.','default', array("class" => "alert alert-error"));
				}

			}
		}

		public function delete($id) {
			if ($this->request->is('post')) {
				throw new MethodNotAllowedException();
			}
			if($this->current_user['rol_id'] != 2){
				if($this->Oferta->delete($id)) {
					$this->Session->setFlash('La oferta ha sido eliminada','default', array("class" => "alert alert-success"));
					$this->redirect(array('action' => 'index'));
				}
				else {
					$this->Session->setFlash('La oferta no fue eliminada, intente nuevamente.','default', array("class" => "alert alert-success"));
		        	$this->redirect(array('action' => 'index'));
		        }
		    }
		    elseif($this->current_user['rol_id']== 2){
		    	$this->set('productos',$this->Producto->find('all',array(
				'order' => array('Producto.nombre')
				)));
				$this->set('locales',$this->Local->find('all',array(
					'order' => array('Local.nombre')
				)));

				$this->set('oferta', $this->Oferta->read(null,$id));

				$producto_id = $this->Oferta->data['Oferta']['producto_id'];
				$local_id = $this->Oferta->data['Oferta']['local_id'];
				$producto = $this->Producto->read(null,$producto_id);
				$local = $this->Local->read(null,$local_id);
				$user_id = $this->current_user['id'];

				$this->request->data['local_id'] = $local_id;
				$this->request->data['estado'] = "Pendiente";
				$this->request->data['sql'] = " DELETE FROM ofertas WHERE id=$id ";
				$this->request->data['accion'] = "Eliminar";
				$this->request->data['tabla'] = "Ofertas";
				$this->request->data['campos'] = "Producto: ".$producto['Producto']['nombre'].", Precio: ".$this->Oferta->data['Oferta']['precio'].", Descripción: ".$this->Oferta->data['Oferta']['descripcion'].", Local: ".$local['Local']['nombre'].", Usuario: ".$this->current_user['username'];
				$this->request->data['user_id'] = $this->current_user['id'];
				
				if ($this->Solicitud->save($this->request->data)) {
					$this->Session->setFlash('Su solicitud fue enviada exitosamente.','default', array("class" => "alert alert-success"));
					$this->redirect(array('action' => 'index'));
				} 
				else 
					$this->Session->setFlash('Su solicitud no fue enviada, intente nuevamente.','default', array("class" => "alert alert-error"));
			}
		}

		public function locales(){
			$this->set('locales', $this->Local->find('all',array(
				'order' => array('Local.nombre')
			)));
		}

		//========================================== ANDROID ===========================================//
		
		public function ofertas(){
			$this->autoRender = false;

			$ofertas = $this->Oferta->find('all', 
				array('conditions' => array('Oferta.local_id' => $this->request->data['local_id']))
			);

			$ofertas_ = array();

			foreach ($ofertas as $index => $oferta) {

				$ofertas_[$index] = $oferta['Oferta'];
				
				$producto = $this->Producto->find('first', 
					array('conditions' => array('Producto.id' => $oferta['Oferta']['producto_id']))
				);

				$ofertas_[$index]['producto_nombre'] = $producto['Producto']['nombre'];
			}

			echo json_encode($ofertas_);
		}

	}
?>