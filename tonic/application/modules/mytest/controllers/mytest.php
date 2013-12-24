<?php

class Mytest extends MX_Controller
{
    
    function __construct()
    {
        parent::__construct();
    }
    
    function index()
    {
		echo 'mytest';
	}
	
	function speak($name)
	{
		echo 'Say : '. $name . '<br />';
	}
    
    
}
