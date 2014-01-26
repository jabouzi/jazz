<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends MX_Controller
{
	private $categories = array();
	function __construct()
	{
		parent::__construct();
		$this->load->model('mdl_category');
		$this->cache->memcached->clean();
		$this->categories = $this->get_categories();
	}
	
	function index()
	{
		var_dump($this->categories);exit;
		$view_data['page_title'] = lang('category.title');
		//$structure = $this->get_categories_structure();
		$categories = $this->get_categories();
		//$this->cache->memcached->save('foo', $categories);
		//var_dump($this->cache->memcached->get('foo'));
		//var_dump($this->cache->memcached->cache_info(), $structure);
		//$categories['structure'] = $structure;
		$categories['status'] = array(0 => 'icn_alert_error.png', 1 => 'icn_alert_success.png');
		$view_data['admin_widgets']['categories'] = $this->show('category', $categories);
		//echo modules::run('template', $view_data);
	}
	
	function newcategory()
	{
		$view_data['page_title'] = lang('category.new');
		$view_data['admin_widgets']['category'] = $this->show('newcategory', array());
		echo modules::run('template', $view_data);
	}
	
	function editcategory($category_id = 0)
	{
		if (!$category_id) redirect('dashboard');
		$view_data['page_title'] = lang('category.edit');
		$category = $this->get_category($category_id);
		$view_data['admin_widgets']['category'] = $this->show('editcategory', $category);
		echo modules::run('template', $view_data);
	}
	
	function deletecategory($category_id = 0)
	{
		if (!$category_id) redirect('dashboard');
		$view_data['page_title'] = lang('category.edit');
		$category = $this->get_category($category_id);
		$view_data['admin_widgets']['category'] = $this->show('editcategory', $category);
		echo modules::run('template', $view_data);
	}
	
	private function show($view, $category_data)
	{
		$this->load->helper('form');
		if ($view == 'editcategory')
		{
			$view_data['categories_list'] = $this->get_dropdown_categories();
			$view_data['categories'] = $category_data;
		}
		else
		{
			$view_data['categories'] = $category_data;
		}
		$view_data['languages'] = modules::run('language/get_languages');
		return $this->load->view($view.'.php', $view_data, true);
	}
	
	function process()
	{
		
	}
	
	function process_newcategory()
	{
		
	}
	
	function process_updatecategory()
	{
		
	}
	
	function process_deletecategory()
	{
		
	}
	
	private function add_category($category_data)
	{
		$category_id = $this->mdl_category->insert($category_data);
		$this->session->set_categorydata('success_message', lang('category.success'));
		redirect('category/editcategory/'.$category_id);
	}
	
	private function update_category($category_id, $category_data)
	{
		$this->mdl_category->update($category_id, $category_data);
		$this->session->set_categorydata('success_message', lang('category.success'));
		redirect('category/editcategory/'.$category_id);
	}
	
	private function update_profile($category_id, $category_data)
	{
		$this->mdl_category->update($category_id, $category_data);
		$this->session->set_categorydata('success_message', lang('category.success'));
		redirect('category');
	}
	
	private function delete_category($category_id)
	{
		
	}
	
	private function generate_categories_tree($categories, $parent = 0, $depth = 0)
	{
		$tree = '';
		//var_dump($categories);
		foreach($categories as $category)
		{
			if($category[2] == $parent)
			{
				$tree .= $depth.'|'.$category[1];
				$tree .= '||'.$this->generate_categories_tree($categories, $category[1], $depth+1);
			}
		}
		//var_dump($tree);
		return $tree;
	}
	
	private function get_categories_structure($language_id)
	{
		if ($this->cache->memcached->get('get_categories_structure')) return $this->cache->memcached->get('get_categories_structure');
		$categories_structure = array();
		//$where = array('language_id = ' => $language_id);
		//$select = 'jazz_categories.category_id, jazz_categories.category_parent_id';
		//$categories = $this->mdl_category->get_join_where($select, $where)->result();
		$categories = $this->get_dropdown_categories($language_id);
		$structure = $this->generate_categories_tree($categories[$language_id]);
		$tree = explode('||', $structure);
		if (end($tree) == '') array_pop($tree);
		foreach($tree as $node)
		{
			$temp = explode('|', $node);
			$categories_structure[$temp[1]] = $temp[0];
		}
		
		//var_dump($categories_structure);
		$this->cache->memcached->save('get_categories_structure', $categories_structure);
		
		return $categories_structure;
	}
	
	private function get_categories()
	{
		//var_dump($this->cache->memcached->get('get_categories'));
		if ($this->cache->memcached->get('get_categories')) return $this->cache->memcached->get('get_categories');
		$categories = array();
		$languages = modules::run('language/get_languages');
		foreach($languages as $language)
		{
			//$structure = $this->get_categories_structure($language->language_id);
			$categories[$language->language_id]['structure'] = $structure;
			foreach($structure as $id => $struct)
			{
				$categories[$language->language_id][$id] = $this->get_category($id, $language->language_id);
			}
		}
		$this->cache->memcached->save('get_categories', $categories);
		
		//var_dump('2', $categories);
		return $categories;
	}
	
	private function get_dropdown_categories($language_id)
	{
		if ($this->cache->memcached->get('get_dropdown_categories')) return $this->cache->memcached->get('get_dropdown_categories');
		$categories = array();
		$where = array('language_id = ' => $language_id);
		$results = $this->mdl_category->get_join_where('*', $where)->result();
		foreach($results as $result)
		{
			$categories[$language_id][$result->category_id] = array($result->category_name, $result->category_id, $result->category_parent_id);
		}
		//var_dump($categories);
		$this->cache->memcached->save('get_dropdown_categories', $categories);
		
		return $categories;
	}
	
	private function get_category($category_id, $language_id = 0)
	{
		if ($language_id)
		{
			return $this->get_language_category($category_id, $language_id);
		}
		
		$where = array('jazz_categories.category_id = ' => $category_id);
		$languages = modules::run('language/get_languages');
		foreach($languages as $language)
		{
			$results = $this->mdl_category->get_join_where($where)->result();
			foreach($results as $result)
			{
				$categories[$language->language_id] = $result;
			}
		}
		
		return $categories;
	}
	
	private function get_language_category($category_id, $language_id = 0)
	{
		$where = array('jazz_categories.category_id = ' => $category_id, 'language_id = ' => $language_id);
		$category = $this->mdl_category->get_join_where('*', $where)->row();
		
		return $category;
	}
}
