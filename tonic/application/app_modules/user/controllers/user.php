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
		$this->session->unset_userdata('success_message');
	}
	
	function users()
	{
		$view_data['page_title'] = lang('user.users');
		$users = $this->mdl_user->get_where_custom('user_permission > ', $this->session->userdata('user_permission'));
		$view_data['admin_widgets']['user'] = $this->show('users', $users);
		echo modules::run('template', $view_data);
	}
	
	function newuser()
	{
		$view_data['page_title'] = lang('user.new');
		$view_data['admin_widgets']['user'] = $this->show('newuser', array());
		echo modules::run('template', $view_data);
	}
	
	function edituser($id, $save = null)
	{
		$view_data['page_title'] = lang('user.edit');
		$user_profile = $this->mdl_user->get_where($id);
		$view_data['admin_widgets']['user'] = $this->show('edituser', $user_profile->row());
		echo modules::run('template', $view_data);
	}
	
	private function show($view, $user_data, $message = null)
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
		var_dump($this->input->post());exit;
		$user_id = $this->input->post('user_id');
		$user_data = array('user_firstname' => $this->input->post('user_firstname'), 'user_lastname' => $this->input->post('user_lastname'), 'user_email' => $this->input->post('user_email'));
		$this->update_user($user_id, $user_data);
	}
	
	function process_newuser()
	{
		var_dump($this->input->post());
	}
	
	function process_profile()
	{
		$user_id = $this->input->post('user_id');
		$user_data = array('user_firstname' => $this->input->post('user_firstname'), 'user_lastname' => $this->input->post('user_lastname'), 'user_email' => $this->input->post('user_email'));
		$this->update_user($user_id, $user_data);
	}
	
	function process_password()
	{
		var_dump($this->input->post());
	}
	
	function add_user($user_data)
	{
		$this->mdl_user->insert($user_data);
	}
	
	function update_user($user_id, $user_data)
	{
		$this->mdl_user->update($user_id, $user_data);
		$this->session->set_userdata('success_message', lang('user.success'));
		redirect('user');
	}
	
	function delete_user($user_id)
	{
		
	}
}
