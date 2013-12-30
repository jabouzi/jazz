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
			$this->load->helper('form');
			$this->lang->load('lang');
			foreach($this->lang->languages as $key => $value)
			{
				$view_data['languages'][site_url().$this->lang->switch_uri($key)] = lang($value);
			}
			$view_data['lang'] = site_url().$this->lang->switch_uri($this->lang->lang());
			$view_data['redirect'] = 'onChange="window.document.location.href=this.options[this.selectedIndex].value;"';
			$this->load->view('template', $view_data);
		}
		else
		{
			redirect('login');
		}
	}
}
