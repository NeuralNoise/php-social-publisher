<?php
	require_once(MODULES_PATH . 'twitter/tmhOAuth/tmhOAuth.php');

	class TwitterPublisher implements ISocialPublisher {
		public function configure(ISocialPublisherParameter $parameter){
			if(!array_key_exists('consumer_key', $parameter->getParameters()))
				throw new Exception('Missing consumer key.');
			if(!array_key_exists('consumer_secret', $parameter->getParameters()))
				throw new Exception('Missing consumer secret.');
			if(!array_key_exists('token', $parameter->getParameters()))
				throw new Exception('Missing token.');
			if(!array_key_exists('secret', $parameter->getParameters()))
				throw new Exception('Missing secret.');

		
			$this->_config = $parameter->getParameters();
		}


		public function publish(ISocialStatus $status){
			$params = array(
				'status'  => $status->getStatusString()
			);

			$tmhOAuthEngine = new tmhOAuth($this->_config);

			$response = $tmhOAuthEngine->user_request(array(
					    'method' => 'POST',
					    'url' => $tmhOAuthEngine->url("1.1/statuses/update"),
					    'params' => $params,
					    'multipart' => true
					  ));

			if($response != 200)
				throw new Exception('Unable to publish on Twitter (ERR: ' . $response . ')');
		}

		
		private $_config = array();
	}
?>