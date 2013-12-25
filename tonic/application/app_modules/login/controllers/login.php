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
        var_dump($lang);
        $view_data['languages'] = $this->lang->languages;
        $view_data['lang'] = $lang;
        $this->load->view('login', $view_data);
    }
    
}
