<?php
	require_once(MODULES_PATH . 'facebook/facebook-php-sdk/src/facebook.php');

	class FacebookPublisher implements ISocialPublisher {
		public function configure(ISocialPublisherParameter $parameter){
			if(!array_key_exists('appId', $parameter->getParameters()))
				throw new Exception('Missing app id.');
			if(!array_key_exists('secret', $parameter->getParameters()))
				throw new Exception('Missing secret.');
			if(!array_key_exists('cookie', $parameter->getParameters()))
				throw new Exception('Missing cookie status.');
			if(!array_key_exists('pageId', $parameter->getParameters()))
				throw new Exception('Missing page id.');

			$this->_pageId = $parameter->getParameters()['pageId'];
			$params = $parameter->getParameters();
			array_splice($params, array_search('pageId', array_keys($params)));
			$this->_config = $parameter->getParameters();
		}


		public function publish(ISocialStatus $status){
			$facebook = new Facebook($this->_config);
			$user = $facebook->getUser();

			if($user){
				try{
			    	$page_info = $facebook->api("/$this->_pageId?fields=access_token");
			    	if(!empty($page_info['access_token'])){
			    	$attachment = array(
			                        'access_token'  => $page_info['access_token'],
			                        'message'       => $status->getStatusString()
			                      );

			        $status = $facebook->api("/$this->_pageId/feed", "post", $attachment);

			        }else{
			          $status = 'No access token recieved';
			        }
			    }catch (FacebookApiException $e){
			      $user = null;
			      throw new Exception('Unable to post on Facebook.');
			    }
			  }else{
			      header("Location:{$facebook->getLoginUrl(array('scope' => 'photo_upload,user_status,publish_stream,user_photos,manage_pages'))}");
			  }
		}

		
		private $_config = array();
		private $_pageId;
	}
?>