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
		$this->get_permission_actions_list();
		$view_data['page_title'] = lang('permission.title');
		$view_data['admin_widgets']['permissions'] = $this->show();
		echo modules::run('template', $view_data);
		
	}
	
	private function show()
	{
		$this->load->helper('form');
		$results = $this->mdl_permission->get_where(1);
		foreach($results->result() as $permission)
		{
			$view_data['permissions'][$permission->permission_id] = array('name' => $permission->{'permission_name_'.$this->lang->lang()}, 'actions' => explode('|',$permission->permission_actions));
			//$view_data['actions'] = $this->get_permission_actions_list();
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
		var_dump($this->configs->get_modules_list());
		//$this->load->helper('directory');
		//$this->load->helper('file');
		//$modules_paths = array_keys($this->config->item('modules_locations'));
		//$allmodules = array();
		//foreach($modules_paths as $key => $path)
		//{
			//$allmodules[$path] = array_diff(directory_map($path, 1), ['index.html']);
		//}
		//
		//$list = array();
		//foreach($allmodules as $modules)
		//{
			//$list = array_merge($list, $modules);
		//}
		//
		//var_dump($list);
				
		//foreach($allmodules as $path => $modules)
		//{
			//foreach($modules as $module)
			//{
				//$module_config[$module] = json_decode(read_file($path.$module.'/config.json'));
			//}			
		//}
		//var_dump($modules_paths);
		//var_dump($modules);
		//var_dump($module_config);
		//
		//
		//return $actions;
	}
}
