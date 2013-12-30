<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
		if ($this->session->userdata('user_email'))
		{
			$this->get_permissions();
		}
		else
		{
			redirect('login');
		}
	}
