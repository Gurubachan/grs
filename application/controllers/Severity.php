<?php
/**
 * Created by PhpStorm.
 * User: Gurubachan
 * Date: 8/15/2019
 * Time: 10:12 AM
 */

class Severity extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_Default');
		isLogin('authdata');
	}

	public function loadForm(){
		try{
			$this->load->view("Severity/frmSeverity");
		}catch (Exception $exception){
			echo "Message :".$exception->getMessage();
		}
	}
	public function select($response_from=null)
	{
		try{
			$where=null;
			if($response_from!=null){

			}else{
				$where='isactive=1';
			}
			$response=$this->Model_Default->select(12,$where);
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
	public function insert(){
		try{
			extract($_POST);
			if(isset($txtSeverityType)){
				$data[]=array(
					'name'=>ucwords($txtSeverityType),
					'entryby'=>1,
					'isactive'=>1
				);
				$response=$this->Model_Default->insert(12,$data);
				if($response['response']!=false){
					$message=array('response'=>true,'message'=>$response['message']);
				}else{
					$message=$response;
				}

			}else{
				$message=array(
					'response'=>false,
					'message'=>'Invalid request send.'
				);
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
