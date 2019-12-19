<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SenderReceiver
{
	private $ci;
	public function __construct()
	{
		$this->ci=& get_instance();
		$this->ci->load->model('Model_Default');
	}

	public function get($where=null){
		try {
			$sender=array();
			$response_sender_receiver=$this->ci->Model_Default->select(3,$where);
			if($response_sender_receiver['response']!=false){
				$data_sender_receiver=$response_sender_receiver['message'];
				foreach ($data_sender_receiver as $sr){
					$sender[$sr->id]=$sr->name;
				}
				return array(
					'response'=>true,
					'message'=>count($sender). "record available",
					'data'=>$sender
				);
			}else{
				return $response_sender_receiver;
			}
		}catch (Exception $exception){
			$message=array(
				'response'=>false,
				'message'=>$exception->getMessage()
			);
			return $message;
		}
	}
}
