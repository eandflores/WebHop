<?php
	class Producto extends AppModel {
		
		public $name = 'Producto';

		var $belongsTo='CategoriaProducto';

	}
?>