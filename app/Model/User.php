<?php
	class User extends AppModel {
		
		public $name = 'User';
	
		var $belongsTo = array('Rol','Comuna');

		public function beforeSave($options = array()){
			if(!empty($this->data['User']['id'])){
				$user_aux = $this->findByid($this->data['User']['id']);

				if($this->data['User']['password'] != $user_aux['User']['password']){
					$this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
				}
			} else{
				if(!empty($this->data['User']['password'])){
					$this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
				}
			}	

			return true;
		}

	}
?>