<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('mdl_user');
	}
	
	function index()
	{
		$view_data['page_title'] = lang('user.profile');
		$user_profile = $this->mdl_user->get_where($this->session->userdata('user_id'));
		$view_data['admin_widgets']['user'] = $this->show('profile', $user_profile->row());
		echo modules::run('template', $view_data);
	}
	
	function users()
	{
		$view_data['page_title'] = lang('user.users');
		$users = $this->mdl_user->get_where_custom(array('user_permission > ' => $this->session->userdata('user_permission')));
		$view_data['admin_widgets']['user'] = $this->show('users', $users);
		echo modules::run('template', $view_data);
	}
	
	function newuser()
	{
		$view_data['page_title'] = lang('user.new');
		$view_data['admin_widgets']['user'] = $this->show('newuser', array());
		echo modules::run('template', $view_data);
	}
	
	function edituser($id = 0)
	{
		// il ne faut pas accéder au profile d'un usager ou la permission est sup.
		if (!$id) redirect('dashboard');
		$view_data['page_title'] = lang('user.edit');
		$user_profile = $this->mdl_user->get_where($id);
		if ($user_profile->row()->user_id == $this->session->userdata('user_id'))  redirect('user');
		if ($user_profile->row()->user_permission <= $this->session->userdata('user_permission')) redirect('dashboard');
		$view_data['admin_widgets']['user'] = $this->show('edituser', $user_profile->row());
		echo modules::run('template', $view_data);
	}
	
	private function show($view, $user_data)
	{
		$this->load->helper('form');
		$view_data['user'] = $user_data;
		$view_data['status'] = array(0 => lang('user.status0'), 1 => lang('user.status1'));
		$view_data['permissions'] = modules::run('permission/get_permissions', $this->session->userdata('user_permission'));
		return $this->load->view($view.'.php', $view_data, true);
	}
	
	function save_session_data($db_result)
	{
		$this->load->library('user_agent');
		$user_data = array(
			'user_id' => $db_result->user_id,
			'user_firstname' => $db_result->user_firstname,
			'user_lastname' => $db_result->user_lastname,
			'user_email' => $db_result->user_email,
			'user_permission' => $db_result->user_permission,
			'browser' => $this->agent->browser(),
			'validated' => true
			);
		$this->session->set_userdata($user_data);
	}
	
	function save_user_activity($db_result)
	{
		$this->load->library('user_agent');
		$activity_data = array(
			'user_id' => $db_result->user_id,
			'ip_address' => $this->session->userdata('ip_address'), 
			'user_agent' => $this->session->userdata('user_agent'), 
			'browser' => $this->agent->browser(), 
			'session_id' => $this->session->userdata('session_id'), 
			'activity_date' => date('Y-m-d H:i:s', $this->session->userdata('last_activity')));
		$this->mdl_user->insert_activity($activity_data);
	}
	
	function process_edituser()
	{
		$this->load->library('encryption');
		$user_id = $this->input->post('user_id');
		$user_data = array(
			'user_firstname' => $this->input->post('user_firstname'), 
			'user_lastname' => $this->input->post('user_lastname'), 
			'user_email' => $this->input->post('user_email'),
			'user_permission' => $this->input->post('user_permission'),
			'user_status' => (int)($this->input->post('user_status'))
		);
		if (trim($this->input->post('user_password')) != '') $user_data['user_password'] = $this->encryption->encrypt_str($this->input->post('user_password'), $this->config->item('app_key'));
		$this->update_user($user_id, $user_data);
	}
	
	function process_newuser()
	{
		$this->load->library('encryption');
		$user_data = array(
			'user_firstname' => $this->input->post('user_firstname'), 
			'user_lastname' => $this->input->post('user_lastname'), 
			'user_email' => $this->input->post('user_email'),
			'user_permission' => $this->input->post('user_permission'),
			'user_status' => (int)($this->input->post('user_status')),
			'user_password' => $this->encryption->encrypt_str($this->input->post('user_password'), $this->config->item('app_key')),
			'user_created' => date('Y-m-d H:i:s')
		);
		$this->add_user($user_data);
	}
	
	function process_profile()
	{
		if ($this->input->post('user_id') == $this->session->userdata('user_id'))
		{
			$user_id = $this->input->post('user_id');
			$user_data = array('user_firstname' => $this->input->post('user_firstname'), 'user_lastname' => $this->input->post('user_lastname'), 'user_email' => $this->input->post('user_email'));
			$this->update_profile($user_id, $user_data);
		}
		else
		{
			$this->session->set_userdata('warning_message', lang('user.error'));
			redirect('user/edituser/'.$this->input->post('user_id'));
		}
	}
	
	function process_password()
	{
		if ($this->input->post('user_id') == $this->session->userdata('user_id'))
		{
			$this->load->library('encryption');
			$user_id = $this->input->post('user_id');
			$user_data = array('user_password' => $this->encryption->encrypt_str($this->input->post('user_newpassword'), $this->config->item('app_key')));
			$this->update_profile($user_id, $user_data);
		}
		else
		{
			$this->session->set_userdata('warning_message', lang('user.error'));
			redirect('user/profile/');
		}
	}
	
	private function add_user($user_data)
	{
		$user_id = $this->mdl_user->insert($user_data);
		$this->session->set_userdata('success_message', lang('user.success'));
		redirect('user/edituser/'.$user_id);
	}
	
	private function update_user($user_id, $user_data)
	{
		$this->mdl_user->update($user_id, $user_data);
		$this->session->set_userdata('success_message', lang('user.success'));
		redirect('user/edituser/'.$user_id);
	}
	
	private function update_profile($user_id, $user_data)
	{
		$this->mdl_user->update($user_id, $user_data);
		$this->session->set_userdata('success_message', lang('user.success'));
		redirect('user');
	}
	
	private function delete_user($user_id)
	{
		
	}
	
	function email_exists($email, $user_id = 0)
	{
		if ($this->input->is_ajax_request())
		{
			if ($this->mdl_user->count_where(array('user_email' => urldecode($email), 'user_id != ' => $user_id))) echo lang('user.exists');
			else echo 0;
		}
	}
	
	function good_password($password, $user_id)
	{
		if ($this->input->is_ajax_request())
		{
			if ($user_id == $this->session->userdata('user_id'))
			{
				$this->load->library('encryption');
				if ($this->mdl_user->count_where(array('user_password' => $this->encryption->encrypt_str($password, $this->config->item('app_key')), 'user_id' => $user_id))) echo 1;
				else echo lang('user.error');
			}
		}
	}
}
