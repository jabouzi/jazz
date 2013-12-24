<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Apptest extends MX_Controller
{
    
    function __construct()
    {
        parent::__construct();
    }
    
    function print_test()
    {
        $view_data['text'] = 'THIS IS A PRINT TEST<br />';
        $this->load->view('apptest', $view_data);

    }
    
    function print_other()
    {
        $this->load->module('mytest')->speak('Skander');
        //$this->mytest->speak('Skander');

    }
    
    
}
