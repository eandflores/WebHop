<?php
	class Region extends AppModel {
		
		public $name = 'Region';

		var $hasMany='Comuna';

	}
?>