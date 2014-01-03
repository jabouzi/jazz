<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tree
{
	private $api;
	private $root;
	private $count;
	private $depth;
	private $child_found;
	private $childs_by_depth;
 
	function __construct()
	{
		$this->api = & get_instance();
		$this->api->load->library('node');
		$this->root = null;
		$this->count = 0;
		$this->set_depth(0);
		$this->child_found = false;
		$this->childs_by_depth = array();
	}
 
	public function is_empty()
	{
		return (null == $this->root);
	} 
	
	function add_root($type, $data)
	{
		$node = new Node();
		$node->set_node($type, $data, 0);
		$this->root = $node;
		$this->increment_count();
	}
	
	function get_root()
	{
		return $this->root;
	}
	
	function get_count()
	{
		return $this->count;
	}
	
	function get_depth()
	{
		return $this->depth;
	}
	
	function get_child_found()
	{
		return $this->child_found;
	}
	
	function get_childs_by_depth()
	{
		return $this->childs_by_depth;
	}
	
	function increment_count()
	{
		$this->count = $this->count + 1;
	}   
	
	function set_depth($new_depth)
	{
		$this->depth = $new_depth;
	}
	
	function insert_root_child($type, $data)
	{
		$node = new Node();
		$node->set_node($type, $data, 1);
		$this->increment_count();
		return $this->root->add_child($node);   
	}
	
	function insertchild($type, $data, $node)
	{
		$childdepth = $node->get_depth() + 1;
		$child = new Node();
		$child->set_node($type, $data, $childdepth);
		$this->increment_count();
		if ($childdepth > $this->get_depth())
		{
			$this->set_depth($child_depth);
		}
		return $node->add_child($child); 
	}	
	
	function getnodes_by_depth($depth, $node)
	{
		if ($depth == $node->getd_epth())
		{
			$this->childs_by_depth[] = $node;
		}
		else
		{
			foreach($node->get_children() as $child)
			{
				$this->getnodes_by_depth($depth, $child); 
			}
		}
	}
	
	function find_child($data, $type, $node)
	{
		if ($node->get_child($data, $type))
		{
			$this->child_found = $node->get_child($data, $type);
		}
		else
		{
			foreach ($node->get_children() as $child)
			{
				$this->find_child($data, $type, $child);
			}
		}
	}
}
