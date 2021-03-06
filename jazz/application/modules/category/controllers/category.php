<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('mdl_category');
		$this->cache->memcached->clean();
	}
	
	function index()
	{
		$view_data['page_title'] = lang('category.title');
		$structures = $this->get_categories_structure();
		$categories = $this->get_categories();
		$categories_data['structures'] = $structures;
		$categories_data['categories'] = $categories;
		$categories_data['status'] = array(0 => 'icn_alert_error.png', 1 => 'icn_alert_success.png');
		$view_data['admin_widgets']['categories'] = $this->show('category', $categories_data);
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
			$view_data['status'] = array(0 => lang('admin.status0'), 1 => lang('admin.status1'));
		}
		else
		{
			$view_data = $category_data;
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
	
	private function delete_category($category_id)
	{
		
	}
	
	private function generate_categories_tree($categories, $parent = 0, $depth = 0)
	{
		$tree = '';
		if($categories)
		{
			foreach($categories as $category)
			{
				if($category->category_parent_id == $parent)
				{
					$tree .= $depth.'|'.$category->category_id;
					$tree .= '||'.$this->generate_categories_tree($categories, $category->category_id, $depth+1);
				}
			}
		}

		return $tree;
	}
	
	private function get_categories_structure()
	{
		$this->load->helper('array');
		if ($this->cache->memcached->get('get_categories_structure')) return $this->cache->memcached->get('get_categories_structure');
		$categories_structure = array();
		$languages = modules::run('language/get_languages');
		foreach($languages as $language)
		{
			if ($this->cache->memcached->get('generate_categories_tree_'.$language->language_id))
			{
				$structure = $this->cache->memcached->get('generate_categories_tree_'.$language->language_id);
			}
			else
			{
				$structure = $this->generate_categories_tree(element($language->language_id, $this->get_categories()));
				$this->cache->memcached->save('generate_categories_tree_'.$language->language_id, $structure);
			}

			$tree = explode('||', $structure);
			if (end($tree) == '') array_pop($tree);
			foreach($tree as $node)
			{
				$temp = explode('|', $node);
				$categories_structure[$language->language_id][$temp[1]] = $temp[0];
			}
		}		
		$this->cache->memcached->save('get_categories_structure', $categories_structure);
		
		return $categories_structure;
	}
	
	private function get_categories()
	{
		if ($this->cache->memcached->get('get_categories')) return $this->cache->memcached->get('get_categories');
		$categories = array();
		$languages = modules::run('language/get_languages');
		foreach($languages as $language)
		{
			$where = array('language_id = ' => $language->language_id);
			$results = $this->mdl_category->get_join_where('*', $where)->result();
			foreach($results as $result)
			{
				$categories[$language->language_id][$result->category_id] = $result;
			}
		}
		$this->cache->memcached->save('get_categories', $categories);
				
		return $categories;
	}
	
	private function get_dropdown_categories()
	{
		if ($this->cache->memcached->get('get_dropdown_categories')) return $this->cache->memcached->get('get_dropdown_categories');
		$categories = array();
		$languages = modules::run('language/get_languages');
		foreach($languages as $language)
		{
			$where = array('language_id = ' => $language->language_id);
			$results = $this->mdl_category->get_join_where('*', $where)->result();
			if (empty($results)) $categories[$language->language_id][$result->category_id] = ' ?? ';
			else
			{
				foreach($results as $result)
				{
					$categories[$language->language_id][$result->category_id] = $result->category_name;
				}
			}
		}
		$this->cache->memcached->save('get_dropdown_categories', $categories);

		return $categories;
	}
	
	private function get_category($category_id, $language_id = 0)
	{
		if ($language_id)
		{
			return $this->get_language_category($category_id, $language_id);
		}
		
		$languages = modules::run('language/get_languages');
		foreach($languages as $language)
		{
			$category[$language->language_id] = $this->get_language_category($category_id, $language->language_id);
		}
		
		return $category;
	}
	
	private function get_language_category($category_id, $language_id = 0)
	{
		$where = array('jazz_categories.category_id = ' => $category_id, 'language_id = ' => $language_id);
		$category = $this->mdl_category->get_join_where('*', $where)->row();
		//if (empty($category))
		//{
			//return $this->get_empty_category($category_id, $language_id);
		//}
		
		return $category;
	}
	
	private function get_empty_category($category_id, $language_id)
	{
		$result = $this->mdl_category->get_where('jazz_categories', $category_id)->row();
		$category = new stdClass;
		$category->category_id = $category_id;
		$category->category_parent_id = $result->category_parent_id;
		$category->category_order = $result->category_order; 
		$category->category_active = $result->category_active; 
		$category->category_deleted = $result->category_deleted; 
		$category->category_depth = $result->category_depth; 
		$category->category_created = $result->category_created; 
		$category->category_modified = $result->category_modified; 
		$category->language_id = $language_id;
		$category->category_name = '';
		$category->category_url = '';
		
		return $category;
	}
}
