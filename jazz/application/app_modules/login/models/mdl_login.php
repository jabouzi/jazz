<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_login extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function validate_user($username, $password)
	{
		$this->db->where('user_email', $username);
		$this->db->where('user_password', $password);
		
		$query = $this->db->get('jazz_users');
		if($query->num_rows == 1)
		{
			$row = $query->row();			
			return $row;
		}

		return false;
	}
	
	function validate_cookie($username, $hash)
	{
		$this->db->where('cookie_email', $username);
		$this->db->where('cookie_hash', $hash);
		
		$query = $this->db->get('jazz_cookies');
		if($query->num_rows == 1)
		{
			$row = $query->row();			
			return $row;
		}

		return false;
	}
	
	function insert_cookie($data)
	{
		$this->db->insert('jazz_cookies', $data);
	}
	
	function delete_cookie($hash)
	{
		$this->db->where('cookie_hash', $hash);
		$this->db->delete('jazz_cookies');
	}
	
	function get_where_custom($table, $col, $value)
	{
		$this->db->where($col, $value);
		$query = $this->db->get($table);
		if($query->num_rows) return $query;
		
		return false;
	}
	
	function custom_query($mysql_query)
	{
		$query = $this->db->query($mysql_query);
		return $query;
	}
}
