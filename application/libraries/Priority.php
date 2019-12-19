<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Priority
{
	private $ci;
	public function __construct()
	{
		$this->ci=& get_instance();
		$this->ci->load->model('Model_Default');
	}

	public function get($where=null){
		try {
			$response_priority=$this->ci->Model_Default->select(12,"isactive=1");
			$priotity_array=array();
			if($response_priority['response']!=false){
				$data_priority=$response_priority['message'];
				foreach ($data_priority as $dp){
					$priotity_array[$dp->id]=$dp->name;
				}

				return array(
					'response'=>true,
					'message'=>count($priotity_array). "record available",
					'data'=>$priotity_array
				);
			}else{
				return $response_priority;
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
