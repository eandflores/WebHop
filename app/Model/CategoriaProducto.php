<?php
	class CategoriaProducto extends AppModel {
		
		public $name = 'CategoriaProducto';

		var $displayField = 'nombre';
		var $hasMany='SubcategoriaProducto';

	}
?>