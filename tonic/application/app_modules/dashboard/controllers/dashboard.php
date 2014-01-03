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
		$this->tree->insert_root_child("child","firstChild");
		$this->tree->insert_root_child("child","secondChild");
		$this->tree->insert_child("child2","firstGrandChild",$this->tree->get_root()->get_child_at(0));
		$this->tree->insert_child("child2","secondGrandChild",$this->tree->get_root()->get_child_at(0));
		$this->tree->insert_child("child3","xFirstGrandChild",$this->tree->get_root()->get_child_at(0)->get_child_at(1));
		$this->tree->insert_child("child4","xxFirstGrandChild",$this->tree->get_root()->get_child_at(0)->get_child_at(1)->get_child_at(0));
		$this->tree->insert_child("child4","xxSecondGrandChild",$this->tree->get_root()->get_child_at(0)->get_child_at(1)->get_child_at(0));
		echo((string)$this->tree->getRoot()->getChild("child","secondChild"));

		var_dump($tree->getRoot()->hasChildren());
		//var_dump($tree->getRoot()->getChildAt(0)->getChildren());
		var_dump($tree->getRoot()->getChildAt(0)->getChildAt(1)->getChildren());
		//var_dump($tree->getRoot()->getChildAt(1)->hasChildren());
		$this->tree->findChild("child3","xFirstGrandChild",$tree->getRoot());
		var_dump($this->tree->getChildFound());
		$this->tree->insertChild("child4","xyfirstGrandChild",$tree->getChildFound());
		$tree->getNodesByDepth(4,$tree->getRoot());
		var_dump($tree->getChildsByDepth());
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
