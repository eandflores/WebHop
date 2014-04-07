<?php
	class CategoriaProducto extends AppModel {
		
		public $name = 'CategoriaProducto';

		var $hasMany='Producto';

	}
?>