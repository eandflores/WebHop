<?php
	class ComentariosController extends AppController {

		public $name = 'Comentarios';
		
		var $uses = array('Local','User','Comentario');

		public function beforeFilter() {
			$this->current_user = $this->Auth->user();
			$this->logged_in = $this->Auth->loggedIn();
			$this->set('logged_in',$this->logged_in);
			$this->set('current_user',$this->current_user);
		}
		
		public function index() {
			$this->set('comentarios', $this->Comentario->find('all'));
		}

		public function local($id) {
			$conditions = array("Comentario.local_id" => $id);
			$comentarios = $this->Comentario->find('all', array('conditions' => $conditions, 'order' => array('Comentario.created')));
			$this->set('comentarios', $comentarios);
		}

		public function view($id) {
			$this->set('comentario', $this->Comentario->read(null,$id));
		}

		public function add() {
			$comentarios_all= $this->Comentario->find('all',array(
				'order' => array('Comentario.created' => 'desc')
			));
			$this->set('comentarios', $comentarios_all);
			
			if ($this->request->is('post')) {
				if ($this->request->data['texto']!=null) {
					$local_id=$this->request->data['local_id'];
					$nombre=$this->request->data['nombre'];
					if ($this->Comentario->save($this->request->data)) {
						$this->redirect(array(
							'action' => '../Users/search',
							'?' => array(
				              'loc' => $local_id,
				              'nomb' => $nombre)));
					}
				}
				else
					$this->Session->setFlash('Ingrese el comentario... ','default', array("class" => "alert alert-error"));
			}
		}

		function edit($id = null) {
			$this->set('comentario', $this->Comentario->read(null,$id));
			
			if($this->request->is('post')){

				$id = $this->request->data['id'];
				$texto = $this->request->data['texto'];

				$this->set('id', $id);
				$this->set('texto', $texto);
				
				$conditions = array("Comentario.texto" => $texto,"Comentario.id !=" => $id);

				if($this->Comentario->find('first', array('conditions' => $conditions))){
					$this->Session->setFlash('El comentario ingresado ya existe.','default', array("class" => "alert alert-error"));
				} 
				else{
					if($this->Comentario->save($this->request->data)){
						$this->Session->setFlash('El comentario ha sido actualizado exitosamente.','default', array("class" => "alert alert-success"));
						$this->redirect(array('action' => 'index'));
					} 
					else{
						$this->Session->setFlash('El comentario ha sido actualizado, intente nuevamente.','default', array("class" => "alert alert-error"));
					}
				}
			}
		}

		function delete() {
			if ($this->request->is('post')) {
				throw new MethodNotAllowedException();
			}
				$local_id=$this->params->query['loc'];
				$nombre=$this->params->query['nomb'];
				$id=$this->params->query['id'];
			if ($this->Comentario->delete($id)) {
				$this->Session->setFlash('El comentario ha sido eliminado.','default', array("class" => "alert alert-success"));
				$this->redirect(array(
							'action' => '../Users/search',
							'?' => array(
				              'loc' => $local_id,
				              'nomb' => $nombre)));
			}
			else{
				$this->Session->setFlash('El comentario no pudo ser elimonado, intente nuevamente.','default', array("class" => "alert alert-error"));
				$this->redirect(array(
							'action' => '../Users/search',
							'?' => array(
				              'loc' => $local_id,
				              'nomb' => $nombre)));
			}	
		}

	}
?>