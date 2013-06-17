<?php
	class ProductosController extends AppController {
		
		public function index() {
			$this->set('productos', $this->Producto->find('all'));
		}

		public function view($id) {
			$this->Producto->id = $id;
			$this->set('producto', $this->Producto->read());
		}

		public function add() {
			if ($this->request->is('post')) {
				if ($this->Producto->save($this->request->data)) {
					$this->Session->setFlash('El producto ha sido guardado exitosamente.');
					$this->redirect(array('action' => 'index'));
				}
			}
		}

		function edit($id = null) {
			$this->Producto->id = $id;
			if ($this->request->is('get')) {
				$this->request->data = $this->Producto->read();
			} 
			elseif ($this->Producto->save($this->request->data)) {
				$this->Session->setFlash('El producto ha sido actualizado exitosamente.');
				$this->redirect(array('action' => 'index'));
			}
		}

		function delete($id) {
			if (!$this->request->is('post')) {
				throw new MethodNotAllowedException();
			}
			if ($this->Producto->delete($id)) {
				$this->Session->setFlash('El producto no pudo ser eliminado');
				$this->redirect(array('action' => 'index'));
			}
		}
	}
?>