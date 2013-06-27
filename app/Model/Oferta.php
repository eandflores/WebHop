<?php
	class Oferta extends AppModel {
		
		public $name = 'Oferta';

		var $belongsTo = array('Producto','Local','User');

	}
?>