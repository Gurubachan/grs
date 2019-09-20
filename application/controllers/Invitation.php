<?php
/**
 * Created by PhpStorm.
 * User: Gurubachan
 * Date: 8/22/2019
 * Time: 11:37 PM
 */


defined("BASEPATH") or exit('No direct script access allowed.');
date_default_timezone_set("Asia/Kolkata");
header("Access-Control-Allow-Origin: *");
class Invitation extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_Default');
	}
	public function frmInvitation(){
		try{
			$this->load->view('invitation/frmInvitation');
		}catch (Exception $exception){
			echo "Message:" .$exception->getMessage();
		}
	}
	public function rptInvitation(){
		try{
			$this->load->view('invitation/rptInvitation');
		}catch (Exception $exception){
			echo "Message:" .$exception->getMessage();
		}
	}

	public function insertInvitation(){
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
					'stid'=>$cboSendto,
					'subject'=>ucwords($txtSubject),
					'referanceno'=>ucwords($txtReferance),
					'source'=>$cboSource,
					'body'=>ucwords($txtMessage),
					'entryby'=>1,
					'isactive'=>1
				);
				$response=$this->Model_Default->insert(5,$data);
				if($response['success']!=false){
					$message=array('success'=>true,'response'=>$response['message']);
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

}
