<?php
	class CategoriaProducto extends AppModel {
		
		public $name = 'CategoriaProducto';

		var $hasMany='Producto';

		public function existe($nombre){
			if($this->find('first',array(
				'conditions' => array('CategoriaProducto.nombre' => $nombre)
			)))
				return true;
			else
				return false;
		}
	}
?>