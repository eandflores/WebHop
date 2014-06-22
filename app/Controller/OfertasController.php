<?php
	class OfertasController extends AppController {

		public $name = 'Ofertas';

		var $uses = array('Oferta','Local','Producto','User','Solicitud');

		public function beforeFilter() {
			$this->Auth->allow('ofertas','view');

			$this->current_user = $this->Auth->user();
			$this->logged_in = $this->Auth->loggedIn();
			$this->set('logged_in',$this->logged_in);
			$this->set('current_user',$this->current_user);
		}

		public function index() {
			if( $this->current_user['rol_id'] == 1) { 
			$this->set('ofertas', $this->Oferta->find('all',array(
				'order' => array('Oferta.local_id')
			)));
			}
			elseif( $this->current_user['rol_id'] == 3) {
				$conditions = array("Local.admin_id" => $this->current_user['id']);
				$ofertas = $this->Oferta->find('all', array('conditions' => $conditions, 'order' => array('Local.nombre')));
				$this->set('ofertas', $ofertas);
			}
			else	
				$this->redirect(array('action' => 'index'));
		}

		public function view($local_id = null) { 
			if (!empty($this->params->query)){
				$producto_id = $this->params->query['prod'];
				$local_id = $this->params->query['loc'];

				$conditions = array("Oferta.producto_id" => $producto_id, "Oferta.local_id" => $local_id);
				$ofertas = $this->Oferta->find('all', array('conditions' => $conditions, 'order' => array('Oferta.local_id')));
				$this->set('ofertas', $ofertas);

				$this->set('local', $this->Local->read(null,$local_id));
				$local=$this->Local->read(null,$local_id);
				$visitas=$local['Local']['visitas']+1;
				$this->Local->set(array('visitas' => $visitas));
				$this->Local->save();
			}
			else{
				$this->set('ofertas', $this->Oferta->find('all',array(
				'order' => array('Oferta.local_id')
				)));

				$this->set('local', $this->Local->read(null,$local_id));
				$local=$this->Local->read(null,$local_id);
				$visitas=$local['Local']['visitas']+1;
				$this->Local->set(array('visitas' => $visitas));
				$this->Local->save();
			}
		}

		public function add($local_id = null) {
			$conditions = array("Oferta.local_id" => $local_id);

			$ofertas = $this->Oferta->find('all',array(
				'conditions' => $conditions,
				'fields'	     => 'Oferta.producto_id'
			));

			$this->set('productos',$this->Producto->find('all',array(
				'order' => array('Producto.nombre')
			)));

			$ofertas = $this->Oferta->find('all', array('conditions' => array("Oferta.local_id" => $local_id)));
			$this->set('ofertas',$ofertas, array('order' => array('Oferta.producto_id')
				));
				
			$this->set('local',$this->Local->findByid($local_id));

			if ($this->request->is('post')) {

				if($this->current_user['rol_id'] != 2){
					$current_user = $this->Auth->user();
					$usuario = $this->User->findByusername($current_user['username']); 
					$productos = $this->request->data['productos'];
					$precios = $this->request->data['precios'];
					$marcas = $this->request->data['marcas'];
					$descripciones = $this->request->data['descripciones'];

					$resgitros = array();

					foreach($productos as $index => $producto){
						$registros[$index] = array(
						    'producto_id' => $producto,
						    'user_id' => $usuario['User']['id'],
						    'precio' => $precios[$index],
						    'marca' => $marcas[$index],
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
					    $marca = $marcas[$index];
					    $precio = $precios[$index];
					    $descripcion = $descripciones[$index];
					    $local_id = $this->request->data['local'];

						$producto = $this->Producto->read(null,$producto_id);
						$local = $this->Local->read(null,$local_id);
						$registros[$index] = array(
							
							'local_id' => $local_id,
							'estado' => "Pendiente",
							'sql' => "INSERT INTO ofertas (\"precio\",\"marca\",\"user_id\",\"producto_id\",\"local_id\",\"descripcion\",\"created\",\"modified\") VALUES ('".$precio."','".$marca."','".$this->current_user['id']."','".$producto_id."','".$local_id."','".$descripcion."','".date("d-m-Y H:i:s")."','".date("d-m-Y H:i:s")."')",
							'accion' => "Agregar",
							'tabla' => "Ofertas",
							'campos' => "Producto: ".$producto['Producto']['nombre'].", Precio: ".$precio.", Marca: ".$marca.", Local: ".$local['Local']['nombre'].", Descripcion: ".$descripcion. ", Usuario: ".$this->current_user['username'],
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
			if( $this->current_user['rol_id'] == 3) {
				$conditions = array("Local.admin_id" => $this->current_user['id']);
				$locales = $this->Local->find('all', array('conditions' => $conditions, 'order' => array('Local.nombre')));
				$this->set('locales', $locales);
			}
			else{ 
				$conditions = array("Local.admin_id" => null);
				$locales = $this->Local->find('all', array('conditions' => $conditions, 'order' => array('Local.nombre')));
				$this->set('locales', $locales);
			}

		}

		public function informe() {
			$fecha_inicio = $this->request->data['fechaIni7'];
			$fecha_fin = $this->request->data['fechaFin7'];
			$local = $this->request->data['local'];
			$producto = $this->request->data['producto'];
			$marca = $this->request->data['marca'];

			$this->set('fecha_inicio', $fecha_inicio);
			$this->set('fecha_fin', $fecha_fin);
			$this->set('local', $local);
			$this->set('producto', $producto);
			$this->set('marca', $marca);

			$ofertas = array();

			if($local != "Todos" && $producto != "Todos" && $marca != "Todas"){

				$this->set('loc',$this->Local->read(null,$local));
				$this->set('product',$this->Producto->read(null,$producto));

				$ofertas = $this->Oferta->find('all',array(
	 						'order' => array('Oferta.visitas' => 'desc'),
	 						'conditions' => array(
	 											'Oferta.created >=' => $fecha_inicio.' 00:00:00',
	 											'Oferta.created <=' => $fecha_fin.' 23:59:59',
	 											"Oferta.local_id" => $local,
	 											"Oferta.producto_id" => $producto,
	 											"Oferta.marca" => $marca
	 										)
	 					));
			} 
			else if($local != "Todos" && $producto != "Todos"){

				$this->set('loc',$this->Local->read(null,$local));
				$this->set('product',$this->Producto->read(null,$producto));

				$ofertas = $this->Oferta->find('all',array(
	 						'order' => array('Oferta.visitas' => 'desc'),
	 						'conditions' => array(
	 											'Oferta.created >=' => $fecha_inicio.' 00:00:00',
	 											'Oferta.created <=' => $fecha_fin.' 23:59:59',
	 											"Oferta.local_id" => $local,
 												"Oferta.producto_id" => $producto
	 										)
	 					));
			}
			else if($local != "Todos" && $marca != "Todas"){

				$this->set('loc',$this->Local->read(null,$local));

				$ofertas = $this->Oferta->find('all',array(
	 						'order' => array('Oferta.visitas' => 'desc'),
	 						'conditions' => array(
	 											'Oferta.created >=' => $fecha_inicio.' 00:00:00',
	 											'Oferta.created <=' => $fecha_fin.' 23:59:59',
	 											"Oferta.local_id" => $local,
 												"Oferta.marca" => $marca
	 										)
	 					));
			}
			else if($producto != "Todos" && $marca != "Todas"){

				$this->set('product',$this->Producto->read(null,$producto));

				$ofertas = $this->Oferta->find('all',array(
	 						'order' => array('Oferta.visitas' => 'desc'),
	 						'conditions' => array(
	 											'Oferta.created >=' => $fecha_inicio.' 00:00:00',
	 											'Oferta.created <=' => $fecha_fin.' 23:59:59',
	 											"Oferta.producto_id" => $producto,
 												"Oferta.marca" => $marca
	 										)
	 					));
			}
			else if($local != "Todos"){

				$this->set('loc',$this->Local->read(null,$local));

				$ofertas = $this->Oferta->find('all',array(
	 						'order' => array('Oferta.visitas' => 'desc'),
	 						'conditions' => array(
	 											'Oferta.created >=' => $fecha_inicio.' 00:00:00',
	 											'Oferta.created <=' => $fecha_fin.' 23:59:59',
	 											"Oferta.local_id" => $local
	 										)
	 					));
			}
			else if($producto != "Todos"){

				$this->set('product',$this->Producto->read(null,$producto));

				$ofertas = $this->Oferta->find('all',array(
	 						'order' => array('Oferta.visitas' => 'desc'),
	 						'conditions' => array(
	 											'Oferta.created >=' => $fecha_inicio.' 00:00:00',
	 											'Oferta.created <=' => $fecha_fin.' 23:59:59',
	 											"Oferta.producto_id" => $producto
	 										)
	 					));
			}
			else if($marca != "Todas"){ 

				$ofertas = $this->Oferta->find('all',array(
	 						'order' => array('Oferta.visitas' => 'desc'),
	 						'conditions' => array(
	 											'Oferta.created >=' => $fecha_inicio.' 00:00:00',
	 											'Oferta.created <=' => $fecha_fin.' 23:59:59',
 												"Oferta.marca" => $marca
	 										)
	 					));
			}
			else{ 

				$ofertas = $this->Oferta->find('all',array(
	 						'order' => array('Oferta.visitas' => 'desc'),
	 						'conditions' => array(
	 											'Oferta.created >=' => $fecha_inicio.' 00:00:00',
	 											'Oferta.created <=' => $fecha_fin.' 23:59:59'
	 										)
	 					));
			}
			
			$this->set('ofertas', $ofertas);
		}

		public function informe_local() {
			$fecha_inicio = $this->request->data['fechaIni2'];
			$fecha_fin = $this->request->data['fechaFin2'];
			$producto = $this->request->data['producto'];
			$marca = $this->request->data['marca'];

			$this->set('fecha_inicio', $fecha_inicio);
			$this->set('fecha_fin', $fecha_fin);
			$this->set('producto', $producto);
			$this->set('marca', $marca);

			$ofertas = array();
			$localesId = array();

			$conditionsl = array("Local.admin_id" => $this->current_user['id']);
			$locales = $this->Local->find('all',array('conditions' => $conditionsl, 'order' => array('Local.nombre')));

			foreach ($locales as $index => $local) {
				array_push($localesId,$local['Local']['id']);
			}

			if($producto != "Todos" && $marca != "Todas"){

				$this->set('product',$this->Producto->read(null,$producto));

				$ofertas = $this->Oferta->find('all',array(
	 						'order' => 'Oferta.created',
	 						'conditions' => array(
	 											'Oferta.created >=' => $fecha_inicio.' 00:00:00',
	 											'Oferta.created <=' => $fecha_fin.' 23:59:59',
	 											"Oferta.local_id" => $localesId,
	 											"Oferta.producto_id" => $producto,
	 											"Oferta.marca" => $marca
	 										)
	 					));
			} 
			else if($producto != "Todos"){

				$this->set('product',$this->Producto->read(null,$producto));

				$ofertas = $this->Oferta->find('all',array(
	 						'order' => 'Oferta.created',
	 						'conditions' => array(
	 											'Oferta.created >=' => $fecha_inicio.' 00:00:00',
	 											'Oferta.created <=' => $fecha_fin.' 23:59:59',
	 											"Oferta.local_id" => $localesId,
	 											"Oferta.producto_id" => $producto
	 										)
	 					));
			}
			else if($marca != "Todas"){

				$ofertas = $this->Oferta->find('all',array(
	 						'order' => 'Oferta.created',
	 						'conditions' => array(
	 											'Oferta.created >=' => $fecha_inicio.' 00:00:00',
	 											'Oferta.created <=' => $fecha_fin.' 23:59:59',
	 											"Oferta.local_id" => $localesId,
	 											"Oferta.marca" => $marca
	 										)
	 					));
			}
			else{

				$ofertas = $this->Oferta->find('all',array(
	 						'order' => 'Oferta.created',
	 						'conditions' => array(
	 											'Oferta.created >=' => $fecha_inicio.' 00:00:00',
	 											'Oferta.created <=' => $fecha_fin.' 23:59:59',
	 											"Oferta.local_id" => $localesId
	 										)
	 					));
			}
			
			$this->set('ofertas', $ofertas);
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