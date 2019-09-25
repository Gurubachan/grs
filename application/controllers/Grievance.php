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
		$this->load->library('upload');
		isLogin('authdata');
	}

	public function frmGrievance(){
		try{
			$this->load->view('grievance/frmGrievance');
		}catch (Exception $exception){
			echo "Message:" .$exception->getMessage();
		}
	}
	public function frmGrievanceForward(){
		try{
			$this->load->view('grievance/frmGrivanceForward');
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
			//print_r($_POST);
			if(isset($_POST)) {
				extract($_POST);


				if (isset($cboType)) {
					$data[0]['gtype'] = $cboType;
				}
				if (isset($txtSubject)) {
					$data[0]['subject'] = ucwords($txtSubject);
				}
				if (isset($cboReferances)) {
					$data[0]['referanceno'] = $cboReferances;
				}
				if (isset($cboSource)) {
					$data[0]['source'] = $cboSource;
				}
				if (isset($txtMessage)) {
					$data[0]['body'] = ucwords($txtMessage);
				}
				if (isset($cboFrom)) {
					$data[0]['senderid'] = $cboFrom;
				}
				if (isset($cboTo)) {
					$data[0]['receiverid'] = $cboTo;
				}
				if (isset($cboPc)) {
					$data[0]['pccode'] = $cboPc;
				}
				if (isset($cboAc)) {
					$data[0]['accode'] = $cboAc;
				}
				if (isset($cboDist)) {
					$data[0]['distcode'] = $cboDist;
				}
				if (isset($cboBlock)) {
					$data[0]['blockcode'] = $cboBlock;

				}
				if (isset($cboMessageType)) {
					$data[0]['message_type'] = $cboMessageType;
				}
				if (isset($cboSeviourity)) {
					$data[0]['seviourity'] = $cboSeviourity;
				}
				if (isset($txtdateline)) {
					$data[0]['dateline'] = date("y-m-d", strtotime($txtdateline));
				}
				if (isset($cboSendto)) {
					$data[0]['stid'] = $cboSendto;
				}
				if (isset($cbopsu)) {
					$data[0]['psu'] = $cbopsu;
				}
				if (isset($cboMinistry)) {
					$data[0]['ministry'] = $cboMinistry;
				}
				if (isset($cboDepartment)) {
					$data[0]['department'] = $cboDepartment;
				}
				if (isset($cboDivision)) {
					$data[0]['division'] = $cboDivision;
				}
				if (isset($txtRemark)) {
					$data[0]['remark'] = $txtRemark;
				}
				if (isset($cboIndividual)) {
					$data[0]['individualid'] = $cboIndividual;
				}
				if ($this->session->authdata['userid']) {
					if(isset($txtId)){
						$data[0]['updatedby'] = $this->session->authdata['userid'];
					}else{
						$data[0]['entryby'] = $this->session->authdata['userid'];
					}

				}else{
					$message=array(
						'message'=>false,
						'response'=>'Unable to find session'
					);
				}
				$data[0]['isactive']=1;
				$new_name="";
				$config['file_name'] = time().$_FILES["attachment"]['name'];;
				$config['upload_path']   = 'uploads/';
				$config['allowed_types'] = 'jpg|doc|docx|pdf';
				$config['max_size']      = 5120;
				$config['file_ext_tolower'] = TRUE;
				$this->upload->initialize($config);

				if($this->upload->do_upload('attachment')){
					$uploadData = $this->upload->data();
					//print_r($uploadData);

					 $uploadedFile = $uploadData['file_name'];
					if(isset($txtId)){
						$data[0]['processfilelink']=base_url("uploads/$uploadedFile");
					}else{
						$data[0]['filelink']=base_url("uploads/$uploadedFile");
					}

					$message['success_msg'] = 'File has been uploaded successfully.';
				}else{
					$message['error_msg'] = $this->upload->display_errors();
				}
				if(isset($txtId)){
					$response=$this->Model_Default->update(5,$data,'id',$txtId);
				}else{
					$response=$this->Model_Default->insert(5,$data);
				}

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

	public function loadGrievences(){
		try{
			$where=null;
			$orderby=null;
			$groupby=null;
			$limit=0;
			if(isset($_POST)){
				extract($_POST);
				if(isset($date) && $date=="today"){
					$where.="isactive=1 and status=1 and date(createdate)='".date('Y-m-d')."'";
					$orderby="id desc";
					$limit=5;
				}
				if(isset($gid) && $gid!=null && is_int($gid)){
					$where.=" isactive = 1 and id=$gid ";
				}
			}
			/*if(isset($_GET)){
				extract($_GET);
				if(isset($linkid) && $linkid!=null){
					$where.="isactive =1 and status=1 and date(createdate)='".date('Y-m-d')."'";
				}
			}*/
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
							'referby'=>$d->referanceno,
							'subject'=>$d->subject,
							'body'=>$d->body,
							'recivedate'=>date("d-m-Y", strtotime($d->createdate)),
							'file'=>$d->filelink,
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
					'isactive'=>1,
					'linkid'=>$cboCategory,
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
			extract($_POST);
			$where="isactive=1 ";
			if($response_from!=null){

			}else{
				$where.=" and linkid=$linkid ";
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
			if(isset($txtGrievanceSubType) && isset($cboSubType)){
				$data[]=array(
					'tid'=>$cboSubType,
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
