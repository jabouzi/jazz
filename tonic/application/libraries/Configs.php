<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Configs
{
	private $api;
	private $modules_list;
	
	function __construct()
	{
		$this->api = & get_instance();
		$this->api->load->helper('directory');
		$this->api->load->helper('file');
		$this->api->load->helper('array');
		$modules_list = $this->_get_modules();
	}
	
	function get_modules_list()
	{
		$allmodules = array();
		foreach($modules_list as $modules)
		{
			$allmodules = array_merge($allmodules, $modules);
		}
		
		return $allmodules;
	}
	
	function get_module_configs($module)
	{
		return element($this->_get_modules_configs(), $module);
	}
	
	function get_module_config($module, $config)
	{
		return element($config, $this->get_module_configs($module));
	}

	function _get_modules()
	{
		$modules_paths = array_keys($this->api->config->item('modules_locations'));
		$allmodules = array();
		foreach($modules_paths as $key => $path)
		{
			$allmodules[$path] = array_diff(directory_map($path, 1), ['index.html']);
		}
		
		return $allmodules;
	}
	
	function _get_modules_configs()
	{
		foreach($modules_list as $path => $modules)
		{
			foreach($modules as $module)
			{
				$module_config[$module] = json_decode(read_file($path.$module.'/config.json'));
			}
		}
		
		return $module_config;
	}
}
