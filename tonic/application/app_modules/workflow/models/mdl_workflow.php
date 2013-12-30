<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_workflow extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function get($order_by)
	{
		$table = 'tonic_workflows';
		$this->db->order_by($order_by);
		$query = $this->db->get($table);
		return $query;
	}
	
	function get_with_limit($limit, $offset, $order_by)
	{
		$table = 'tonic_workflows';
		$this->db->limit($limit, $offset);
		$this->db->order_by($order_by);
		$query = $this->db->get($table);
		return $query;
	}
	
	function get_where($id)
	{
		$table = 'tonic_workflows';
		$this->db->where('workflow_id', $id);
		$query = $this->db->get($table);
		return $query;
	}
	
	function get_where_custom($col, $value)
	{
		$table = 'tonic_workflows';
		$this->db->where($col, $value);
		$query = $this->db->get($table);
		return $query;
	}
	
	function _insert($data)
	{
		$table = 'tonic_workflows';
		$this->db->insert($table, $data);
	}
	
	function _update($id, $data)
	{
		$table = 'tonic_workflows';
		$this->db->where('id', $id);
		$this->db->update($table, $data);
	}
	
	function _delete($id)
	{
		$table = 'tonic_workflows';
		$this->db->where('id', $id);
		$this->db->delete($table);
	}
	
	function count_where($column, $value)
	{
		$table = 'tonic_workflows';
		$this->db->where($column, $value);
		$query	= $this->db->get($table);
		$num_rows = $query->num_rows();
		return $num_rows;
	}
	
	function count_all()
	{
		$table	= 'tonic_workflows';
		$query	= $this->db->get($table);
		$num_rows = $query->num_rows();
		return $num_rows;
	}
	
	function get_max()
	{
		$table = 'tonic_workflows';
		$this->db->select_max('workflow_id');
		$query = $this->db->get($table);
		$row   = $query->row();
		$id	= $row->id;
		return $id;
	}
	
	function _custom_query($mysql_query)
	{
		$query = $this->db->query($mysql_query);
		return $query;
	}
}
