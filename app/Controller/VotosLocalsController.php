<?php
	class VotosLocalsController extends AppController {

		public $name = 'VotosLocals';

		var $uses = array('Local','User','VotosLocal');

		public function beforeFilter() {
			$this->Auth->allow('addAndroid');

			$this->current_user = $this->Auth->user();
			$this->logged_in = $this->Auth->loggedIn();
			$this->set('logged_in',$this->logged_in);
			$this->set('current_user',$this->current_user);
		}
		
		public function index() {
			
		}

		public function view($id) {
			$this->set('votolocal', $this->VotosLocals->read(null,$id));
		}

		public function add() {

			$local_id=$this->params->query['loc'];
			$nombre=$this->params->query['nomb'];
			$user_id = $this->current_user['id'];
			$this->request->data['local_id']=$this->params->query['loc'];
			$this->request->data['user_id']=$this->current_user['id'];
			$this->request->data['tipo']=$this->params->query['tipo'];

			$voto_positivo = $this->VotosLocal->find('count', array('conditions' => array('VotosLocal.user_id' => $user_id , 'VotosLocal.local_id' => $local_id , 'VotosLocal.tipo' => 'positivo')));
			$voto_negativo = $this->VotosLocal->find('count', array('conditions' => array('VotosLocal.user_id' => $user_id , 'VotosLocal.local_id' => $local_id , 'VotosLocal.tipo' => 'negativo')));
			$voto_user = $this->VotosLocal->find('first', array('conditions' => array('VotosLocal.user_id' => $user_id , 'VotosLocal.local_id' => $local_id)));

			if(($voto_positivo == 0) && ($voto_negativo == 0)){
				if ($this->VotosLocal->save($this->request->data)) {
				$this->redirect(array(
					'action' => '../Users/search',
					'?' => array(
		              'loc' => $local_id,
		              'nomb' => $nombre)));
				}
			}

			elseif (($voto_negativo == 0) && ($this->params->query['tipo'] == 'negativo')) {
				$this->VotosLocal->read(null,$voto_user['VotosLocal']['id']);
				$this->VotosLocal->set(array('tipo' => 'negativo'));
				if ($this->VotosLocal->save()) {
				$this->redirect(array(
					'action' => '../Users/search',
					'?' => array(
		              'loc' => $local_id,
		              'nomb' => $nombre)));
				}
			}


			elseif (($voto_positivo == 0) && ($this->params->query['tipo'] == 'positivo')) {
				$this->VotosLocal->read(null,$voto_user['VotosLocal']['id']);
				$this->VotosLocal->set(array('tipo' => 'positivo'));
				if ($this->VotosLocal->save()) {
				$this->redirect(array(
					'action' => '../Users/search',
					'?' => array(
		              'loc' => $local_id,
		              'nomb' => $nombre)));
				}
			}

			else {
				$this->Session->setFlash('Usted ya votó anteriormente en este local, si desea puede cambiar su voto.','default', array("class" => "alert alert-error"));
				$this->redirect(array(
					'action' => '../Users/search',
					'?' => array(
		              'loc' => $local_id,
		              'nomb' => $nombre)));
			}

		 }

		function edit($id = null) {
			$this->set('VotosLocals', $this->VotosLocals->read(null,$id));
			
			if($this->request->is('post')){

				$id = $this->request->data['id'];
				$texto = $this->request->data['texto'];

				$this->set('id', $id);
				$this->set('texto', $texto);
				
				$conditions = array("VotosLocals.texto" => $texto,"VotosLocals.id !=" => $id);

				if($this->VotosLocals->find('first', array('conditions' => $conditions))){
					$this->Session->setFlash('El VotosLocals ingresado ya existe.','default', array("class" => "alert alert-error"));
				} 
				else{
					if($this->VotosLocals->save($this->request->data)){
						$this->Session->setFlash('El VotosLocals ha sido actualizado exitosamente.','default', array("class" => "alert alert-success"));
						$this->redirect(array('action' => 'index'));
					} 
					else{
						$this->Session->setFlash('El VotosLocals ha sido actualizado, intente nuevamente.','default', array("class" => "alert alert-error"));
					}
				}
			}
		}

		function delete($id) {
			if ($this->request->is('post')) {
				throw new MethodNotAllowedException();
			}
			if ($this->VotosLocals->delete($id)) {
				$this->Session->setFlash('El VotosLocals ha sido eliminado.','default', array("class" => "alert alert-success"));
				$this->redirect(array('action' => 'index'));
			}
			else{
				$this->Session->setFlash('El VotosLocals no pudo ser elimonado, intente nuevamente.','default', array("class" => "alert alert-error"));
				$this->redirect(array('action' => 'index'));
			}	
		}

		//========================== ABDROID =======================//

		public function addAndroid() {

			$this->autoRender = false;

			$mensaje = "";

			if ($this->request->is('post')){

				$voto_positivo = $this->VotosLocal->find('count', array('conditions' => array('VotosLocal.user_id' => $user_id , 'VotosLocal.local_id' => $local_id , 'VotosLocal.tipo' => 'positivo')));
				$voto_negativo = $this->VotosLocal->find('count', array('conditions' => array('VotosLocal.user_id' => $user_id , 'VotosLocal.local_id' => $local_id , 'VotosLocal.tipo' => 'negativo')));
				$voto_user = $this->VotosLocal->find('first', array('conditions' => array('VotosLocal.user_id' => $user_id , 'VotosLocal.local_id' => $local_id)));

				if(($voto_positivo == 0) && ($voto_negativo == 0)){
					if ($this->VotosLocal->save($this->request->data)) 
						$mensaje = "EXITO";
					else
						$mensaje = "No se pudo guardar su voto, intente nuevamente."
				}

				elseif (($voto_negativo == 0) && ($this->params->query['tipo'] == 'negativo')) {
					$this->VotosLocal->read(null,$voto_user['VotosLocal']['id']);
					$this->VotosLocal->set(array('tipo' => 'negativo'));
					
					if ($this->VotosLocal->save()) 
						$mensaje = "EXITO";
					else
						$mensaje = "No se pudo actualizar su voto, intente nuevamente."
				}


				elseif (($voto_positivo == 0) && ($this->params->query['tipo'] == 'positivo')) {
					$this->VotosLocal->read(null,$voto_user['VotosLocal']['id']);
					$this->VotosLocal->set(array('tipo' => 'positivo'));
					
					if ($this->VotosLocal->save()) 
						$mensaje = "EXITO";
					else
						$mensaje = "No se pudo actualizar su voto, intente nuevamente."
				}

				else 
					$mensaje = "No se puede ingresar dos veces el mismo voto.";
				
			}

			echo json_encode($mensaje);

		 }

	}
?>