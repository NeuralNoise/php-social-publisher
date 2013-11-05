<?php
	require_once(MODULES_PATH . 'facebook/facebook-php-sdk/src/facebook.php');

	class FacebookPublisher implements ISocialPublisher {
		public function configure(ISocialPublisherParameter $parameter){
			// TODO
		}


		public function publish(ISocialStatus $status){
			// TODO
			echo 'TODO: Facebook';
		}

		
		private $_config = array();
	}
?>