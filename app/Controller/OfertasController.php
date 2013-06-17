<?php
	class OfertasController extends AppController {
		
		public function index() {
			$this->set('ofertas', $this->Oferta->find('all'));
		}

		public function view($id) {
			$this->Oferta->id = $id;
			$this->set('oferta', $this->Oferta->read());
		}

		public function add() {
			if ($this->request->is('post')) {
				if ($this->Oferta->save($this->request->data)) {
					$this->Session->setFlash('La oferta ha sido guardada exitosamente.');
					$this->redirect(array('action' => 'index'));
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
			if (!$this->request->is('post')) {
				throw new MethodNotAllowedException();
			}
			if ($this->Oferta->delete($id)) {
				$this->Session->setFlash('La oferta no pudo ser eliminada');
				$this->redirect(array('action' => 'index'));
			}
		}
	}
?>