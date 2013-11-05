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
								'appId'		=> 'FACEBOOK_APP_ID',
					            'secret'	=> 'FACEBOOK_SECRET',
					            'cookie'	=> false,
					            'pageId'	=> 'FACEBOOK_PAGE_ID'
								);

	$engine->addPublisher('twitter', $twitterConfiguration);
	$engine->addPublisher('facebook', $facebookConfiguration);

	try{
		$engine->publish('My test status !');
	}catch(Excepiton $e){
		echo 'Error: ' . $e->getMessage();
	}
?>
