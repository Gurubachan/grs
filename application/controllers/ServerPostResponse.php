<?php
/**
 * Created by PhpStorm.
 * User: Gurubachan-Asus
 * Date: 9/20/2019
 * Time: 12:39 PM
 */

class ServerPostResponse extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		isLogin('authdata');
	}
	public $server_path="http://61.12.81.38/cdms/";
	public function load_pc(){
		try{
// set post
			$ch = curl_init($this->server_path.'PC/load_pc');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			//curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
// execute!
			$response = curl_exec($ch);
			$err = curl_error($ch);
// close the connection, release resources used
			curl_close($ch);
// do anything you want with your response
			//echo($response);
			if ($err) {
				$message=array(
					'response'=>false,
					'message'=>$err
				);
			} else {
				$message=array(
					'response'=>true,
					'message'=>$response
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
	public function load_ac(){
		try{
			// set post
			$ch = curl_init($this->server_path.'AC/load_ac');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
// execute!
			$response = curl_exec($ch);
			$err = curl_error($ch);
// close the connection, release resources used
			curl_close($ch);
// do anything you want with your response
			//echo($response);
			if ($err) {
				$message=array(
					'response'=>false,
					'message'=>$err
				);
			} else {
				$message=array(
					'response'=>true,
					'message'=>$response
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

	public function get_distcode_on_ac(){
		try{
// set post
			$ch = curl_init($this->server_path.'AC/get_distcode_on_ac');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
// execute!
			$response = curl_exec($ch);
			$err = curl_error($ch);
// close the connection, release resources used
			curl_close($ch);
// do anything you want with your response
			//echo($response);
			if ($err) {
				$message=array(
					'response'=>false,
					'message'=>$err
				);
			} else {
				/*direct $response assign to message because server return standard format as we prepair*/
				$message=json_decode($response);
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

	public function load_block(){
		try{
// set post
			$ch = curl_init($this->server_path.'Block/load_block');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);

// execute!
			$response = curl_exec($ch);
			$err = curl_error($ch);
// close the connection, release resources used
			curl_close($ch);

// do anything you want with your response
			//echo($response);

			if ($err) {
				$message=array(
					'response'=>false,
					'message'=>$err
				);
			} else {
				$message=array(
					'response'=>true,
					'message'=>$response
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
