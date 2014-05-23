<?php
	class Producto extends AppModel {
		
		public $name = 'Producto';

		var $belongsTo = array('SubcategoriaProducto','User');

	}
?>