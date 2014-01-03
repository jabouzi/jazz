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
		$this->root = NULL;
		$this->count = 0;
		$this->set_depth(0);
		$this->child_found = false;
		$this->childs_by_depth = array();
	}
 
	public function is_empty()
	{
		return (NULL == $this->root);
	} 
	
	function add_root($type,$data)
	{
		$this->node->set_node($type, $data, 0);
		$this->root = $this->node;
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
		$this->node->set_node($type, $data, 1);
		$this->increment_count();
		return $this->root->add_child($this->node);   
	}
	
	function insert_child($type, $data, $this->node)
	{
		$child_depth = $this->node->get_depth() + 1;
		$child = $this->node->set_node($type, $data, $chil_dDepth);
		$this->increment_count();
		if ($child_depth > $this->get_depth())
		{
			$this->set_depth($child_depth);
		}
		return $this->node->add_child($child); 
	}	
	
	function get_nodes_by_depth($depth, $this->node)
	{
		if ($depth == $this->node->get_depth())
		{
			$this->childs_by_depth[] = $this->node;
		}
		else
		{
			foreach($this->node->get_children() as $child)
			{
				$this->get_nodes_by_depth($depth,$child); 
			}
		}
	}
	
	function find_child($data, $type, $this->node)
	{
		if ($this->node->get_child($data, $type))
		{
			$this->child_found = $this->node->get_child($data, $type);
		}
		else
		{
			foreach ($this->node->get_children() as $child)
			{
				$this->find_child($data, $type, $child);
			}
		}
	}
}
