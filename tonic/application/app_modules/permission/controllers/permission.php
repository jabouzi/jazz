<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Permission extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('mdl_permission');
	}
	
	function index()
	{
		$this->lang->load('dashboard');
		$view_data['page_title'] = lang('permission.title');
		$view_data['admin_widgets']['permissions'] = $this->show();
		echo modules::run('template', $view_data);
		
	}
	
	private function show()
	{
		$this->lang->load('dashboard');
		$results = $this->mdl_permission->get('permission_id');
		foreach($results->result() as $permission)
		{
			$view_data['permissions'][$permission->permission_id] = array('name' => $permission->{'permission_name_'.$this->lang->lang()}, 'actions' => explode('|',$permission->permission_actions));
			$view_data['actions'] = $this->get_permission_actions_list();
		}
		return $this->load->view('permission', $view_data, true);
	}
	
	function process()
	{
		foreach($this->input->post() as $id => $value)
		{
			if (is_numeric($id))
			{
				$this->update_permission($id, $value);
			}
		}
		
		foreach ($this->input->post('new') as $new)
		{
			$this->add_permission($new);
		}
		
		foreach($this->input->post('delete') as $id => $value)
		{
			$this->delete_permission($id);
		}
		
		redirect('permission');
	}
	
	function add_permission($new_data)
	{
		$data = array('permission_name_'.$this->lang->lang() => $new_data);
		$this->mdl_permission->insert($data);
	}
	
	function update_permission($id, $update_data)
	{
		$data = array('permission_name_'.$this->lang->lang() => $update_data);
		$this->mdl_permission->update($id, $data);
	}
	
	function delete_permission($id)
	{
		$this->mdl_permission->delete($id);
	}
	
	private function get_permission_actions_list()
	{
		$actions = array();
		$actions['create'] = lang('permission.create');
		$actions['delete'] = lang('permission.delete');
		$actions['update'] = lang('permission.update');
		$actions['view'] = lang('permission.view');
		$actions['publish'] = lang('permission.publish');
		$actions['archive']  = lang('permission.archive');
		
		return $actions;
	}
}
