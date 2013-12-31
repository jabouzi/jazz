<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
