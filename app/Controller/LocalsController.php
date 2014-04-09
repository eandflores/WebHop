<?php
	class LocalsController extends AppController {

		public $name = 'Locals';

		var $uses = array('Local','CategoriaLocal','Region','Comuna','User','Solicitud');

		public function beforeFilter() {
			$this->current_user = $this->Auth->user();
			$this->logged_in = $this->Auth->loggedIn();
			$this->set('logged_in',$this->logged_in);
			$this->set('current_user',$this->current_user);
		}

		public function index() {
			$this->set('locales', $this->Local->find('all',array(
				'order' => array('Local.nombre')
			)));
		}

		public function view($id) {
			$this->set('local', $this->Local->read(null,$id));
		}

		public function add() {
			$this->set('categorias',$this->CategoriaLocal->find('all',array(
				'order' => array('CategoriaLocal.nombre')
			)));
			$this->set('regiones',$this->Region->find('all',array(
				'order' => array('Region.nombre')
			)));
			$this->set('comunas',$this->Comuna->find('all',array(
				'order' => array('Comuna.nombre')
			)));

			if ($this->request->is('post')) {

				$this->set('nombre', $this->request->data['nombre']);
				$this->set('calle', $this->request->data['calle']);
				$this->set('numero', $this->request->data['numero']);
				$this->set('telefono_fijo', $this->request->data['telefono_fijo']);
				$this->set('telefono_movil', $this->request->data['telefono_movil']);
				$this->set('email', $this->request->data['email']);
				$this->set('sitio_web', $this->request->data['sitio_web']);

				$this->set('_categoria', $this->request->data['categoria_local_id']);
				$this->set('_comuna', $this->request->data['comuna_id']);

				if(!$this->Local->findBynombre($this->request->data['nombre'])){
					if($this->current_user['rol_id'] == 1){
						$current_user = $this->Auth->user();
						$usuario = $this->User->findByusername($current_user['username']); 
						$this->request->data['user_id'] = $usuario['User']['id'];
						$this->request->data['region_id'] = 8;

						if ($this->Local->save($this->request->data)) {
							$this->Session->setFlash('El local ha sido guardado exitosamente.','default', array("class" => "alert alert-success"));
							$this->redirect(array('action' => 'index'));
						} 
						else 
							$this->Session->setFlash('El local no fue guardado, intente nuevamente.','default', array("class" => "alert alert-error"));
					} 

					elseif($this->current_user['rol_id'] != 1){
						$categorial = $this->CategoriaLocal->read(null,$this->request->data['categoria_local_id']);
						$comuna = $this->Comuna->read(null,$this->request->data['comuna_id']);
						$this->request->data['region_id'] = 8;
						$this->request->data['estado'] = "Pendiente";
						$this->request->data['sql'] = "INSERT INTO locals (\"nombre\",\"region_id\",\"comuna_id\",\"calle\",\"numero\",\"telefono_fijo\",\"telefono_movil\",\"email\",\"sitio_web\",\"estado\",\"categoria_local_id\",\"user_id\") VALUES ('".$this->request->data['nombre']."','".$this->request->data['region_id']."','".$this->request->data['comuna_id']."','".$this->request->data['calle']."','".$this->request->data['numero']."','".$this->request->data['telefono_fijo']."','".$this->request->data['telefono_movil']."','".$this->request->data['email']."','".$this->request->data['sitio_web']."','".$this->request->data['estado']."','".$this->request->data['categoria_local_id']."','".$this->current_user['id']."')";
						$this->request->data['accion'] = "Agregar";
						$this->request->data['tabla'] = "Locales";
						$this->request->data['campos'] = "Nombre: ".$this->request->data['nombre'].", CategoriaLocal: ".$categorial['CategoriaLocal']['nombre'].", Comuna: ".$comuna['Comuna']['nombre'].", Calle: ".$this->request->data['calle'].", Numero: ".$this->request->data['numero'].", TelefonoFijo: ".$this->request->data['telefono_fijo'].", TelefonoMovil: ".$this->request->data['telefono_movil'].", Email: ".$this->request->data['email'].", SitioWeb: ".$this->request->data['sitio_web'].", Usuario: ".$this->current_user['username'];
						$this->request->data['user_id'] = $this->current_user['id'];
						debug($this->request->data,null,true);

						if ($this->Solicitud->save($this->request->data)) {
							$this->Session->setFlash('Su solicitud fue enviada exitosamente.','default', array("class" => "alert alert-success"));
							$this->redirect(array('action' => 'index'));
						} 
						else 
							$this->Session->setFlash('Su solicitud no fue enviada, intente nuevamente.','default', array("class" => "alert alert-error"));
					}
				}
				else
					$this->Session->setFlash('El nombre del local ya existe.','default', array("class" => "alert alert-error"));
			}
		}

		function edit($id = null) {
			$this->set('local', $this->Local->read(null,$id));

			$this->set('categorias',$this->CategoriaLocal->find('all',array(
				'order' => array('CategoriaLocal.nombre')
			)));
				$this->set('regiones',$this->Region->find('all',array(
				'order' => array('Region.nombre')
			)));
				$this->set('comunas',$this->Comuna->find('all',array(
				'order' => array('Comuna.nombre')
			)));

			if (!$this->request->is('get')) {
				if (!$this->Local->findBynombre($this->request->data['nombre'])){
					if($this->Local->save($this->request->data)) {
						$this->Session->setFlash('El local ha sido actualizado exitosamente.', 'default', array("class" => "alert alert-success"));
						$this->redirect(array('action' => 'index'));
					} 
					else 
						$this->Session->setFlash('El local no fue actualizado, intente nuevamente.','default', array("class" => "alert alert-error"));
					}
				else
					$this->Session->setFlash('El nombre del local ya existe.','default', array("class" => "alert alert-error"));
			} 
		}

		function disable($id) {
			if ($this->request->is('post')) {
				throw new MethodNotAllowedException();
			} 
			else {
				$this->Local->read(null,$id);
				$this->Local->set(array('estado' => false));

				if ($this->Local->save()) {
					$this->Session->setFlash('El local ha sido deshabilitado','default', array("class" => "alert alert-success"));
					$this->redirect(array('action' => 'index'));
				} 
				else {
					$this->Session->setFlash('El local no fue deshabilitado.','default', array("class" => "alert alert-error"));
	        		$this->redirect(array('action' => 'index'));
				}
			}
			
		}

		function enable($id) {
			if ($this->request->is('post')) {
				throw new MethodNotAllowedException();
			} 
			else {
				$this->Local->read(null,$id);
				$this->Local->set(array('estado' => true));

				if ($this->Local->save()) {
					$this->Session->setFlash('El local ha sido habilitado','default', array("class" => "alert alert-success"));
					$this->redirect(array('action' => 'index'));
				} 
				else {
					$this->Session->setFlash('El local no fue habilitado.','default', array("class" => "alert alert-error"));
	        		$this->redirect(array('action' => 'index'));
				}
			}
		}
	}
?>