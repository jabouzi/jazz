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
		
		var_dump($this->get_categories_structure());

		$view_data['categories'] = $categories_structure;
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
		for($i=0, $ni=count($categories); $i < $ni; $i++){
			if($categories[$i]->category_parent_id == $parent){
				$tree .= str_repeat('-', $depth);
				$tree .= $categories[$i]->category_name . '<br/>';
				$tree .= $this->generatePageTree($categories, $categories[$i]->category_id, $depth+1);
			}
		}
		return $tree;
	}
	
	/*private function category_format($category)
	{
		$format = '<tr>
			<td>' . $category->category_name . '</td>
			<td><?php echo $category->category_lastname ?></td>
			<td><?php echo $category->category_email ?></td>
			<td><?php echo lang('category.status'.ord($category->category_status)); ?></td>
			<td>
				<?php echo anchor('category/editcategory/'.$category->category_id, '<input type="image" src="/tonic/assets/images/icn_edit.png" title="'.lang('category.edit').'">'); ?>
				<input type="image" src="/tonic/assets/images/icn_trash.png" title="<?php echo lang('category.delete'); ?>">
			</td>
		</tr>';
	}*/
	
	private function get_categories_structure()
	{
		$languages = modules::run('language/get_languages');
		var_dump($languages);
		foreach($languages as $language)
		{
			$categories = $this->mdl_category->get_join_where(array('language_id' => $language->language_id));
			var_dump($categories);
		}
		//$categories = $this->mdl_category->get_join_where()->result();
		//$categories_structure = $this->generate_categories_tree($categories);
		//echo ($categories_structure);
		
		echo '&#9658;';
		echo '|—';
	}
}
