<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Analytic extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
		//http://api.clicky.com/api/stats/4?site_id=100538749&sitekey=b5eed07e1c2cff89&type=visitors,actions,actions-average,time-average,time-total,bounce-rate,countries,links,searches&date=yesterday&output=json
		$this->show();
	}
	
	function show()
	{
		$view_data = array();
		return $this->load->view('analytic', $view_data, true);
	}
}
