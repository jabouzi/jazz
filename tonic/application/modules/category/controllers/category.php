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
		$view_data['admin_widgets']['categories'] = $this->show();
		echo modules::run('template', $view_data);
	}
	
	private function show()
	{
		$this->load->helper('form');
		$this->load->helper('array');
		$view_data['languages'] = modules::run('language/get_languages');
		$structure = $this->get_categories_structure();
		$view_data['categories'] = $this->get_categories($structure);
		$view_data['structure'] = $structure;
		return $this->load->view('category', $view_data, true);
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
	
	private function get_categories_structure()
	{
		$categories_structure = array();
		$default_language = modules::run('language/get_default_language');
		$where = array('language_id = ' => $default_language);
		$categories = $this->mdl_category->get_join_where($where)->result();
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
	
	private function get_categories($structure)
	{
		$categories = array();
		$languages = modules::run('language/get_languages');
		foreach($languages as $language)
		{	
			foreach($structure as $id => $struct)
			{
				$categories[$language->language_id][] = $this->get_category($id, $language->language_id);
			}
		}
		
		return $categories;
	}
	
	private function get_category($category_id, $language_id = 0)
	{
		$where = array('tonic_categories.category_id = ' => $category_id);
		if ($language_id) $where['language_id = '] = $language_id
		$category = $this->mdl_category->get_join_where($where)->row();
		
		return $category;
	}
}
