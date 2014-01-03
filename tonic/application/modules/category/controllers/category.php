<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('mdl_category');
	}
	
	function index()
	{
		echo lang('categroy.title');
		$view_data['page_title'] = lang('categroy.title');
		$view_data['admin_widgets']['categories'] = $this->show();
		echo modules::run('template', $view_data);
	}
	
	private function show()
	{
		$this->load->helper('form');
		$results = $this->mdl_category->get();
		$view_data['categories'] = $results;
		return $this->load->view('category', $view_data, true);
	}
}
