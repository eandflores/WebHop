<?php
	class CategoriaProductosController extends AppController {
		
		public function index() {
			$this->set('categoriaproductos', $this->CategoriaProducto->find('all'));
		}

		public function view($id) {
			$this->CategoriaProducto->id = $id;
			$this->set('categoriaproducto', $this->CategoriaProducto->read());
		}

		public function add() {
			if ($this->request->is('post')) {
				if ($this->CategoriaProducto->save($this->request->data)) {
					$this->Session->setFlash('La categoria ha sido guardada exitosamente.');
					$this->redirect(array('action' => 'index'));
				}
			}
		}

		function edit($id = null) {
			$this->CategoriaProducto->id = $id;
			if ($this->request->is('get')) {
				$this->request->data = $this->CategoriaProducto->read();
			} 
			elseif ($this->CategoriaProducto->save($this->request->data)) {
				$this->Session->setFlash('La categoria ha sido actualizada exitosamente.');
				$this->redirect(array('action' => 'index'));
			}
		}

		function delete($id) {
			if (!$this->request->is('post')) {
				throw new MethodNotAllowedException();
			}
			if ($this->CategoriaProducto->delete($id)) {
				$this->Session->setFlash('La categoria no pudo ser eliminada');
				$this->redirect(array('action' => 'index'));
			}
		}
	}
?>