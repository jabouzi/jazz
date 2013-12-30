<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Workflow extends MX_Controller
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
		$this->load->model('mdl_workflow');
		$workflows = $this->mdl_workflow->get('worflow_id');
		var_dump($workflows);
	}
	
	function add_workflow($data)
	{
		
	}
	
	function update_workflow($id)
	{
		
	}
	
	function delete_workflow($id)
	{
		
	}
