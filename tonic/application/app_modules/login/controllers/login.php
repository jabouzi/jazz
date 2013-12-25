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
        $username = $this->security->xss_clean($this->input->post('email'));
        $password = $this->encryption->getEncrypt($this->security->xss_clean($this->input->post('password')), 'clétonic');
        $result = $this->mdl_login->validate($username, $password);
        if(!$result){
            $this->index('login.failed');
        }else{
            //redirect('home');
            //echo 'Login success';
            $remember_me = $this->input->post('remember_me');
            if ($remember_me)
            {
                $cookie = array(
                    'name'   => 'tonic_cms',
                    'value'  => '1',
                    'expire' => '86500',
                    'domain' => '.'.$_SERVER['HTTP_HOST'],
                    'path'   => '/',
                    'prefix' => 'tonic_',
                    'secure' => TRUE
                );
                var_dump($cookie);
                var_dump($this->input->set_cookie($cookie));
                var_dump($this->input->cookie('tonic_cms', TRUE));
            }
            //var_dump($this->session->userdata('user_email'));
            //var_dump($this->session->all_userdata());
        }        
    }
    
    function logout(){
        $this->session->sess_destroy();
        redirect('login');
    }
}
