<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
    }
    
    function index($message = null)
    {
        $this->load->helper('language');
        $this->load->helper('form');
        $this->lang->load('login');
        $this->lang->load('lang');
        foreach($this->lang->languages as $key => $value)
        {
            $view_data['languages'][site_url().$this->lang->switch_uri($key)] = lang($value);
        }
        $view_data['lang'] = site_url().$this->lang->switch_uri($this->lang->lang());
        $view_data['redirect'] = 'onChange="window.document.location.href=this.options[this.selectedIndex].value;"';
        $view_data['message'] = $message;
        $this->load->view('login', $view_data);
    }
    
    function process()
    {
        $this->load->library('encryption');
        $this->load->model('mdl_login');
        $this->load->helper('cookie');
        $username = $this->security->xss_clean($this->input->post('email'));
        $password = $this->encryption->getEncrypt($this->security->xss_clean($this->input->post('password')), 'clétonic');
        $result = $this->mdl_login->validate_user($username, $password);
        if(!$result)
        {
            $this->index('login.failed');
        }
        else
        {            
            $user_data = array(
                'user_id' => $result->user_id,
                'user_firstname' => $result->user_firstname,
                'user_lastname' => $result->user_lastname,
                'user_email' => $result->user_email,
                'validated' => true
                );
            $this->session->set_userdata($user_data);

            $remember_me = $this->input->post('remember_me');
            if ($remember_me)
            {
                $hash = $this->encryption->generateRandomString(26);
                $this->delete_cookie('tonic_cms');
                $this->set_cookie($username.'||'.$hash);
                $this->mdl_login->insert('tonic_cookies', array('cookie_email' => $username, 'cookie_hash' => $hash));
            }
            redirect('dashboard');
            //var_dump($this->session->userdata('user_email'));
            //var_dump($this->session->all_userdata());
        }        
    }
    
    function autologin()
    {
        $this->load->library('encryption');
        $this->load->model('mdl_login');
        $cookie = explode('||',$this->get_cookie());
        $username = $cookie[0];
        $hash = $cookie[1];
        $result = $this->mdl_login->validate_cookie($username, $hash);
        if(!$result)
        {
            redirect('login');
        }
        else
        {    
            $hash = $this->encryption->generateRandomString(26);
            $this->mdl_login->delete('tonic_cookies', $result->cookie_id);
            $this->mdl_login->insert('tonic_cookies', array('cookie_email' => $username, 'cookie_hash' => $hash));
            $result = $this->mdl_login->get_where_custom('user_email', $username, 'tonic_users')->row();
            $user_data = array(
                'user_id' => $result->user_id,
                'user_firstname' => $result->user_firstname,
                'user_lastname' => $result->user_lastname,
                'user_email' => $result->user_email,
                'validated' => true
                );
            $this->session->set_userdata($user_data);            
            $this->delete_cookie($cookie['value']);
            $this->set_cookie($username.'||'.$hash);
            redirect('dashboard');
        }
    }

    function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
    
    function set_cookie($value)
    {
        $cookie = array(
            'name'   => 'tonic_cms',
            'value'  => $value,
            'expire' => (time() + 31536000),
            'domain' => $_SERVER['HTTP_HOST'],
            'path'   => '/',
        );
        set_cookie($cookie);
    }
    
    function get_cookie()
    {
        return get_cookie('tonic_cms');
    }
    
    function delete_cookie($value)
    {
        $cookie = array(
            'name'   => 'tonic_cms',
            'value'  => $value,
            'expire' => (time() - 60000),
            'domain' => $_SERVER['HTTP_HOST'],
            'path'   => '/',
        );
        delete_cookie('tonic_cms');
    }
}
