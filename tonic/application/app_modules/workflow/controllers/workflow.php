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
		var_dump($this->lang->languages);
		var_dump($this->get_workflows());
		$view_data['page_title'] = lang('workflow.title');
		$view_data['admin_widgets']['workflows'] = $this->show();
		echo modules::run('template', $view_data);
		
	}
	
	private function show()
	{
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
				$orders = $this->input->post('order');
				$data = array('workflow_name_'.$this->lang->lang() => $value, 'workflow_order' => $orders[$id]);
				$this->update_workflow($id, $data);
			}
		}
		
		foreach ($this->input->post('new') as $new)
		{
			$data = array('workflow_name_'.$this->lang->lang() => $new);
			$this->add_workflow($data);
		}
		
		foreach($this->input->post('delete') as $id => $value)
		{
			$this->delete_workflow($id);
		}
		
		redirect('workflow');
	}
	
	function get_workflows()
	{
		$workflows = array();
		$results = $this->mdl_workflow->get_join()->result();
		foreach($results as $result)
		{
			$workflows[$result->admin_language_code][] = array($result->workflow_id, $result->workflow_order, $result->workflow_name);
		}
		
		return $workflows;
	}
	
	private function add_workflow($data)
	{
		$this->mdl_workflow->insert($data);
	}
	
	private function update_workflow($id, $data)
	{
		$this->mdl_workflow->update($id, $data);
	}
	
	private function delete_workflow($id)
	{
		$this->mdl_workflow->delete($id);
	}
}
