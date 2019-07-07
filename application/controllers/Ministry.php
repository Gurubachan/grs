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
	}
	public function loadForm(){
		$this->load->view('ministry/frmMinistry');
	}
	public function insert(){
		try{
			if(isset($_POST)){
				extract($_POST);
				$data[]=array(
					'ministry'=>ucwords($txtName),
					'entryby'=>1,
					'isactive'=>1
				);

			$response=$this->Model_Default->insert(6,$data);
			if($response!=false){
				$mesage=array('success'=>true,'response'=>$response);
			}else{
				$mesage=array('success'=>false);
			}
			echo json_encode($mesage);
			}
		}catch (Exception $exception){
			echo "Message :".$exception->getMessage();
		}
	}

	public function select(){
		try{
			$where=null;
			$response=$this->Model_Default->select(6,$where);
			if($response!=false){
				$message=array('success'=>true,'response'=>$response);
			}else{
				$message=array('success'=>false);
			}
			echo json_encode($message);
		}catch (Exception $exception){
			echo "Message :".$exception->getMessage();
		}
	}
}
