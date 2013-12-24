<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Apptest extends MX_Controller
{
    
    function __construct()
    {
        parent::__construct();
    }
    
    function print_test()
    {
        //$view_data['text'] = 'THIS IS A PRINT TEST<br />';
        //$this->load->view('apptest', $view_data);
        $view_data['page_title'] = 'App test';
        echo modules::run('template');

    }
    
    function print_other()
    {
        $view_data['module'] = 'apptest';
        $view_data['view_file'] = 'apptest';
        $this->load->module('mytest')->speak('Skander');

    }
    
    
}
