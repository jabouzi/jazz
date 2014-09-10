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
			$actives = array('','','','','','','','','','','','','','','');
			$blocks = array('','','','');
			if ($this->uri->segment(2) == 'dashboard' || $this->uri->segment(2) == '')
			{
				$actives[0] = 'active';
			}
			else if($this->uri->segment(2) == 'category')
			{
				$actives[1] = 'active-parent active';
				$actives[4] = 'active-parent active';
				$blocks[0] = 'display:block';
			}
			else if($this->uri->segment(2) == 'language')
			{
				$actives[1] = 'active-parent active';
				$actives[5] = 'active-parent active';
				$blocks[0] = 'display:block';
			}
			else if($this->uri->segment(3) == 'newuser')
			{
				$actives[6] = 'active-parent active';
				$actives[7] = 'active-parent active';
				$blocks[1] = 'display:block';
			}
			else if($this->uri->segment(3) == 'users')
			{
				$actives[6] = 'active-parent active';
				$actives[8] = 'active-parent active';
				$blocks[1] = 'display:block';
			}
			else if($this->uri->segment(2) == 'user')
			{
				$actives[6] = 'active-parent active';
				$actives[9] = 'active-parent active';
				$blocks[1] = 'display:block';
			}
			else if($this->uri->segment(2) == 'workflow')
			{
				$actives[11] = 'active-parent active';
				$actives[12] = 'active-parent active';
				$blocks[2] = 'display:block';
			}
			else if($this->uri->segment(2) == 'permission')
			{
				$actives[11] = 'active-parent active';
				$actives[13] = 'active-parent active';
				$blocks[2] = 'display:block';
			}
			
			//var_dump($this->uri->segment(1), $this->uri->segment(2), $this->uri->segment(3));
			$this->load->helper('form');
			$this->load->helper('array');
			
			$view_data['info_message'] = $this->session->userdata('info_message');
			$view_data['warning_message'] = $this->session->userdata('warning_message');
			$view_data['error_message'] = $this->session->userdata('error_message');
			$view_data['success_message'] = $this->session->userdata('success_message');
			
			foreach($this->lang->languages as $key => $value)
			{
				$view_data['languages'][site_url().$this->lang->switch_uri($key)] = ucfirst(strtolower($value));
			}
			
			$view_data['actives'] = $actives;
			$view_data['blocks'] = $blocks;
			$view_data['lang'] = site_url().$this->lang->switch_uri($this->lang->lang());
			$view_data['redirect'] = 'class="form-control" onChange="window.document.location.href=this.options[this.selectedIndex].value;"';
			$this->load->view('template', $view_data);
			$this->session->unset_userdata('warning_message');
			$this->session->unset_userdata('info_message');
			$this->session->unset_userdata('error_message');
			$this->session->unset_userdata('success_message');
		}
		else
		{
			redirect('login');
		}
	}
}
