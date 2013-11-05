<?php
	require_once(MODULES_PATH .'Modules.php');

	class SocialPublisherFactory implements ISocialPublisherFactory {
		public function getSocialPublisher($identifier){
			if(!array_key_exists($identifier, Modules::$modules))
				throw new Exception('The module ' . $identifier . ' does not exists.');

			$publisherReflector = new ReflectionClass(Modules::$modules[$identifier]);
			$publisher = $publisherReflector->newInstance();

			return $publisher;
		}
	}
?>