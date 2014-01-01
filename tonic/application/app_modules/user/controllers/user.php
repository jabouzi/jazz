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
		$users = $this->mdl_user->get();
		$view_data['admin_widgets']['user'] = $this->show('users', $users);
		echo modules::run('template', $view_data);
	}
	
	function newuser()
	{
		$view_data['page_title'] = lang('user.new');
		$view_data['admin_widgets']['user'] = $this->show('newuser');
		echo modules::run('template', $view_data);
	}
	
	function edituser($id)
	{
		$view_data['page_title'] = lang('user.edit');
		$user_profile = $this->mdl_user->get_where($this->session->userdata('user_id'));
		$view_data['admin_widgets']['user'] = $this->show('profile', $id);
		$view_data['admin_widgets']['user'] = $this->show('edituser', $user_profile->row());
		echo modules::run('template', $view_data);
	}
	
	function show($view, $user_data)
	{
		$view_data['user'] = $user_data;
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
	
	function process_profile()
	{
		
	}
	
	function process_password()
	{
		
	}
	
	function add_user($data)
	{
		
	}
	
	function update_user($id)
	{
		
	}
	
	function delete_user($id)
	{
		
	}
}
