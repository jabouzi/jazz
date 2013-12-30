<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Workflow extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
		$this->lang->load('dashboard');
		$view_data['page_title'] = lang('workflow.title');
		$view_data['admin_widgets']['workflows'] = $this->show();
		echo modules::run('template', $view_data);
		
	}
	
	private function show()
	{
		$this->lang->load('dashboard');
		$this->load->model('mdl_workflow');
		$results = $this->mdl_workflow->get('workflow_id');
		foreach($results->result() as $workflow)
		{
			$view_data['workflows'][$workflow->workflow_id] = $workflow->workflow_name;
		}
		return $this->load->view('workflow', $view_data, true);
	}
	
	function process()
	{
		var_dump($this->input->post());
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
