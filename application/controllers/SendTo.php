<?php
/**
 * Created by PhpStorm.
 * User: Gurubachan
 * Date: 8/17/2019
 * Time: 11:03 AM
 */

defined("BASEPATH") or exit('No direct script access allowed.');
date_default_timezone_set("Asia/Kolkata");
header("Access-Control-Allow-Origin: *");
class SendTo extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_Default');
	}

	public function loadForm(){
		$this->load->view('sendto/frmSendto');
	}
	public function insert(){
		try{
			if(isset($_POST)){
				extract($_POST);
				$data[]=array(
					'name'=>ucwords($txtName),
					'entryby'=>1,
					'isactive'=>1
				);

				$response=$this->Model_Default->insert(9,$data);
				if($response['response']!=false){
					$mesage=array('response'=>true,'message'=>$response['message']);
				}else{
					$mesage=$response;
				}
				echo json_encode($mesage);
			}
		}catch (Exception $exception){
			$message=array(
				'response'=>true,
				'message'=>$exception->getMessage()
			);
			echo json_encode($message);
		}
	}

	public function select(){
		try{
			$where=null;
			$response=$this->Model_Default->select(9,$where);
			if($response['response']!=false){
				$message=array('response'=>true,'message'=>$response['message']);
			}else{
				$message=$response;
			}
			echo json_encode($message);
		}catch (Exception $exception){
			$message=array(
				'response'=>false,
				'message'=>$exception->getMessage()
			);
			echo json_encode($message);
		}
	}

}
