<?php
	require_once('SocialEngine.php');

	$engine = new SocialEngine();

	$twitterConfiguration = array(
								'consumer_key'    => 'TWITTER_CONSUMER_KEY',
								'consumer_secret' => 'TWITTER_CONSUMER_SECRET',
								'token'           => 'TWITTER_TOKEN',
								'secret'          => 'TWITTER_SECRET'
								);

	$facebookConfiguration = array(
								// TODO
								);

	$engine->addPublisher('twitter', $twitterConfiguration);
	$engine->addPublisher('facebook', $facebookConfiguration);

	try{
		$engine->publish('My test status !');
	}catch(Excepiton $e){
		echo 'Success !';
	}
?>