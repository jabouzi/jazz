<?php

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

class Apptest extends MX_Controller
{
    
    function __construct()
    {
        parent::__construct();
    }
    
    function print_test()
    {
        echo 'THIS IS A PRINT TEST';
        echo '<br />';
    }
    
    function print_other()
    {
        $this->load->module('mytest');
        $this->mytest->speak('Skander');
        $param = 'skander';
        Modules::run('mytest/speak', $param); 
    }
    
    
}
