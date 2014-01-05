<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Language extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('mdl_language');
		$this->load->library('tree');
	}
	
	function index()
	{
		$view_data['page_title'] = lang('language.title');
		$view_data['admin_widgets']['languages'] = $this->show();
		echo modules::run('template', $view_data);
	}
	
	private function show()
	{
		$this->load->helper('form');
		$results = $this->mdl_language->get();
		$view_data['languages'] = $results;
		return $this->load->view('language', $view_data, true);
	}
	
	function process()
	{
		var_dump($this->input->post());
		//foreach($this->input->post() as $id => $value)
		//{
			//if (is_numeric($id))
			//{
				//$actions = $this->input->post('actions');
				//$data = array('permission_name_'.$this->lang->lang() => $value, 'permission_actions' => serialize($actions[$id]));
				//$this->update_permission($id, $data);
			//}
		//}
		//
		//foreach ($this->input->post('new') as $new)
		//{
			//$data = array('permission_name_'.$this->lang->lang() => $new);
			//$this->add_permission($data);
		//}
		//
		//foreach($this->input->post('delete') as $id => $value)
		//{
			//$this->delete_permission($id);
		//}
		
		//redirect('permission');
	}
	
	private function add_language($language_data)
	{
		$language_id = $this->mdl_language->insert($language_data);
		$this->session->set_languagedata('success_message', lang('language.success'));
		redirect('language/editlanguage/'.$language_id);
	}
	
	private function update_language($language_id, $language_data)
	{
		$this->mdl_language->update($language_id, $language_data);
		$this->session->set_languagedata('success_message', lang('language.success'));
		redirect('language/editlanguage/'.$language_id);
	}
	
	private function update_profile($language_id, $language_data)
	{
		$this->mdl_language->update($language_id, $language_data);
		$this->session->set_languagedata('success_message', lang('language.success'));
		redirect('language');
	}
	
	private function delete_language($language_id)
	{
		
	}
}
