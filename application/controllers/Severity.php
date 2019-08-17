<?php
/**
 * Created by PhpStorm.
 * User: Gurubachan
 * Date: 8/15/2019
 * Time: 10:12 AM
 */

class Severity extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function select()
	{
		try{

		}catch (Exception $exception){
			$message=array(
				'response'=>false,
				'message'=>$exception->getMessage()
			);
		}
		echo json_encode($message);
	}
	public function insert(){
		try{

		}catch (Exception $exception){
			$message=array(
				'response'=>false,
				'message'=>$exception->getMessage()
			);
		}
		echo json_encode($message);
	}
}
