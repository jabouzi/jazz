<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('mdl_category');
		$this->load->library('tree');
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
		$categories_structure = $this->get_categories_structure();
		$view_data['categories'] = $results;
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
	
	private function get_categories_structure()
	{
		var_dump($this->mdl_category->get_max('category_depth'));
		$categories = $this->mdl_category->get();
		var_dump($categories->result());
		//$this->load->library('tree');
		$this->tree->add_root("root", "categories");
		foreach($categories->result() as $category)
		{
			var_dump($category);
			if ($category->category_depth == 1)
			{
				$this->tree->insert_root_child($category­->category_depth, 1);
			}
			//else if ($category->category_depth == 1)
			//{
				//$this->tree->insert_child($category­->category_depth, $category->category_id, $this->tree->find_child(($category->category_level - 1), $category->parent_id));
			//}
			//else
			//{
				//$this->tree->insert_child($category­->category_depth, $category->category_id, $this->tree->find_child(($category->category_level - 1), $category->parent_id));
			//}
		}
		
		var_dump($this->tree->get_root()->get_children());
		//echo ((string)$this->tree->get_root());
		//$this->tree->insert_root_child("child","firstChild");
		//$this->tree->insert_root_child("child","secondChild");
		//$this->tree->insert_child("child2","firstGrandChild",$this->tree->get_root()->get_child_at(0));
		//$this->tree->insert_child("child2","secondGrandChild",$this->tree->get_root()->get_child_at(0));
		//$this->tree->insert_child("child3","xFirstGrandChild",$this->tree->get_root()->get_child_at(0)->get_child_at(1));
		//$this->tree->insert_child("child4","xxFirstGrandChild",$this->tree->get_root()->get_child_at(0)->get_child_at(1)->get_child_at(0));
		//$this->tree->insert_child("child4","xxSecondGrandChild",$this->tree->get_root()->get_child_at(0)->get_child_at(1)->get_child_at(0));
		//echo ((string)$this->tree->get_root()->get_child("child","secondChild"));

		//var_dump($this->tree->get_root()->has_children());
		//var_dump($tree->get_root()->get_child_at(0)->get_children());
		//var_dump($this->tree->get_root()->get_child_at(0)->get_child_at(1)->get_children());
		//var_dump($tree->get_root()->get_child_at(1)->hasChildren());
		//$this->tree->find_child("child3","xFirstGrandChild",$this->tree->get_root());
		//var_dump((string)$this->tree->get_Child_found());
		//$this->tree->insert_child("child4","xyfirstGrandChild",$this->tree->get_Child_found());
		//$this->tree->get_nodes_by_depth(4,$this->tree->get_root());
		//var_dump($this->tree->get_childs_by_depth());
		echo '&#9658;';
		echo '|—';
	}
}
