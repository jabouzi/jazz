<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Workflow extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
		$view_data['admin_workflow'] = $this->show();
		echo modules::run('template', $view_data);
		
	}
	
	private function show()
	{
		$view_data = array();
		$this->load->model('mdl_workflow');
		$results = $this->mdl_workflow->get('workflow_id');
		foreach($results->result() as $workflow)
		{
			$view_data['workflows'][$workflow->workflow_id] = $workflow->workflow_name;
		}
		$this->load->view('workflow', $view_data);
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
