<?php
/**
 * Created by PhpStorm.
 * User: Gurubachan
 * Date: 7/5/2019
 * Time: 1:22 PM
 */

defined("BASEPATH") or exit('No direct script access allowed.');
date_default_timezone_set("Asia/Kolkata");
header("Access-Control-Allow-Origin: *");
class Grievance extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_Default');
	}

	public function frmGrievance(){
		try{
			$this->load->view('grievance/frmGrievance');
		}catch (Exception $exception){
			echo "Message:" .$exception->getMessage();
		}
	}
	public function rptGrievance(){
		try{
			$this->load->view('grievance/rptGrievance');
		}catch (Exception $exception){
			echo "Message:" .$exception->getMessage();
		}
	}

	public function insertGrievence(){
		try{
			if(isset($_POST)){
				extract($_POST);
				$data[]=array(
					'gtype'=>$cboType,
					'senderid'=>$cboFrom,
					'receiverid'=>$cboTo,
					'ministry'=>$cboMinistry,
					'psu'=>$cbopsu,
					'department'=>$cboDepartment,
					'subject'=>ucwords($txtSubject),
					'referanceno'=>ucwords($txtReferance),
					'source'=>$cboSource,
					'body'=>ucwords($txtMessage),
					'entryby'=>1,
					'isactive'=>1
				);
				$response=$this->Model_Default->insert(5,$data);
				if($response!=false){
					$message=array('success'=>true,'response'=>$response);
				}else{
					$message=array('success'=>false);
				}
				echo json_encode($message);
			}
		}catch (Exception $exception){
			echo "Message :".$exception->getMessage();
		}
	}

	public function loadGrievences(){
		try{
			$response=$this->Model_Default->select(5);
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

	public function frmGrievanceType(){
		try{
			$this->load->view('grievance/frmGrievanceType');
		}catch (Exception $exception){
			echo "Message:" .$exception->getMessage();
		}

	}

	public function insertGrievenceType(){
		try{
			extract($_POST);
			if(isset($txtGrievanceType)){
				$data[]=array(
					'tname'=>ucwords($txtGrievanceType),
					'entryby'=>1,
					'isactive'=>1
				);
				$response=$this->Model_Default->insert(1,$data);
				if($response!=false){
					$message=array('success'=>true,'response'=>$response);
				}else{
					$message=array('success'=>false);
				}
				echo json_encode($message);
			}

		}catch (Exception $exception){
			echo "Message :".$exception->getMessage();
		}
	}

	public function loadGrievenceType($response_from=null){
		try{
			$where=null;
			if($response_from!=null){

			}else{
				$where='isactive=1';
			}
			$response=$this->Model_Default->select(1,$where);
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
