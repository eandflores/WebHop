<?php
	class OfertasController extends AppController {

		public $name = 'Ofertas';

		var $uses = array('Oferta','Local','Producto','User');

		public function index() {
			$this->set('ofertas', $this->Oferta->find('all',array(
				'order' => array('Oferta.precio')
			)));
		}

		public function add($local_id = null) {
			$conditions = array("Oferta.local_id" => $local_id);

			$ofertas = $this->Oferta->find('all',array(
				'conditions' => $conditions,
				'fields'	     => 'Oferta.producto_id'
			));

			if(count($ofertas) == 0){
				$this->set('productos',$this->Producto->find('all',array(
				'order' => array('Producto.nombre')
				)));
			}
			else{
				$_ofertas = array();

				foreach($ofertas as $index => $oferta){
					$_ofertas[$index] = $oferta['Oferta']['producto_id'];
				}


				$conditions2 = array('NOT' => array(
									'Producto.id' => $_ofertas
								)
				);

				$this->set('productos',$this->Producto->find('all',array(
					'order' => array('Producto.nombre'),
					'conditions' => $conditions2
				)));
			}
			

			$this->set('local',$this->Local->findByid($local_id));

			if ($this->request->is('post')) {

				$current_user = $this->Auth->user();
				$usuario = $this->User->findByusername($current_user['username']); 

				// Debugger::dump($this->request->data['productos']);
				// Debugger::dump($this->request->data['precios']);

				$productos = $this->request->data['productos'];
				$precios = $this->request->data['precios'];

				$resgitros = array();

				foreach($productos as $index => $producto){
					$registros[$index] = array(
					    'producto_id' => $producto,
					    'user_id' => $usuario['User']['id'],
					    'precio' => $precios[$index],
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
		}

		function edit($id = null) {
			$this->Oferta->id = $id;
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
			if($this->Oferta->delete($id)) {
				$this->Session->setFlash('La oferta ha sido eliminada','default', array("class" => "alert alert-success"));
				$this->redirect(array('action' => 'index'));
			}
			else {
				$this->Session->setFlash('La oferta no fue eliminada, intente nuevamente.','default', array("class" => "alert alert-success"));
	        	$this->redirect(array('action' => 'index'));
	        }
		}

		function locales(){
			$this->set('locales', $this->Local->find('all',array(
				'order' => array('Local.nombre')
			)));
		}
	}
?>