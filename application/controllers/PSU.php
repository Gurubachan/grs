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
class PSU extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_Default');
	}

	public function loadForm(){
		$this->load->view('psu/frmPsu');
	}
	public function insert(){
		try{
			if(isset($_POST)){
				extract($_POST);
				$data[]=array(
					'psuname'=>ucwords($txtName),
					'mid'=>$cboMinistry,
					'entryby'=>1,
					'isactive'=>1
				);

				$response=$this->Model_Default->insert(7,$data);
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
				'message'=>$this->db->affected_rows()
			);
			echo json_encode($message);
		}
	}

	public function select(){
		try{
			$where="";
			if(isset($_POST['ministryid']) && $_POST['ministryid']!=""){
				extract($_POST);
				$where.="mid=$ministryid";
			}

			$response=$this->Model_Default->select(7,$where);
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
