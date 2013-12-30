<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Workflow extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('mdl_workflow');
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
		$results = $this->mdl_workflow->get('workflow_id');
		foreach($results->result() as $workflow)
		{
			$view_data['workflows'][$workflow->workflow_id] = array('name' => $workflow->{'workflow_name_'.$this->lang->lang()}, 'order' => $workflow->workflow_order);
		}
		return $this->load->view('workflow', $view_data, true);
	}
	
	function process()
	{
		foreach($this->input->post() as $id => $value)
		{
			if (is_numeric($id))
			{
				$this->update_workflow($id, $value);
			}
		}
		
		foreach ($this->input->post('new') as $new)
		{
			$this->add_workflow($new);
		}
		
		foreach($this->input->post('delete') as $id => $value)
		{
			$this->delete_workflow($id);
		}
		
		redirect('workflow');
	}
	
	function add_workflow($new_data)
	{
		$data = array('workflow_name_'.$this->lang->lang() => $new_data);
		$this->mdl_workflow->insert($data);
	}
	
	function update_workflow($id, $update_data)
	{
		$data = array('workflow_name_'.$this->lang->lang() => $update_data);
		$this->mdl_workflow->update($id, $data);
	}
	
	function delete_workflow($id)
	{
		$this->mdl_workflow->delete($id);
	}
}
