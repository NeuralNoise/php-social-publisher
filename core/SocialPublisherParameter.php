<?php
	class SocialPublisherParameter implements ISocialPublisherParameter {
		function __construct($publisherConfiguration = array()){
			$this->_parameters = $publisherConfiguration;
		}

		public function getParameters(){
			return $this->_parameters;
		}

		private $_parameters;
	}
?>