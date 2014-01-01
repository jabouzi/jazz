<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
		$query = $this->db->select('user_data')->get('ci_sessions');

		$user = array(); /* array to store the user data we fetch */

		foreach ($query->result() as $row)
		{
			$udata = unserialize($row->user_data);

			/* put data in array using username as key */
			$user[$udata['user_name']][] = $udata['user_role']; 
			var_dump($user);
		}
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
