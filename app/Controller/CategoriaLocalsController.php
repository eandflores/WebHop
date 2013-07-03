<?php
	class CategoriaLocalsController extends AppController {

		public $name = 'CategoriaLocals';

		var $uses = array('CategoriaLocal','Local');

		public function index() {
			$this->set('categorialocales', $this->CategoriaLocal->find('all',array(
				'order' => array('CategoriaLocal.nombre')
			)));
		}

		public function add() {
			if ($this->request->is('post')) {
				if(!$this->CategoriaLocal->findBynombre($this->request->data['nombre'])){
					if ($this->CategoriaLocal->save($this->request->data)) {
						$this->Session->setFlash('La categoria ha sido guardada exitosamente.','default', array("class" => "alert alert-success"));
						$this->redirect(array('action' => 'index'));
					} else 
						$this->Session->setFlash('La categoria no fue guardada, intente nuevamente.','default', array("class" => "alert alert-error"));
				} else
					$this->Session->setFlash('La categoria ya existe.','default', array("class" => "alert alert-error"));
			}
		}

		function edit($id = null) {
			$this->set('categoria', $this->CategoriaLocal->read(null,$id));

			if (!$this->request->is('get')) {
				if(!$this->CategoriaLocal->findBynombre($this->request->data['nombre'])){
					if ($this->CategoriaLocal->save($this->request->data)) {
						$this->Session->setFlash('La categoria ha sido actualizada exitosamente.','default', array("class" => "alert alert-success"));
						$this->redirect(array('action' => 'index'));
					} else 
						$this->Session->setFlash('La categoria no fue actualizada, intente nuevamente.','default', array("class" => "alert alert-error"));
				} else
					$this->Session->setFlash('La categoria ya existe.','default', array("class" => "alert alert-error"));
			} 
		}

		function delete($id) {
			if ($this->request->is('post')) {
				throw new MethodNotAllowedException();
			}
			if(!$this->Local->findBycategoria_local_id($id)){
				if ($this->CategoriaLocal->delete($id)) {
					$this->Session->setFlash('La categoria ha sido eliminada','default', array("class" => "alert alert-success"));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash('La categoria no fue eliminada.','default', array("class" => "alert alert-error"));
		        	$this->redirect(array('action' => 'index'));
		        }
		    } else{
				$this->Session->setFlash('La categoria no fue eliminada porque esta asociada a algun local.','default', array("class" => "alert alert-error"));
				$this->redirect(array('action' => 'index'));
			}	
		}
	}
?>