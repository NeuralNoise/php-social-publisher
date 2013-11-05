<?php
interface ISocialPublisher {
	public function configure(ISocialPublisherParameter $parameter);
	public function publish(ISocialStatus $status);
}
?>