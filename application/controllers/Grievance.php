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
			$this->load->view('grievance/frmNewGrievanceForward');
		}catch (Exception $exception){
			echo "Message:" .$exception->getMessage();
		}
	}
	public function rptGrievance(){
		try{
			//$this->load->view('grievance/rptGrievance');
			$this->load->view('dashboard/grivance_details');
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
				if (isset($cboSubCategory) && $cboSubCategory!="") {
					$data[0]['gsubtype'] = $cboSubCategory;
				}
				if (isset($txtSubject) && $txtSubject!="") {
					$data[0]['subject'] = ucwords($txtSubject);
				}
				if (isset($cboReferances) && $cboReferances!="") {
					$data[0]['referanceno'] = $cboReferances;
				}
				if (isset($cboSource) && $cboSource!="") {
					$data[0]['source'] = $cboSource;
				}
				if (isset($txtMessage) && $txtMessage!="") {
					$data[0]['body'] = ucwords($txtMessage);
				}
				if (isset($cboFrom) && $cboFrom!="") {
					$data[0]['senderid'] = $cboFrom;
				}
				if (isset($cboTo) && $cboTo!="") {
					$data[0]['receiverid'] = $cboTo;
				}
				if (isset($cboPc) && $cboPc!="") {
					$data[0]['pccode'] = $cboPc;
				}
				if (isset($cboAc) && $cboAc!="") {
					$data[0]['accode'] = $cboAc;
				}
				if (isset($cboDist) && $cboDist!="") {
					$data[0]['distcode'] = $cboDist;
				}
				if (isset($cboBlock) && $cboBlock!="") {
					$data[0]['blockcode'] = $cboBlock;
				}
				if (isset($cboMessageType) && $cboMessageType!="") {
					$data[0]['message_type'] = $cboMessageType;
				}
				if (isset($cboSeviourity) && $cboSeviourity!="") {
					$data[0]['seviourity'] = $cboSeviourity;
				}
				if (isset($txtdateline) && $txtdateline!="") {
					$data[0]['dateline'] = date("y-m-d", strtotime($txtdateline));
				}
				if (isset($cboSendto) && $cboSendto!="") {
					$data[0]['stid'] = $cboSendto;
				}
				if (isset($cbopsu) && $cbopsu!="") {
					$data[0]['psu'] = $cbopsu;
				}
				if (isset($cboMinistry) && $cboMinistry!="") {
					$data[0]['ministry'] = $cboMinistry;
				}
				if (isset($cboDepartment) && $cboDepartment!="") {
					$data[0]['department'] = $cboDepartment;
				}
				if (isset($cboDivision) && $cboDivision!="") {
					$data[0]['division'] = $cboDivision;
				}
				if (isset($txtRemark) && $txtRemark!="") {
					$data[0]['remark'] = $txtRemark;
				}
				if (isset($cboIndividual) && $cboIndividual!="") {
					$data[0]['individualid'] = $cboIndividual;
				}
				if (isset($txtReceiveDate) && $txtReceiveDate!="") {
					$data[0]['receivedate']=date("Y-m-d",strtotime($txtReceiveDate));
				}
				if(isset($status) && $status!=""){
					$data[0]['status'] = $status;
				}
				if ($this->session->authdata['userid']) {
					if(isset($txtId) && $txtId!=null){
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
					if(isset($txtId) && $txtId!=null && isset($form) && $form!='frmGrievence'){
						$data[0]['processfilelink']=base_url("uploads/$uploadedFile");
					}else{
						$data[0]['filelink']=base_url("uploads/$uploadedFile");
					}

					$message['success_msg'] = 'File has been uploaded successfully.';
				}else{
					$message['error_msg'] = $this->upload->display_errors();
				}
				if(isset($txtId) && $txtId!=null){
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
			$where=" isactive=1 ";
			$orderby="id desc";
			$groupby=null;
			$limit=0;
			if(isset($_POST)){
				extract($_POST);
				if(isset($date) && $date=="today"){
					$where.=" and status=1 and date(createdate)='".date('Y-m-d')."'";
					$orderby="id desc";
					$limit=5;
				}
				if(isset($gid) && $gid!=null){
					$where.="  and id=$gid ";
				}

			}
			$where_grivance_link="";
			if(isset($_GET)){
				extract($_GET);
				if(isset($linkid) && $linkid!=null){
					$where_grivance_link="isactive =1  and linkid=$linkid";
				}
				if(isset($category) && $category!=null){
					$where_grivance_link="isactive =1 and tname='".$category."'";
				}
			}
			//print_r($_GET);
			$grievance_type=array();

			$this->load->library('GrievenceType');
			$grievance_response=$this->grievencetype->get($where_grivance_link);
			if($grievance_response['response']!=false){
				$grievance_type=$grievance_response['data'];
				$grievance_string=implode(",",(array_keys($grievance_type)));
				$where.=" and gtype in ($grievance_string) ";
			}

			$response=$this->Model_Default->select(5, $where, $orderby, $groupby,$limit);

			/*Load Priority*/
			//$response_priority=$this->Model_Default->select(12,);


			$this->load->library('Priority');
			$priotity_array=array();
			$response_priority=$this->priority->get("isactive=1");

			if($response_priority['response']!=false){
				$priotity_array=$response_priority['data'];
			}

			/*Load Referances*/
			$this->load->library('Referance');
			$response_referances=$this->referance->get("isactive=1");

			$referances_array=array();
			if($response_referances['response']!=false){
				$referances_array=$response_referances['data'];
			}
			//print_r($referances_array);
			if($response['response']!=false){
				$data=$response['message'];
				$this->load->library('SenderReceiver');
				$response_sender_receiver=$this->senderreceiver->get('isactive=1');
				$sender=array();

				if($response_sender_receiver['response']!=false){
					$sender=$response_sender_receiver['data'];
				}
				$status=array();
				$this->load->library('Status');
				$response_status=$this->status->get('isactive=1');
				if($response_status['response']!=false){
					$status=$response_status['data'];
				}
				//print_r($status);
				$record=array();
				if(count($sender)>0){
					if(isset($gid) && $gid!="" && $location!="dashboard"){
						$record=$data;
					}else{
						foreach ($data as $d){
							$senderid = ($d->senderid)>0 ? $sender[$d->senderid] : "";
							$receiverid = ($d->receiverid)>0 ? $sender[$d->receiverid] : "";
							$grivancetype = ($d->gtype)>0 ? $grievance_type[$d->gtype] : "";
							$referby = ($d->referanceno)>0 ? $referances_array[$d->referanceno] : "";
							$grivance_date = ($d->status==1) ? $d->createdate : $d->updatedate;
							$currentdate = date("Y-m-d H:i:s");
							$date_diff = strtotime($currentdate)-strtotime($grivance_date);
							$time_gap=date_diff(date_create($grivance_date),date_create($currentdate));

							if($date_diff > 86400 && $d->status!=4){
								$statusname = 'Pending';
							}else{
								$statusname =  ($d->status>0) ? $status[$d->status] : 0;
								//echo($statusname);
							}

							$record[$statusname][]=array(
								'id'=>$d->id,
								'name'=>$senderid,
								'receiver'=>$receiverid,
								'subject'=>$d->subject,
								'referby'=>$referby,
								'body'=>$d->body,
								'recivedate'=>date("d-m-Y", strtotime($d->createdate)),
								'filelink'=>$d->filelink,
								'statuscode'=>$d->status,
								'statusname'=>$statusname,
								'type'=>$grivancetype,
								'date'=>date("d-m-Y", strtotime($d->receivedate)),
								'effectivedate'=>$time_gap->format("%r%a days %h hr %i min %s sec"),
								'priority'=>($d->seviourity>0)?$priotity_array[$d->seviourity]:""
							);
							$records[$statusname][]=$grivancetype;
							$status_records[]=$statusname;
						}
						$grievence_status=array_count_values($status_records);
						$grievencetyepe_counts=array();
						$unique_status=array_unique($status_records);
						foreach ($unique_status as $v){
							$grievencetyepe_counts[$v]=array_count_values($records[$v]);
						}
						$datas['grievencetype']=$grievencetyepe_counts;
						$datas['grievencestatus']=$grievence_status;
					}


					//print_r($records);

					//print_r($grievencetyepe_counts);
					/*if(isset($status) && ($status!="" || $status!=null)){
						$datas['record']=$record[$status];
					}else{

					}*/

					$datas['record']=$record;

					$message=array('response'=>true,'message'=>$datas);
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
				'message'=>$exception->getMessage()
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
				if(isset($linkid) && $linkid!=null){
					$where.=" and linkid=$linkid ";
				}
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

	/*Grievance Action Taken Report
	15-12-2019
	*/
	public function insertActioTaken(){
		try {
			//print_r($_POST);
			if(isset($_POST)){
				extract($_POST);
				if(isset($txtForwardTo) && $txtForwardTo!=""){
					$data[0]['forwardto']=ucwords($txtForwardTo);
				}

				if(isset($txtRemark) && $txtRemark!=""){
					$data[0]['remark']=ucwords($txtRemark);
				}
				if(isset($txtReceiveDate) && $txtReceiveDate!=""){
					$data[0]['letterdate']=date("y-m-d", strtotime($txtReceiveDate));
				}
				if(isset($txtId) && $txtId!=""){
					$data[0]['grievenceid']=$txtId;
				}else{
					$message=array('response'=>false,'message'=>"Invalid Grievence Id");
					echo json_encode($message);
					exit();
				}
				if ($this->session->authdata['userid']) {
						$data[0]['entryby'] = $this->session->authdata['userid'];
				}else{
					$message=array(
						'message'=>false,
						'response'=>'Unable to find session'
					);
					echo json_encode($message);
					exit();
				}
				if( $this->session->authdata['usertype'] == 3){
					if(isset($chkResolved) && $chkResolved!="" ){
						$resolved[0]['status']=4;
					}else{
						$resolved[0]['status']=3;
					}
				}
				$data[0]['status']=$resolved[0]['status'];
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
					$data[0]['letterlink']=base_url("uploads/$uploadedFile");
					$message['success_msg'] = 'File has been uploaded successfully.';
				}else{
					$message['error_msg'] = $this->upload->display_errors();
				}
				$response=$this->Model_Default->insert(19,$data);


				$resolved[0]['updatedby']= $this->session->authdata['userid'];
				$response=$this->Model_Default->update(5,$resolved,'id',$txtId);
				$message=$response;
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
	public function actionTakenReport(){
		try {
			extract($_POST);
			//print_r($_POST);
			if(isset($txtId) && $txtId!=""){
				$where="isactive=1 and grievenceid=$txtId";
				$response=$this->Model_Default->select(19,$where);
				if($response['response']!=false){
					$data['records']=$response['message'];
				}
				$message=array(
					'response'=>true,
					'message'=>$this->load->view("grievance/rptGrievanceForward",$data,true),
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
	public function test(){
		//echo "hi";
		echo json_encode($_POST);
	}
}
