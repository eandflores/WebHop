<?php
	class VotosLocal extends AppModel {
		
		public $name = 'VotosLocal';

		var $belongsTo = array('User','Local');

	}
?>