<?php
/**
 * Created by PhpStorm.
 * User: Gurubachan
 * Date: 8/15/2019
 * Time: 9:59 AM
 */

class MessageType extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_Default');
	}

	public function loadForm(){
		try{
			$this->load->view("messagetype/frmMessageType");
		}catch (Exception $exception){
			echo "Message :".$exception->getMessage();
		}
	}
	public function select($response_from=null)
	{
		try{
			$where=null;
			if($response_from!=null){

			}else{
				$where='isactive=1';
			}
			$response=$this->Model_Default->select(11,$where);
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
	public function insert(){
		try{
			extract($_POST);
			if(isset($txtMessageType)){
				$data[]=array(
					'name'=>ucwords($txtMessageType),
					'entryby'=>1,
					'isactive'=>1
				);
				$response=$this->Model_Default->insert(11,$data);
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
				'response'=>false,
				'message'=>$exception->getMessage()
			);
			echo json_encode($message);
		}

	}
}
