<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template extends MX_Controller
{
    
    function __construct()
    {
        parent::__construct();
    }
    
    function index($view_data = array())
    {
        $this->load->view('template', $view_data);
    }
    
}
