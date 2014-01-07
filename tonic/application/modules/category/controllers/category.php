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
		$view_data['categories'] = $this->get_categories_structure();
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
				$tab = str_repeat('<span class="dash_space"><nobr>|—</nobr></span>', $depth);
				$tree .= $this->category_format($tab, $category);
				$tree .= $this->generate_categories_tree($categories, $category->category_id, $depth+1);
			}
		}

		return $tree;
	}
	
	private function category_format($tab, $category)
	{
		$format = '<tr>';
		$format .= '<td>' . $tab . $category->category_name . '</td>';
		$format .= '<td><input type="text" name="order[' . $category->category_id . ']" maxlength="2" size="2" value="' .  $category->category_order . '"></td>';
		$format .= '<td>' . lang('admin.status'.ord($category->category_status)) . '</td>';
		$format .= '<td>' . anchor('category/editcategory/'.$category->category_id, '<input type="image" src="/tonic/assets/images/icn_edit.png" title="'.lang('category.edit').'">');
		$format .= '<input type="image" src="/tonic/assets/images/icn_trash.png" title="' . lang('category.delete') . '">';
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
		}
		
		return $categories_structure;
	}
	
	private function get_category_name($category_id, $language_id)
	{
		$where = array('category_id = ' => $category_id, 'language_id = ' => $language_id);
		$order_by('category_id ASC', 'category_order ASC');
		$category = $this->mdl_category->get_where_custom('tonic_categories_i18n', $where, $order_by)->row();
		
		if (!empty($category)) return $category->category_name;
		return '';
	}
}
