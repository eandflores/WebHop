<?php
	class SubcategoriaProducto extends AppModel {
		
		public $name = 'SubcategoriaProducto';

		var $belongsTo ='CategoriaProducto';
		var $hasMany='Producto';

	}
?>