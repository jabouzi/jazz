<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
		$view_data['page_title'] = lang('user.profile');
		$view_data['admin_widgets']['user'] = $this->show('profile');
		echo modules::run('template', $view_data);
	}
	
	function users()
	{
		$this->load->model('mdl_user');
		$user_profile = $this->mdl_user->get_where($id);
	}
	
	function newuser()
	{
		
	}
	
	function show($view)
	{
		return $this->load->view($view.'.php', true);
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
		$this->load->model('mdl_user');
		$activity_data = array(
			'user_id' => $db_result->user_id,
			'ip_address' => $this->session->userdata('ip_address'), 
			'user_agent' => $this->session->userdata('user_agent'), 
			'browser' => $this->agent->browser(), 
			'session_id' => $this->session->userdata('session_id'), 
			'activity_date' => date('Y-m-d H:i:s', $this->session->userdata('last_activity')));
		$this->mdl_user->insert_activity($activity_data);
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
