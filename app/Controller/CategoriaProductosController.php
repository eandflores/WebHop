<?php
	class CategoriaProductosController extends AppController {
		
		public $name = 'CategoriaProductos';

		public function index() {
			$this->set('categoriaproductos', $this->CategoriaProducto->find('all'));
		}

		public function view($id) {
			$this->CategoriaProducto->id = $id;
			$this->set('categoriaproducto', $this->CategoriaProducto->read());
		}

		public function add() {
			if ($this->request->is('post')) {
				$nombre = $this->request->data['nombre'];
				if(!$this->CategoriaProducto->existe($nombre)){
					if ($this->CategoriaProducto->save($this->request->data)) {
						$this->Session->setFlash('La categoria ha sido guardada exitosamente.','default', array("class" => "alert alert-success"));
						$this->redirect(array('action' => 'add'));
					} else {
						$this->Session->setFlash('La categoria no fue guardada, intente nuevamente.','default', array("class" => "alert alert-error"));
						$this->redirect(array('action' => 'add'));
					}
				} else{
					$this->Session->setFlash('La categoria ya existe.','default', array("class" => "alert alert-error"));
					$this->redirect(array('action' => 'add'));
				}
			}
		}

		function edit($id = null) {
			$this->CategoriaProducto->id = $id;
			if ($this->request->is('get')) {
				$this->request->data = $this->CategoriaProducto->read();
			} elseif ($this->CategoriaProducto->save($this->request->data)) {
				$this->Session->setFlash('La categoria ha sido actualizada exitosamente.');
				$this->redirect(array('action' => 'edit'));
			} else {
				$this->Session->setFlash('La categoria no fue actualizada, intente nuevamente.');
				$this->redirect(array('action' => 'edit'));
			}
		}

		function delete($id) {
			if (!$this->request->is('post')) {
				throw new MethodNotAllowedException();
			}
			if ($this->CategoriaProducto->delete($id)) {
				$this->Session->setFlash('La categoria ha sido eliminada');
				$this->redirect(array('action' => 'delete'));
			}
			$this->Session->setFlash('La categoria no fue eliminada.');
        	$this->redirect(array('action' => 'delete'));
		}
	}
?>