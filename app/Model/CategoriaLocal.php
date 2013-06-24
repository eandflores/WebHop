<?php
	class CategoriaLocal extends AppModel {

		public $name = 'CategoriaLocal';

		var $hasMany='Local';

		public function existe($nombre){
			if($this->find('first',array(
				'conditions' => array('CategoriaLocal.nombre' => $nombre)
			)))
				return true;
			else
				return false;
		}
	}
?>