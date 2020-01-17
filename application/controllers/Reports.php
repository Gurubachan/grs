<?php
defined("BASEPATH") or exit('No direct script access allowed.');
date_default_timezone_set("Asia/Kolkata");
header("Access-Control-Allow-Origin: *");

class Reports extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_Default');
		isLogin('authdata');
	}

	public function loadReportForm(){
		try {
			$this->load->view('report/frmSearch');
		}catch (Exception $exception){
			echo "Message:" .$exception->getMessage();
		}
	}

	public function fetch_data(){
		try {
			//include ("Grievance.php");

			//print_r($_POST);
			extract($_POST);
			$where="isactive=1 ";
			$this->load->library(array('GrievenceType','Priority','Referance','SenderReceiver','Status'));
		/*	if(isset($cboCategory) && ($cboCategory!="" || $cboCategory="na")){
				$where.=" and gtype=$cboCategory ";
			}*/
			if(isset($cboType) && $cboType!="" && $cboType!="na"){
				$where.=" and gtype=$cboType ";
			}else{
				if(isset($cboCategory) && $cboCategory!="" && $cboCategory!="na"){
					$where_grivance_link="isactive =1  and linkid=$cboCategory";
				}else{
					$where_grivance_link="isactive =1 ";
				}
				$grievance_response=$this->grievencetype->get($where_grivance_link);
				if($grievance_response['response']!=false){
					$grievance_type=$grievance_response['data'];
					$grievance_string=implode(",",(array_keys($grievance_type)));
					$where.=" and gtype in ($grievance_string) ";
				}
			}
			if(isset($cboSeviourity) && $cboSeviourity!="" && $cboSeviourity!="na"){
				$where.=" and seviourity=$cboType ";
			}
			if(isset($cboAc) && $cboAc!="" && $cboAc!="na"){
				$where.=" and accode=$cboAc ";
			}
			if(isset($cboBlock) && $cboBlock!="" && $cboBlock!="na"){
				$where.=" and blockcode=$cboBlock ";
			}
			$response=$this->Model_Default->select(5,$where);
			if($response['response']!=false){
				$data=$response['message'];
			}
			//$message=array();


			$grievance_type=array();
			$grievance_response=$this->grievencetype->get('isactive=1');
			if($grievance_response['response']!=false){
				$grievance_type=$grievance_response['data'];
			}

			$this->load->library('SenderReceiver');
			$response_sender_receiver=$this->senderreceiver->get('isactive=1');
			$sender=array();
			if($response_sender_receiver['response']!=false){
				$sender=$response_sender_receiver['data'];
			}
			$response_referances=$this->referance->get("isactive=1");

			$referances_array=array();
			if($response_referances['response']!=false){
				$referances_array=$response_referances['data'];
			}
			$status=array();
			$response_status=$this->status->get('isactive=1');
			if($response_status['response']!=false){
				$status=$response_status['data'];
			}
			$priotity_array=array();
			$response_priority=$this->priority->get("isactive=1");

			if($response_priority['response']!=false){
				$priotity_array=$response_priority['data'];
			}
			foreach($data as $d){
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
					$statusname = $status[$d->status];
				}
				$data['grivance'][]=array(
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
			}
			if(isset($cboRptType)){
				switch ($cboRptType){
					case 1:
						$message=array(
							'response'=>true,
							'message'=>'',
						);
						break;
					case 2:
						$message=array(
							'response'=>true,
							'message'=>$this->load->view("report/rptSearch",$data,true),
						);
						break;
					case 3:
						$message=array(
							'response'=>true,
							'message'=>$_POST
						);
						break;
				}
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
}
