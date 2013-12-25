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
            $view_data['languages'][$key] = lang($value);
        }
        $view_data['lang'] = $this->lang->lang(); 
        echo anchor(site_url().$this->lang->switch_uri('en'),'Login');
        $this->load->view('login', $view_data);
    }    
}
