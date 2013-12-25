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
        
        $query = $this->db->get('tonic_users');
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
        
        $query = $this->db->get('tonic_cookies');
        if($query->num_rows == 1)
        {
            $row = $query->row();            
            return $row;
        }

        return false;
    }
    
    function get_where_custom($table, $col, $value)
    {
        $this->db->where($col, $value);
        $query = $this->db->get($table);
        return $query;
    }
    
    function insert_cookie($table, $data)
    {
        $this->db->insert($table, $data);
    }
    
    function update_cookie($table, $id, $data)
    {
        $this->db->where('cookie_id', $id);
        $this->db->update($table, $data);
    }
    
    function delete_cookie($table, $id)
    {
        $this->db->where('cookie_id', $id);
        $this->db->delete($table);
    }
}
