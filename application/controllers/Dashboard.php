<?php

defined('BASEPATH') OR exit('No direct script access allowed');

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