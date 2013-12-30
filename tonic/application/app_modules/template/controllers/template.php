<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template extends MX_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function index($view_data = array())
	{
		$this->load->helper('language');
		$this->lang->load('dashboard');
		if ($this->session->userdata('user_email'))
		{
			$this->load->view('template', $view_data);
		}
		else
		{
			redirect('login');
		}
	}
}
