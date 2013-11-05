<?php
	include(MODULES_PATH . 'facebook/FacebookPublisher.php');
	include(MODULES_PATH . 'twitter/TwitterPublisher.php');

	class Modules {
		public static $modules = array(
			'facebook'	=> 'FacebookPublisher',
			'twitter'	=> 'TwitterPublisher'
		);
	}
?>