<?php

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
        //$param = 'skander';
        //modules::run('mytest/speak', $param); 
    }
    
    
}
