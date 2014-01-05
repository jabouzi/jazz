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
		$view_data['page_title'] = lang('workflow.title');
		$view_data['admin_widgets']['workflows'] = $this->show();
		echo modules::run('template', $view_data);
		
	}
	
	private function show()
	{
		$view_data['admin_languages'] = $this->lang->languages;
		$view_data['workflows'] = $this->get_workflows();
		return $this->load->view('workflow', $view_data, true);
	}
	
	function process()
	{
		foreach($this->input->post('workflow_name') as $lang => $workflows)
		{
			foreach($workflows as $id => $workflow)
			{
				$workflow = trim($workflow);
				if ($workflow != '')
				{
					$data = array('workflow_name' => $workflow);
					$where = array('workflow_id = ' => $id, 'admin_language_code = ' => $lang);
					$this->update_workflow('tonic_workflows_i18n', $where, $data);
				}
			}
		}
		
		foreach ($this->input->post('order') as $id => $order)
		{
			$data = array('workflow_order' => $order);
			$where = array('workflow_id = '.$id);
			$this->update_workflow('tonic_workflows', $where, $data);
		}
		
		foreach ($this->input->post('new') as $new)
		{
			
			$data = array('workflow_name' => $new);
			$workflow_id = $this->add_workflow('tonic_workflows', $data);
			foreach($this->lang->languages as $code => $lang)
			{
				$data = array('workflow_name' => $new, 'admin_language_code' => $code, 'workflow_id' => $workflow_id);
				$this->add_workflow('tonic_workflows_i18n', $data);
			}
		}
		
		foreach($this->input->post('delete') as $id => $value)
		{
			$this->delete_workflow('tonic_workflows', $id);
			$this->delete_workflow('tonic_workflows_i18n', $id);
		}
		
		redirect('workflow');
	}
	
	function get_workflows()
	{
		$workflows = array();
		$results = $this->mdl_workflow->get_join()->result();
		foreach($results as $result)
		{
			$workflows[$result->admin_language_code][] = array('id' => $result->workflow_id, 'order' => $result->workflow_order, 'name' => $result->workflow_name);
		}

		return $workflows;
	}
	
	private function add_workflow($table, $data)
	{
		$this->mdl_workflow->insert($table, $data);
	}
	
	private function update_workflow($table, $id, $data)
	{
		$this->mdl_workflow->update($table, $id, $data);
	}
	
	private function delete_workflow($table, $id)
	{
		$this->mdl_workflow->delete($table, $id);
	}
}
