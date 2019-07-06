<?php
/**
 * Created by PhpStorm.
 * User: Gurubachan
 * Date: 7/5/2019
 * Time: 6:55 PM
 */

defined("BASEPATH") or exit('No direct script access allowed.');
date_default_timezone_set("Asia/Kolkata");
header("Access-Control-Allow-Origin: *");
class SenderReceiver extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_Default');
	}

	public function frmSenderReceiver(){
		try{
			$this->load->view('Sender_Receiver/frmSenderReceiver');
		}catch (Exception $exception){
			echo "Message :".$exception->getMessage();
		}
	}

	public function insertSenderReceiver(){
		try{
			if(isset($_POST)){
				extract($_POST);
				$data[]=array(
					'name'=>ucwords($txtName),
					'contact'=>$txtContact,
					'emailid'=>$txtEmailID,
					'address'=>ucwords($txtAddress),
					'pincode'=>$txtPinCode,
					'sendertype'=>$cboSenderReceiver,
					'entryby'=>1,
					'isactive'=>1
				);
				$response=$this->Model_Default->insert(3,$data);
				if($response!=false){
					$message=array(
						'success'=>true,
						'response'=>$response
					);
				}else{
					$message=array(
						'success'=>false
					);
				}

				echo json_encode($message);
			}
		}catch (Exception $exception){

		}
	}

	public function selectSenderReceiver(){
		try{
			extract($_POST);
			//print_r($_POST);
			if($id!=null){
				$where="isactive=1 and id=$id";
			}else{
				$where="isactive=1";
			}
			if($sendertype!=null){
				if($sendertype==1 || $sendertype==2){
					$where.=" and sendertype=$sendertype";
				}
			}
			//echo $where;
			$response=$this->Model_Default->select(3,$where);
			if($response!=false){
				$message=array('success'=>true, 'response'=>$response);
			}else{
				$message=array('success'=>false);
			}
			echo json_encode($message);
		}catch (Exception $exception){
			echo "Message :".$exception->getMessage();
		}
	}

}
