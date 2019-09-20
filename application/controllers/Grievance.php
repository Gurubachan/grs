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
					'subject'=>ucwords($txtSubject),
					'referanceno'=>$cboReferances,
					'source'=>$cboSource,
					'body'=>ucwords($txtMessage),
					'entryby'=>1,
					'isactive'=>1,
					'senderid'=>$cboFrom,
					'receiverid'=>$cboTo,
					'pccode'=>$cboPc,
					'accode'=>$cboAc,
					'distcode'=>$cboDist,
					'blockcode'=>$cboBlock
					/*'department'=>$cboDepartment,
					'stid'=>$cboSendto,
					'psu'=>$cbopsu,
					'ministry'=>$cboMinistry,
					'message_type'=>$cboMessageType,
					'seviourity'=>$cboSeviourity*/
				);
				$response=$this->Model_Default->insert(5,$data);
				if($response['response']!=false){
					$message=array('resonse'=>true,'message'=>$response['message']);
				}else{
					$message=$response;
				}
				echo json_encode($message);
			}
		}catch (Exception $exception){
			$message=array(
				'response'=>true,
				'message'=>$this->db->affected_rows()
			);
			echo json_encode($message);
		}
	}

	public function loadGrievences(){
		try{
			$where=null;
			$orderby=null;
			$groupby=null;
			$limit=0;
			if(isset($_POST)){
				extract($_POST);
				if(isset($date) && $date=="today"){
					$where.="isactive =1 and status=1 and date(createdate)='".date('Y-m-d')."'";
					$orderby="id desc";
					$limit=5;
				}
			}
			$response=$this->Model_Default->select(5, $where, $orderby, $groupby,$limit);

			if($response['response']!=false){
				$data=$response['message'];
				$response_sender_receiver=$this->Model_Default->select(3,'isactive=1');
				$sender=array();
				if($response_sender_receiver['response']!=false){
					$data_sender_receiver=$response_sender_receiver['message'];

					foreach ($data_sender_receiver as $sr){
						$sender[$sr->id]=$sr->name;
					}
				}

				$record=array();
				if(count($sender)>0){
					foreach ($data as $d){
						$record[]=array(
							'id'=>$d->id,
							'name'=>$sender[$d->senderid],
							'receiver'=>$sender[$d->receiverid],
							'subject'=>$d->subject,
							'referanceno'=>$d->referanceno,
							'subject'=>$d->subject,
							'body'=>$d->body,
							'status'=>'Received'
							);
					}
					$message=array('response'=>true,'message'=>$record);
				}else{
					$message=array('response'=>false,'message'=>"invalid sender and receiver");
				}

			}else{
				$message=$response;
			}
			echo json_encode($message);
		}catch (Exception $exception){
			$message=array(
				'response'=>true,
				'message'=>$this->db->affected_rows()
			);
			echo json_encode($message);
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
				'response'=>true,
				'message'=>$this->db->affected_rows()
			);
			echo json_encode($message);
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
	public function frmGrievanceSubType(){
		try{
			$this->load->view('grievance/frmGrievanceSubType');
		}catch (Exception $exception){
			echo "Message:" .$exception->getMessage();
		}

	}

	public function insertGrievenceSubType(){
		try{
			extract($_POST);
			if(isset($txtGrievanceSubType) && isset($cboType)){
				$data[]=array(
					'tid'=>$cboType,
					'stname'=>ucwords($txtGrievanceSubType),
					'entryby'=>1,
					'isactive'=>1
				);
				$response=$this->Model_Default->insert(14,$data);
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
				'response'=>true,
				'message'=>$exception->getMessage()
			);
			echo json_encode($message);
		}
	}

	public function loadGrievenceSubType($response_from=null){
		try{
			$where=null;
			if($response_from!=null){

			}else{
				$where='isactive=1';
			}
			$response=$this->Model_Default->select(14,$where);
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
	public function test(){
		//echo "hi";
		echo json_encode($_POST);
	}
}
