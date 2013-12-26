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
    
    function insert_cookie($data)
    {
        $this->db->insert('tonic_cookies', $data);
    }
    
    function delete_cookie($hash)
    {
        $this->db->where('cookie_hash', $hash);
        $this->db->delete('tonic_cookies');
    }
    
    function update_cookie($hash, $data)
    {
        $this->db->where('cookie_hash', $hash);
        var_dump($this->db->update('tonic_cookies', $data));
    }
    
    function get_where_custom($table, $col, $value)
    {
        $this->db->where($col, $value);
        $query = $this->db->get($table);
        return $query;
    }
}
