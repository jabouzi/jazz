<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Configs
{
	function __construct()
	{
		$this->load->helper('directory');
		$this->load->helper('file');
		$this->load->helper('array');
	}
	
	function get_modules_list()
	{
		foreach($this->_get_modules() as $modules)
		{
			$allmodules = array_merge($list, $modules);
		}
		
		return $allmodules;
	}
	
	function get_module_configs()
	{
		
	}
	
	function get_module_config($config)
	{
		
	}

	function _get_modules()
	{
		$modules_paths = array_keys($this->config->item('modules_locations'));
		$allmodules = array();
		foreach($modules_paths as $key => $path)
		{
			$allmodules[$path] = array_diff(directory_map($path, 1), ['index.html']);
		}
		
		return $allmodules;
	}
	
	function _get_modules_configs()
	{
		foreach($allmodules as $path => $modules)
		{
			foreach($modules as $module)
			{
				$module_config[$module] = json_decode(read_file($path.$module.'/config.json'));
			}
		}
	}
	
	return $module_config;
}
