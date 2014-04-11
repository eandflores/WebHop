<?php
App::uses('Controller', 'Controller');

	//   debug($this->current_user,null,true);

	class AppController extends Controller {
		$this->autoRender = false;

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
			return true;
		}

		public function beforeFilter() {
			$this->set('logged_in',$this->Auth->loggedIn());
			$this->set('current_user',$this->Auth->user());
		}
}
?>