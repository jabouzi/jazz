<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('mdl_category');
	}
	
	function index()
	{
		$view_data['page_title'] = lang('category.title');
		//$structure = $this->get_categories_structure();
		$categories = $this->get_categories();
		//$this->cache->memcached->save('foo', $categories);
		//var_dump($this->cache->memcached->get('foo'));
		//var_dump($this->cache->memcached->cache_info(), $structure);
		$categories['structure'] = $structure;
		$categories['status'] = array(0 => 'icn_alert_error.png', 1 => 'icn_alert_success.png');
		$view_data['admin_widgets']['categories'] = $this->show('category', $categories);
		echo modules::run('template', $view_data);
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
		foreach($categories as $category)
		{
			if($category->category_parent_id == $parent)
			{
				$tree .= $depth.'|'.$category->category_id;
				$tree .= '||'.$this->generate_categories_tree($categories, $category->category_id, $depth+1);
			}
		}

		return $tree;
	}
	
	private function get_categories_structure($language)
	{
		$categories_structure = array();
		$where = array('language_id = ' => $language);
		$select = 'jazz_categories.category_id', 'jazz_categories.category_parent_id';
		$categories = $this->mdl_category->get_join_where($select, $where)->result();
		var_dump('1', $categories);
		$structure = $this->generate_categories_tree($categories);
		$tree = explode('||', $structure);
		if (end($tree) == '') array_pop($tree);
		foreach($tree as $node)
		{
			$temp = explode('|', $node);
			$categories_structure[$temp[1]] = $temp[0];
		}
		
		return $categories_structure;
	}
	
	private function get_categories()
	{
		$categories = array();
		$languages = modules::run('language/get_languages');
		foreach($languages as $language)
		{
			$structure = $this->get_categories_structure($language->language_id);
			foreach($structure as $id => $struct)
			{
				$categories[$language->language_id][] = $this->get_category($id, $language->language_id);
			}
		}
		
		var_dump('2', $categories);
		return $categories;
	}
	
	private function get_dropdown_categories()
	{
		$categories = array();
		$languages = modules::run('language/get_languages');
		foreach($languages as $language)
		{
			$where = array('language_id = ' => $language->language_id);
			$results = $this->mdl_category->get_join_where($where)->result();
			foreach($results as $result)
			{
				$categories[$language->language_id][$result->category_id] = $result->category_name;
			}
		}
		
		return $categories;
	}
	
	private function get_category($category_id, $language_id = 0)
	{
		$where = array('jazz_categories.category_id = ' => $category_id);
		if ($language_id)
		{
			$where['language_id = '] = $language_id;
			$category = $this->mdl_category->get_join_where($where)->row();
			
			return $category;
		}
		else
		{
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
		
		return false;
	}
}
