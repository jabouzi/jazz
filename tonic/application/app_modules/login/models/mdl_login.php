<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_login extends CI_Model
{
    
    function __construct()
    {
        parent::__construct();
    }
    
    function get_table()
    {
        $table = "tonic_users";
        return $table;
    }
    
    public function validate($username, $password)
    {
        $this->db->where('email', $username);
        $this->db->where('password', $password);
        
        $query = $this->db->get($this->get_table());
        if($query->num_rows == 1)
        {
            $row = $query->row();
            $user_data = array(
                    'user_id' => $row->user_id,
                    'user_firstname' => $row->user_firstname,
                    'user_lastname' => $row->user_lastname,
                    'user_email' => $row->user_email,
                    'validated' => true
                    );
            $this->session->set_userdata($user_data);
            return true;
        }

        return false;
    }
}
