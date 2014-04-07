<?php

	class RegionsController extends AppController {
		
		var $sacaffold;

		public function index() {
			$this->set('regiones', $this->Region->find('all'));
		}

		public function view($id) {
			$this->Region->id = $id;
			$this->set('region', $this->Region->read());
		}

		public function add() {
			if ($this->request->is('post')) {
				if ($this->Region->save($this->request->data)) {
					$this->Session->setFlash('La región ha sido guardada exitosamente.');
					$this->redirect(array('action' => 'index'));
				}
				$this->Session->setFlash('La región no fue guardada, intente nuevamente.');
				$this->redirect(array('action' => 'index'));
			}
		}

		function edit($id = null) {
			$this->Region->id = $id;
			if ($this->request->is('get')) {
				$this->request->data = $this->Region->read();
			} 
			elseif ($this->Region->save($this->request->data)) {
					$this->Session->setFlash('La región ha sido actualizada exitosamente.');
					$this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash('La región no fue actualizada, intente nuevamente.');
			$this->redirect(array('action' => 'index'));
			
		}

		public function delete($id) {
			if (!$this->request->is('post')) {
				throw new MethodNotAllowedException();
			}
			if ($this->Region->delete($id)) {
				$this->Session->setFlash('La región ha sido eliminada.');
				$this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash('La región no fue eliminada.');
        	$this->redirect(array('action' => 'index'));
		}
	}
?>