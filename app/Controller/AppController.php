<?php
App::uses('Controller', 'Controller');

	class AppController extends Controller {

		public $components = array(
	        'Auth' => array(
	            'loginRedirect' => array('controller' => 'Users', 'action' => 'index'),
	            'logoutRedirect' => array('controller' => 'Users', 'action' => 'index'),
	            'authError' => "Tu no puedes acceder a la pagina",
	            'authorize' => array('Controller')
	        ),
	        'Session'
	    );

		public function isAuthorized($usuario){
			if ($usuario['estado'] == 't'){
				return true;
			}

			else
				$this->Session->setFlash('Su cuenta a sido deshabilitada, contacte al administrador','default', array("class" => "alert alert-error"));
		}

		public function beforeFilter() {
			$this->set('logged_in',$this->Auth->loggedIn());
			$this->set('current_user',$this->Auth->user());
		}
}
?>