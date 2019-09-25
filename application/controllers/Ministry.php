<?php
/**
 * Created by PhpStorm.
 * User: Gurubachan
 * Date: 7/6/2019
 * Time: 11:20 PM
 */

defined("BASEPATH") or exit('No direct script access allowed.');
date_default_timezone_set("Asia/Kolkata");
header("Access-Control-Allow-Origin: *");
class Ministry extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_Default');
		isLogin('authdata');
	}
	public function loadForm(){
		$this->load->view('ministry/frmMinistry');
	}
	public function insert(){
		try{

			/*if(is_array($_POST)){
				$postdata = file_get_contents("php://input");
				echo $postdata;
				$request = json_decode($postdata);
				print_r($request);

			}else{
				echo "Array not found";
			}
			exit();*/
			if(isset($_POST)){
				extract($_POST);
				$data[]=array(
					'stid'=>$cboSendto,
					'ministry'=>ucwords($txtName),
					'entryby'=>1,
					'isactive'=>1
				);

			$response=$this->Model_Default->insert(6,$data);
			if($response['response']!=false){
				$message=array('response'=>true,'message'=>$response['message']);
			}else{
				$message=$response;
			}

			}else{
				$message=array(
					'response'=>false,
					'message'=>'Invalid post data'
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

	public function select(){
		try{
			$where=null;
			if(isset($_POST['sendtoid']) && $_POST['sendtoid']!=""){
				extract($_POST);
				$where.="stid=$sendtoid";
			}
			$response=$this->Model_Default->select(6,$where);
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
