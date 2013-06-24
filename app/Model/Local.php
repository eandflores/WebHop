<?php
	class Local extends AppModel {
		
		public $name = 'Local';

		var $belongsTo='CategoriaLocal';

		public function existe($nombre){
			if($this->find('first',array(
				'conditions' => array('Local.nombre' => $nombre)
			)))
				return true;
			else
				return false;
		}
	}
?>