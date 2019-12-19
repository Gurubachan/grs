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
			//$message=array();
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
							'message'=>$this->load->view("report/rptSearch",'',true),
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
