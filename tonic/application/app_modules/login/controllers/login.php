<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
	}
	
	function index($logout = null)
	{
		$this->islogin();
		
		if ($this->islogout())
		{
			$this->show();
		}
		else
		{ 
			$this->autologin();
		}
	}
	
	function show($message = null)
	{
		$this ->islogin();
		
		$this->load->helper('form');
		$this->load->helper('cookie');
		foreach($this->lang->languages as $key => $value)
		{
			$view_data['languages'][site_url().$this->lang->switch_uri($key)] = lang($value);
		}
		$view_data['lang'] = site_url().$this->lang->switch_uri($this->lang->lang());
		$view_data['redirect'] = 'onChange="window.document.location.href=this.options[this.selectedIndex].value;"';
		$view_data['message'] = $message;
		$view_data['checked'] = '';
		if ($this->getcookie()) $view_data['checked'] = 'checked';
		$this->load->view('login', $view_data);
	}
	
	function process()
	{
		$this->islogin();

		$this->load->helper('tonic_string');
		$this->load->library('encryption');
		$this->load->model('mdl_login');
		$username = $this->security->xss_clean($this->input->post('email'));
		$password = $this->encryption->encrypt_str($this->security->xss_clean($this->input->post('password')), $this->config->item('app_key'));
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
				$hash = generate_random_string(26);
				$this->setcookie($username, $hash);
			}
			redirect('dashboard');
		}
	}
	
	function autologin()
	{
		$this->load->helper('tonic_string');
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
			$hash = generate_random_string(26);
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
		$this->load->model('mdl_login');
		$cookie = $this->getcookie();
		if ($cookie)
		{
			$hash = $this->db->escape($cookie[1]);
			$query = "UPDATE tonic_cookies SET cookie_user_status = b'1' WHERE cookie_hash = {$hash}";
			$result = $this->mdl_login->custom_query($query);
		}
		$this->session->sess_destroy();
		redirect('login');
	}
	
	function islogin()
	{
		if ($this->session->userdata('user_email'))
		{
			redirect('dashboard');
		}
	}
	
	function islogout()
	{
		$this->load->model('mdl_login');
		$cookie = $this->getcookie();
		if ($cookie)
		{
			$hash = $cookie[1];
			$result = $this->mdl_login->get_where_custom('tonic_cookies', 'cookie_hash', $hash)->row();
			return ord($result->cookie_user_status);
		}
		
		return false;
	}
	
	private function getcookie()
	{		
		$this->load->helper('cookie');
		$cookie = get_cookie('tonic_cms');

		if ($cookie)
		{
			$cookie_data = explode('||',$cookie);
			return $cookie_data;
		}
		
		return false;
	}
	
	private function setcookie($value, $hash)
	{
		$this->load->helper('cookie');
		$cookie = array(
			'name'   => 'tonic_cms',
			'value'  => $value.'||'.$hash,
			'expire' => 31536000,
			'domain' => '.'.$_SERVER['HTTP_HOST'],
			'path'   => '/',
		);
		
		set_cookie($cookie);
		$this->mdl_login->insert_cookie(array('cookie_email' => $value, 'cookie_hash' => $hash));
	}

	private function deletecookie($value, $hash)
	{
		$this->load->helper('cookie');
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
