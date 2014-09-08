<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Analytic extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
		$this->show();
	}
	
	function show()
	{
		$view_data = array();
		return $this->load->view('analytic', $view_data, true);
	}
}
