<?php
	class OfertasController extends AppController {

		public $name = 'Ofertas';

		var $uses = array('Oferta','Local','Producto','User','Solicitud');

		public function beforeFilter() {
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

		public function add() {
			$this->set('productos',$this->Producto->find('all',array(
				'order' => array('Producto.nombre')
			)));
			$this->set('locales',$this->Local->find('all',array(
				'order' => array('Local.nombre')
			)));


			if ($this->request->is('post')) {
				if(!$this->Oferta->findByprecio($this->request->data['precio'])){
					if($this->current_user['rol_id'] != 2){
						$current_user = $this->Auth->user();
						$usuario = $this->User->findByusername($current_user['username']); 
						$this->request->data['user_id'] = $usuario['User']['id'];

						if($this->current_user['rol_id'] == 3){
							$this->request->data['local_id'] = $current_user['local_id'];
						}

						if ($this->Oferta->save($this->request->data)) {
							$this->Session->setFlash('La oferta ha sido guardada exitosamente.');
							$this->redirect(array('action' => 'index'));
						}
						else 
							$this->Session->setFlash('Las ofertas no fuerón guardadas, intente nuevamente.','default', array("class" => "alert alert-error"));
					}
					

					elseif($this->current_user['rol_id']== 2){
						$producto = $this->Producto->read(null,$this->request->data['producto_id']);
						$local = $this->Local->read(null,$this->request->data['local_id']);

						$this->request->data['estado'] = "Pendiente";
						$this->request->data['sql'] = "INSERT INTO ofertas (\"precio\",\"user_id\",\"producto_id\",\"local_id\") VALUES ('".$this->request->data['precio']."','".$this->current_user['id']."','".$this->request->data['producto_id']."','".$this->request->data['local_id']."')";
						$this->request->data['accion'] = "Agregar";
						$this->request->data['tabla'] = "Ofertas";
						$this->request->data['campos'] = "Precio: ".$this->request->data['precio'].", Usuario: ".$this->current_user['username'].", Producto: ".$producto['Producto']['nombre'].", Local: ".$local['Local']['nombre'];
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
					$this->Session->setFlash('El precio no puede estar vacio, intente nuevamente.','default', array("class" => "alert alert-error"));	
			}
		}

		function edit($id = null) {
			$this->set('productos',$this->Producto->find('all',array(
				'order' => array('Producto.nombre')
			)));
			$this->set('locales',$this->Local->find('all',array(
				'order' => array('Local.nombre')
			)));

			$this->set('oferta', $this->Oferta->read(null,$id));

			if ($this->request->is('get')) {
				$this->request->data = $this->Oferta->read();
			} 
			elseif ($this->Oferta->save($this->request->data)) {
				$this->Session->setFlash('La oferta ha sido actualizada exitosamente.');
				$this->redirect(array('action' => 'index'));
			}
		}

		function delete($id) {
			if ($this->request->is('post')) {
				throw new MethodNotAllowedException();
			}
			if ($this->Oferta->delete($id)) {
				$this->Session->setFlash('La oferta ha sido eliminada.','default', array("class" => "alert alert-success"));
				$this->redirect(array('action' => 'index'));
			}
			else{
				$this->Session->setFlash('La oferta no pudo ser elimonada, intente nuevamente.','default', array("class" => "alert alert-error"));
				$this->redirect(array('action' => 'index'));
			}	
		}

		function locales(){
			$this->set('locales',$this->local->find('all',array(
				'order' => array('Local.nombre')
			)));
		}
	}
?>