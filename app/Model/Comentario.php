<?php
	class Comentario extends AppModel {
		
		public $name = 'Comentario';

		var $belongsTo = array('User','Local');

	}
?>