<?php
/**
 * Created by PhpStorm.
 * User: Gurubachan
 * Date: 8/17/2019
 * Time: 12:51 PM
 */

class Division extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_Default');
	}

	public function loadForm(){
		$this->load->view('division/frmDivision');
	}

	public function insert(){
		try{
			if(isset($_POST)){
				extract($_POST);
				$data[]=array(
					'name'=>ucwords($txtName),
					'department'=>$cboDepartment,
					'entryby'=>1,
					'isactive'=>1
				);

				$response=$this->Model_Default->insert(10,$data);
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
			if(isset($_POST['department']) && $_POST['department']!=""){
				extract($_POST);
				$where.="department=$department";
			}

			$response=$this->Model_Default->select(10,$where);
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
