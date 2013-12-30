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
		$workflows =array();
		$this->load->model('mdl_workflow');
		$results = $this->mdl_workflow->get('workflow_id');
		foreach($results->result() as $workflow)
		{
			$workflows[$workflow->workflow_id] = $workflow->workflow_name;
		}
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
}
