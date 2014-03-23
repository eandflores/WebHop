<?php
	class OfertasController extends AppController {

		public $name = 'Ofertas';

		var $uses = array('Oferta','Local','Producto','User');

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

				$current_user = $this->Auth->user();
				$usuario = $this->User->findByusername($current_user['username']); 
				$this->request->data['user_id'] = $usuario['User']['id'];

				if ($this->Oferta->save($this->request->data)) {
					$this->Session->setFlash('La oferta ha sido guardada exitosamente.');
					$this->redirect(array('action' => 'index'));
				}
				else 
					$this->Session->setFlash('Las ofertas no fuerón guardadas, intente nuevamente.','default', array("class" => "alert alert-error"));
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

	}
?>