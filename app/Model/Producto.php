<?php
	class Producto extends AppModel {
		
		public $name = 'Producto';

		var $belongsTo='CategoriaProducto';

		public function existe($nombre){
			if($this->find('first',array(
				'conditions' => array('Producto.nombre' => $nombre)
			)))
				return true;
			else
				return false;
		}
	}
?>