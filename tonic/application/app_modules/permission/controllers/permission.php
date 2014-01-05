<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Permission extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('mdl_permission');
		$this->load->library('configs');
	}
	
	function index()
	{
		$view_data['page_title'] = lang('permission.title');
		$view_data['admin_widgets']['permissions'] = $this->show();
		echo modules::run('template', $view_data);
	}
	
	private function show()
	{
		$this->load->helper('form');
		$view_data['admin_languages'] = $this->lang->languages;
		$view_data['permissions'] = $this->get_permissions();
		$view_data['actions'] = $this->get_permission_actions_list();
		$view_data['attributes'] = "class='permissions-multi-select'";

		return $this->load->view('permission', $view_data, true);
	}
	
	//function process()
	//{
		//var_dump($this->input->post()); exit;
		//foreach($this->input->post() as $id => $value)
		//{
			//if (is_numeric($id))
			//{
				//$actions = $this->input->post('actions');
				//$data = array('permission_name_'.$this->lang->lang() => $value, 'permission_actions' => serialize($actions[$id]));
				//$this->update_permission($id, $data);
			//}
		//}
		//
		//foreach ($this->input->post('new') as $new)
		//{
			//$data = array('permission_name_'.$this->lang->lang() => $new);
			//$this->add_permission($data);
		//}
		//
		//foreach($this->input->post('delete') as $id => $value)
		//{
			//$this->delete_permission($id);
		//}
		//
		//redirect('permission');
	//}
	
	function process()
	{
		foreach($this->input->post('permission_name') as $lang => $permissions)
		{
			foreach($permissions as $id => $permission)
			{
				$permission = trim(ucfirst(strtolower($permission)));
				if ($permission != '')
				{
					$data = array('permission_name' => $permission);
					$where = array('permission_id = ' => $id, 'admin_language_code = ' => $lang);
					$this->update_permission('tonic_permissions_i18n', $where, $data);
				}
			}
		}
		
		foreach ($this->input->post('actions') as $id => $order)
		{
			$data = array('permission_actions' => serialize($order));
			$where = array('permission_id = ' => $id);
			$this->update_permission('tonic_permissions', $where, $data);
		}

		foreach ($this->input->post('new') as $permission)
		{
			$permission = trim(ucfirst(strtolower($permission)));
			if ($permission != '')
			{
				$data = array('permission_actions' => '');
				$this->add_permission('tonic_permissions', $data);
				$permission_id = $this->get_last_permission_id();
				foreach($this->lang->languages as $code => $lang)
				{
					$data = array('admin_language_code' => $code, 'permission_id' => $permission_id);
					$data['permission_name'] = '';
					if ($code == $this->input->post('active_lang')) $data['permission_name'] = $permission;
					$this->add_permission('tonic_permissions_i18n', $data);
				}
			}
		}
		
		foreach($this->input->post('delete') as $id => $value)
		{
			$this->delete_workflow('tonic_workflows', $id);
			$this->delete_workflow('tonic_workflows_i18n', $id);
		}
		
		redirect('workflow');
	}
	
	function get_permissions()
	{
		$permissions = array();
		$results = $this->mdl_permission->get_join()->result();
		foreach($results as $permission)
		{
			$permissions[$permission->admin_language_code][] = array('id' => $permission->permission_id, 'name' => $permission->permission_name, 'actions' => unserialize($permission->permission_actions));
		}
		
		return $permissions;
	}
	
	function add_permission($data)
	{
		$this->mdl_permission->insert($data);
	}
	
	function update_permission($id, $data)
	{
		$this->mdl_permission->update($id, $data);
	}
	
	function delete_permission($id)
	{
		$this->mdl_permission->delete($id);
	}
	
	private function get_permission_actions_list()
	{
		$permissions = array();
		$modules_list = $this->configs->get_modules_list();
		foreach($modules_list as $module)
		{
			$permissions = array_merge($permissions, $this->configs->get_module_config($module, 'permissions'));
		}
		
		foreach($permissions as $key => $permission)
		{
			$permissions[$permission] = lang($permission);
			unset($permissions[$key]);
		}
		
		return $permissions;
	}
	
	private function get_last_permission_id()
	{
		return $this->mdl_permission->get_max();
	}
}
