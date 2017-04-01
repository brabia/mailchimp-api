<?php
	/***************************************************************
	@
	@	MailChimp | 3.0
	@	bassem.rabia@gmail.com
	@
	/**************************************************************/
	
	class MailChimp{
		public $user;
		public $listId;
		public $apiUrl;
		private $apiKey;
		
		/**
		*	Create a new instance
		*	@param string $apiKey
		*	@param string $listId
		*	@param string $user
		**/
		function __construct($arg){
			if($arg['apiKey'] == ''){
				die(' -- Missing required parameters :( --');
			}
			$this->apiKey	= $arg['apiKey'];
		}
		
		/**
		*	get User Details
		*	@param string $user Email
		**/
		
		public function getUserDetails($arg){
			$this->user		= $arg['user'];	
			$this->listId	= $arg['listId'];
			$this->apiUrl = 'https://'.substr($this->apiKey, strpos($this->apiKey,'-')+1).'.api.mailchimp.com/3.0/lists/'.$this->listId.'/members/'.md5($this->user);
			$request = $this->sendCURL();
			
			if($request['response']['status'] == 401){
				$response = array(
					'email'		=> $arg['user'],
					'response'	=> $request['response']['detail']
				);
			}else if($request['response']['status'] == 404){
				$response = array(
					'email'		=> $arg['user'],
					'response'	=> 'This email address is not available!'
				);
			}else{
				$response = array(
					'email'		=> $arg['user'],
					'id'		=> $request['response']['id'],
					'status'	=> $request['response']['status'],
					'fields'	=> $request['response']['merge_fields'],
					'location'	=> $request['response']['location']
				);
			}
			echo json_encode($response);
		}
		
		/**
		*	Sending cUrl request
		**/
		
		public function sendCURL(){
			$ch = curl_init($this->apiUrl);
			curl_setopt($ch, CURLOPT_USERPWD, 'user:'.$this->apiKey);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_TIMEOUT, 10);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

			$result = curl_exec($ch);
			$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			curl_close($ch); 			
			return array('response'=> json_decode($result, true), 'status'=> $httpCode);
		}
	}
?>