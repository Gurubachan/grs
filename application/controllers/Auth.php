<?php
/**
 * Created by PhpStorm.
 * User: Gurubachan-Asus
 * Date: 9/24/2019
 * Time: 11:13 AM
 */

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_Default');
	}
	public function check_userid(){
		try{
			extract($_POST);
			/*print_r($_POST);
			exit();*/
			if(isset($txtUserName)){
				$where="(contact='$txtUserName' or emailid='$txtUserName') and isactive=1";
				$res=$this->Model_Default->select(16,$where);
				if($res['response']!=false){
					if(count($res['message'])==1){
						//$this->session->set_userdata('temp',$data);
						/*$this->load->view('password');*/
						$response=$this->check_password($res['message'][0]->id,$txtPassword);
						if($response['response']!=false){

							$res=$res['message'];
							/*print_r($res);
							exit();*/
							$data=array(
								'userid'=>$res[0]->id,
								'username'=>$res[0]->name,
								'usermobile'=>$res[0]->contact,
								'usermail'=>$res[0]->emailid,
								'usertype'=>$res[0]->usertype,
							);
							$this->session->set_userdata('authdata',$data);
							//redirect('Dashboard');
							$message=array('response'=>true,
								'message'=>'Dashboard'
								);
							//echo json_encode($message);
						}else{
							$message=$response;
						}
					}else{
						$message=array('response'=>false,
							'message'=>'Duplicate record availbale');
					}
				}else{
					$message=array('response'=>false,
						'message'=>'No record availbale');
				}
			}else{
				$message=array('response'=>false,
					'message'=>'Invalid user record provided.');
			}
			echo json_encode($message);
		}catch(Exception $exception){
			$message=array(
				'response'=>false,
				'message'=>$exception->getMessage()
			);
			echo json_encode($message);
		}
	}
	public function check_password($userid,$password){
		try{
			$where="userid=$userid and password='$password' and isactive=1";
			$res=$this->Model_Default->select(17,$where);
			if($res['response']!=false) {
				return $message=array(
					'response'=>true,
					'message'=>'Password Verification success'
					);
			}else{
				return $message=array(
					'response'=>false,
					'message'=>'Invalid Password'
				);
			}
		}catch (Exception $exception){
			$message=array(
				'response'=>false,
				'message'=>$exception->getMessage()
			);
			return json_encode($message);
		}
	}

	public function logout(){
		try{
			$this->session->sess_destroy();
			redirect('Welcome');
		}catch (Exception $exception){
			$message=array(
				'response'=>false,
				'message'=>$exception->getMessage()
			);
			echo json_encode($message);
		}
	}


}
