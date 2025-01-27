<?php
/**
 * Created by PhpStorm.
 * User: Gurubachan
 * Date: 7/6/2019
 * Time: 12:10 PM
 */


defined("BASEPATH") or exit('No direct script access allowed.');
date_default_timezone_set("Asia/Kolkata");
header("Access-Control-Allow-Origin: *");
class Source extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_Default');
		isLogin('authdata');
	}

	public function loadForm(){
		try{
			$this->load->view('Source/frmSource');
		}catch (Exception $exception){
			echo "Message :".$exception->getMessage();
		}
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
				$response=$this->Model_Default->insert(4,$data);
				if($response['response']!=false){
					$message=array('response'=>true,'message'=>$response['message']);
				}else{
					$message=$response;
				}
				echo json_encode($message);
			}

		}catch (Exception $exception){
			 $message=array(
				'response'=>false,
				'message'=>$exception->getMessage()
			);
			 echo json_encode($message);
		}
	}

	public function select($response_from=null){
		try{
			$where=null;
			if($response_from!=null){

			}else{
				$where='isactive=1';
			}
			$response=$this->Model_Default->select(4,$where);
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
