<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('mdl_category');
		$this->load->library('tree');
		$this->load->library('node');
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
		$view_data['admin_languages'] = $this->lang->languages;
		$view_data['categories'] = $this->get_categories_structure();
		echo ($view_data['categories']['en']);
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
		//if($depth > 1000) return ''; // Make sure not to have an endless recursion
		$tree = '';
		//for($i=0, $ni=count($categories); $i < $ni; $i++){
		foreach($categories as $category)
		{
			if($category->category_parent_id == $parent)
			{
				$tab = str_repeat('|—', $depth);
				$tree .= $this->category_format($tab, $category);
				//$tree .= $category->category_name;
				$tree .= $this->generate_categories_tree($categories, $category->category_id, $depth+1);
			}
		}

		return $tree;
	}
	
	private function category_format($tab, $category)
	{
		$format = '<tr>';
		$format .= '<td>' . $tab . $category->category_name . '</td>';
		//$format .= '<td>' . $this->get_category_name($category->category_parent_id, $category->language_id) . '</td>';
		$format .= '<td>' . lang('admin.status'.ord($category->category_status)) . '</td>';
		$format .= '<td>' . anchor('category/editcategory/'.$category->category_id, '<input type="image" src="/tonic/assets/images/icn_edit.png" title="'.lang('category.edit').'">');
		$format .= '<input type="image" src="/tonic/assets/images/icn_trash.png" title="' . lang('category.delete') . '>';
		$format .= '</td>';
		$format .= '</tr>';
		
		return $format;
	}
	
	private function get_categories_structure()
	{
		$categories_structure = array();
		$languages = modules::run('language/get_languages');
		foreach($languages as $language)
		{
			$categories = $this->mdl_category->get_join_where(array('language_id = ' => $language->language_id))->result();
			$categories_structure[$language->language_code] = $this->generate_categories_tree($categories);
			//var_dump($categories);
		}
		
		return $categories_structure;
		
		//echo '&#9658;';
		//echo '|—';
	}
	
	private function get_category_name($category_id, $language_id)
	{
		$where = array('category_id = ' => $category_id, 'language_id = ' => $language_id);
		$category = $this->mdl_category->get_where_custom('tonic_categories_i18n', $where)->row();
		
		return $category->category_name;
	}
}
