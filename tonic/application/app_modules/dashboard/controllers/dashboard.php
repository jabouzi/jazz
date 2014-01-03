<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MX_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
		$this->load->library('tree');
		$this->tree->add_root("root", "testRoot");
		echo ((string)$this->tree->get_root());
		$this->tree->insertRootChild("child","firstChild");
		$this->tree->insertRootChild("child","secondChild");
		$this->tree->insertChild("child2","firstGrandChild",$this->tree->getRoot()->getChildAt(0));
		$this->tree->insertChild("child2","secondGrandChild",$this->tree->getRoot()->getChildAt(0));
		$this->tree->insertChild("child3","xFirstGrandChild",$this->tree->getRoot()->getChildAt(0)->getChildAt(1));
		$this->tree->insertChild("child4","xxFirstGrandChild",$this->tree->getRoot()->getChildAt(0)->getChildAt(1)->getChildAt(0));
		$this->tree->insertChild("child4","xxSecondGrandChild",$this->tree->getRoot()->getChildAt(0)->getChildAt(1)->getChildAt(0));
		$this->show();
	}
	
	function show()
	{
		$view_data['page_title'] = lang('dashboard.title3');
		$view_data['admin_widgets']['analytic_preview'] = modules::run('analytic/preview');
		$view_data['admin_widgets']['structure_preview'] = modules::run('structure/preview');
		echo modules::run('template', $view_data);
	}
	
	function print_other()
	{
		$this->load->helper('language');
		$this->load->helper('url');
		var_dump($this->lang->lang());
		var_dump($this->lang->languages);
		$view_data['module'] = 'apptest';
		$view_data['view_file'] = 'apptest';
		$this->load->module('mytest')->speak('Skander');
		echo modules::run('mytest/speak', 'Yo man');
		echo site_url().$this->lang->switch_uri('en');
		echo '<br />';
		echo anchor('login','Login');
	}
}
