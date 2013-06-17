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
	}
?>