<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Referance
{
	private $ci;
	public function __construct()
	{
		$this->ci=& get_instance();
		$this->ci->load->model('Model_Default');
	}

	public function get($where=null){
		try {
			$response_referances=$this->ci->Model_Default->select(13,$where);
			$referances_array=array();
			if($response_referances['response']!=false){
				$data_referances=$response_referances['message'];
				foreach ($data_referances as $dr){
					$referances_array[$dr->id]=$dr->referancename;
				}


				return array(
					'response'=>true,
					'message'=>count($referances_array). "record available",
					'data'=>$referances_array
				);
			}else{
				return $response_referances;
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
