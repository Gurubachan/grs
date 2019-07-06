<?php

defined("BASEPATH") or exit('No direct script access allowed.');
date_default_timezone_set("Asia/Kolkata");
header("Access-Control-Allow-Origin: *");

class Dashboard extends CI_Controller {

	public function header(Type $var = null)
	{
		$this->load->view('include/header');
	}
	
	public function footer(Type $var = null)
	{
		$this->load->view('include/footer');
	}

	public function navbar(Type $var = null)
	{
		$this->load->view('include/navbar');
	}
	public function index()
	{
		$this->header();
		$this->navbar();
		$this->load->view('dashboard/index');
		$this->footer();
	}
}
