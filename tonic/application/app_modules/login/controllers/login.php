<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
    }
    
    function index($logout = null)
    {
        $this->load->model('mdl_login');
        $this->load->helper('cookie');
        $this->islogout();
        exit;
        if ($this->session->userdata('user_email'))
        {
            redirect('dashboard');
        }
        else
        {
            $this->autologin();
        }
    }
    
    function show($message = null)
    {
        $this->load->helper('cookie');
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
        $view_data['checked'] = true;
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
            $this->show('login.failed');
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
            $cookie = $this->getcookie();
            if ($cookie)
            {
                $username = $cookie[0];
                $old_hash = $cookie[1];
                $this->deletecookie($username, $old_hash);
            }
            
            $remember_me = $this->input->post('remember_me');
            if ($remember_me)
            {
                $hash = $this->encryption->generateRandomString(26);
                $this->setcookie($username, $hash);
            }
            redirect('dashboard');
        }        
    }
    
    function autologin()
    {
        $this->load->helper('cookie');
        $this->load->library('encryption');
        $this->load->model('mdl_login');
        $result = false;
        $cookie = $this->getcookie();
        if ($cookie)
        {
            $username = $cookie[0];
            $old_hash = $cookie[1];
            $result = $this->mdl_login->validate_cookie($username, $old_hash);
        }
        
        if(!$result)
        {
            $this->show();
        }
        else
        {    
            $hash = $this->encryption->generateRandomString(26);
            $result = $this->mdl_login->get_where_custom('tonic_users', 'user_email', $username)->row();
            $user_data = array(
                'user_id' => $result->user_id,
                'user_firstname' => $result->user_firstname,
                'user_lastname' => $result->user_lastname,
                'user_email' => $result->user_email,
                'validated' => true
                );
            $this->session->set_userdata($user_data);
            $this->deletecookie($username, $old_hash);
            $this->setcookie($username, $hash);
            redirect('dashboard');
        }
    }

    function logout()
    {
        $cookie = $this->getcookie();
        if ($cookie)
        {
            $hash = $cookie[1];
            $cookie_data = array('cookie_user_status' => "b'0'");
            $result = $this->mdl_login->update_cookie($hash, $cookie_data);
        }
        $this->session->sess_destroy();
        $this->show();
    }
    
    function islogout()
    {
        $cookie = $this->getcookie();
        if ($cookie)
        {
            $hash = $cookie[1];
            $result = $this->mdl_login->get_where_custom('tonic_cookies', 'cookie_hash', $hash)->row();
            var_dump($result);
            var_dump(ord($result->cookie_user_status));
        }
        
        return false;
    }
    
    function getcookie()
    {
        $cookie = get_cookie('tonic_cms');

        if ($cookie)
        {
            $cookie_data = explode('||',$cookie);
            return $cookie_data;
        }
        
        return false;
    }
    
    function setcookie($value, $hash)
    {
        $cookie = array(
            'name'   => 'tonic_cms',
            'value'  => $value.'||'.$hash,
            'expire' => 31536000,
            'domain' => '.'.$_SERVER['HTTP_HOST'],
            'path'   => '/',
        );
        
        set_cookie($cookie);
        $this->mdl_login->insert_cookie(array('cookie_email' => $value, 'cookie_hash' => $hash, 'cookie_user_status' => b'1'));
    }

    function deletecookie($value, $hash)
    {
        $cookie = array(
            'name'   => 'tonic_cms',
            'value'  => $value.'||'.$hash,
            'domain' => '.'.$_SERVER['HTTP_HOST'],
            'path'   => '/',
        );

        delete_cookie($cookie['name'], $cookie['domain'], $cookie['path']);
        $this->mdl_login->delete_cookie($hash);
    }
}
