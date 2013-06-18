<?php
App::uses('Controller', 'Controller');

	class AppController extends Controller {

		public $components = array(
	        'Auth' => array(
	            'loginRedirect' => array('controller' => 'users', 'action' => 'index'),
	            'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
	            'authError' => "Tu no puedes acceder a la pagina",
	            'authorize' => array('Controller')
	        ),
	        'Session'
	    );

		public function isAuthorized($usuario){
			return true;
		}

		public function beforeFilter() {
			$this->Auth->allow('index','view');
			$this->set('logged_in',$this->Auth->loggedIn());
			$this->set('current_user',$this->Auth->user());
		}

		
}
?>