<?php
	class SocialStatus implements ISocialStatus {
		function __construct($status){
			if($status == null || $status == '')
				throw new Exception('Please specify a status.');

			$this->_statusString = $status;
		}

		public function getStatusString(){
			return $this->_statusString;
		}

		private $_statusString;
	}
?>