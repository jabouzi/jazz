<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Node
{
	private $type;
	private $data;
	private $depth;
	private $children;   

	function __construct()
	{
	}

	function set_node($type, $data, $depth)
	{
		$this->type = $type;
		$this->data = $data;
		$this->depth = $depth;
		$this->children = array();
	}

	function get_type()
	{
		return $this->type;
	} 

	function get_data()
	{
		return $this->data;
	}  

	function get_depth()
	{
		return $this->depth;
	}

	function get_children()
	{
		return $this->children;
	}

	function add_child($child)
	{
		if (!$this->get_child($child->get_type(),$child->get_data()))
		{
			$this->children[] = $child;
		}
		return count($this->children) - 1;
	}

	function get_child($type, $data)
	{
		$childFound = false;
		foreach($this->children as $child)
		{
			if ($type == $child->type && $data == $child->data)
			{
				$childFound = $child;
				break;
			}
		}
		return $childFound;
	}

	function has_children()
	{
		return count($this->get_children()) > 0;
	}

	function get_child_at($position)
	{
		$children = $this->get_children();
		return $children[$position];
	}
	
	function __toString()
	{
		$string = 'type : ' . $this->type . '<br>';
		$string .= 'data : ' . $this->data . '<br>';
		$string .= 'depth : ' . $this->depth . '<br>';
		return $string;
	}
}
