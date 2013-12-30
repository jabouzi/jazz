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
			$view_data['admin']['analytic_preview'] = modules::run('analytic/preview');
			$view_data['admin']['structure_preview'] = modules::run('structure/preview');
			$this->load->view('template', $view_data);
		}
		else
		{
			redirect('login');
		}
	}
}
