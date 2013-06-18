<?php
	class User extends AppModel {
		
		public $name = 'User';
	
		var $belongsTo='Rol';

		public function beforeSave(){
			if(isset($this->data['User']['password'])){
				$this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
			}
			return true;
		}

		public function existe($tipo, $campo){
			if($tipo == 'rut'){
				if($this->find('first',array(
					'conditions' => array('User.rut' => $campo)
				)))
					return true;
			} elseif($tipo == 'username'){
				if($this->find('first',array(
					'conditions' => array('User.username' => $campo)
				)))
					return true;
			} elseif($tipo == 'email'){
				if($this->find('first',array(
					'conditions' => array('User.email' => $campo)
				)))
					return true;
			}
				
			return false;
		}
	}
?>