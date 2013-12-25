<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
    }
    
    function index()
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
        $this->load->view('login', $view_data);
    }
    
    function process()
    {
        $this->load->library('encryption');
        $str = $this->encryption->getEncrypt('$sj7024043$', 'clétonic');
        echo $str;
        echo $this->encryption->getDecrypt($str, 'clétonic');
    }
}
