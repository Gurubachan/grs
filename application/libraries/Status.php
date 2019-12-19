<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Status
{
	private $ci;
	public function __construct()
	{
		$this->ci=& get_instance();
		$this->ci->load->model('Model_Default');
	}

	public function get($where=null){
		try {
			$status=array();
			$response_status=$this->ci->Model_Default->select(18,$where);
			if($response_status['response']!=false){
				$data_status=$response_status['message'];
				foreach ($data_status as $ds){
					$status[$ds->id]=$ds->name;
				}
				return array(
					'response'=>true,
					'message'=>count($status). "record available",
					'data'=>$status
				);
			}else{
				return $response_status;
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
