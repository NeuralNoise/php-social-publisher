<?php
	require_once('config.php');
	include(INTERFACES_PATH . 'ISocialPublisher.php');
	include(INTERFACES_PATH . 'ISocialPublisherFactory.php');
	include(INTERFACES_PATH . 'ISocialPublisherParameter.php');
	include(INTERFACES_PATH . 'ISocialStatus.php');
	include(MODULES_PATH    . 'SocialPublisherFactory.php');
	include(CORE_PATH . 'SocialStatus.php');
	include(CORE_PATH . 'SocialPublisherParameter.php');

	class SocialEngine {
		function __construct(){
			$this->_socialPublisherFactory = new SocialPublisherFactory();
		}

		public function addPublisher($publisherName, $publisherConfiguration = array()){
			if($publisherName == null || $publisherName == '')
				throw new Exception('Please specify the social publisher\'s name.');

			$parameter = new SocialPublisherParameter($publisherConfiguration);

			try{
				$publisher = $this->_socialPublisherFactory->getSocialPublisher($publisherName);
				$publisher->configure($parameter);
				array_push($this->_publishers, $publisher);
			}catch(Exception $e){
				throw new Exception('Creation failed : ' . $e->getMessage());
			}
		}

		public function publish($status){
			if(count($this->_publishers) <= 0)
				throw new Exception('First, add social publishers.');

			try{
				$this->_socialStatus = new SocialStatus($status);
			}catch(Exception $e){
				throw new Exception('Status creation failed : ' . $e->getMessage());
			}

			foreach($this->_publishers as $publisher){
				try{
					$publisher->publish($this->_socialStatus);
				}catch(Exception $e){
					throw new Exception('Publication error : ' . $e->getMessage());
				}
			}
		}


		private $_publishers = array();
		private $_socialPublisherFactory;
		private $_socialStatus;
	}
?>