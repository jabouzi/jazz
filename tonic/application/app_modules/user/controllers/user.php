<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
		$this->load->library('user_agent');
		$query = $this->db->get('ci_sessions');

		$user = array(); /* array to store the user data we fetch */

		foreach ($query->result() as $row)
		{
			$user_data = unserialize($row->user_data);
			if ($user_data['user_email'] == $this->session->userdata('user_email'))
			{
			/* put data in array using username as key */
				$user_sessions[] = array($row->ip_address, $row->user_agent); 
				var_dump(date('Y-m-d H:i:s', $row->last_activity));
			}
		}
		var_dump($user_sessions, $this->agent->browser(), $this->session->userdata('session_id'), $this->session->userdata('ip_address'));
		$this->show();
	}
	
	function users()
	{
		
	}
	
	function newuser()
	{
		
	}
	
	function show()
	{
		
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
			'session_id' => $this->session->userdata('ip_address'), 
			'activity_date' => date('Y-m-d H:i:s', $this->session->userdata('last_activity')));
		var_dump($activity_data);
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
