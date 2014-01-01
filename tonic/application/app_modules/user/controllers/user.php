<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
		$query = $this->db->get('ci_sessions');

		$user = array(); /* array to store the user data we fetch */

		foreach ($query->result() as $row)
		{
			$user_data = unserialize($row->user_data);
			if ($user_data['user_email'] == $this->session->userdata('user_email'))
			{
			/* put data in array using username as key */
				$user_sessions[$user_data['user_name']][] = array($row->ip_address, $row->user_agent); 
			}
		}
		var_dump($user_sessions);
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
