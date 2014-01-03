<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends MX_Controller
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
		return $this->load->view('category', $view_data, true);
	}
	
	function preview()
	{
		$view_data = array();
		return $this->load->view('category_preview', $view_data, true);
	}
}
