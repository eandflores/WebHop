<?php
	class Local extends AppModel {
		
		public $name = 'Local';

		var $belongsTo = array('CategoriaLocal','User','Comuna');

	}
?>