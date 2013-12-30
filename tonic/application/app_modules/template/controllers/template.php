<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template extends MX_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function index($view_data = array())
	{
		if ($this->session->userdata('user_email'))
		{
			//$view_data['analytics_preview'] = modules::run('analytics/preview');
			$view_data['structure_preview'] = modules::run('structure/preview');
			var_dump($view_data);
			$this->load->view('template', $view_data);
		}
		else
		{
			redirect('login');
		}
	}
}
