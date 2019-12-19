<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class GrievenceType
{
	private $ci;
	public function __construct()
	{
		$this->ci=& get_instance();
		$this->ci->load->model('Model_Default');
	}

	public function get($where=null){
		try {
			$grievance_type=array();
			$grievance_response=$this->ci->Model_Default->select(1,$where);
			if($grievance_response['response']!=false){
				$grievance_type_data=$grievance_response['message'];
				foreach ($grievance_type_data as $g){
					$grievance_type[$g->id]=$g->tname;
				}
				return array(
					'response'=>true,
					'message'=>count($grievance_type). "record available",
					'data'=>$grievance_type
					);
			}else{
				return $grievance_response;
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
