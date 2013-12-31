<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_permission extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function get($order_by)
	{
		$table = 'tonic_permissions';
		$this->db->order_by($order_by);
		$query = $this->db->get($table);
		return $query;
	}
	
	function get_with_limit($limit, $offset, $order_by)
	{
		$table = 'tonic_permissions';
		$this->db->limit($limit, $offset);
		$this->db->order_by($order_by);
		$query = $this->db->get($table);
		return $query;
	}
	
	function get_where($id)
	{
		$table = 'tonic_permissions';
		$this->db->where('permission_id > ', $id);
		$query = $this->db->get($table);
		return $query;
	}
	
	function get_where_custom($col, $value)
	{
		$table = 'tonic_permissions';
		$this->db->where($col, $value);
		$query = $this->db->get($table);
		return $query;
	}
	
	function insert($data)
	{
		$table = 'tonic_permissions';
		$this->db->insert($table, $data);
	}
	
	function update($id, $data)
	{
		$table = 'tonic_permissions';
		$this->db->where('permission_id', $id);
		$this->db->update($table, $data);
	}
	
	function delete($id)
	{
		$table = 'tonic_permissions';
		$this->db->where('permission_id', $id);
		$this->db->delete($table);
	}
	
	function count_where($column, $value)
	{
		$table = 'tonic_permissions';
		$this->db->where($column, $value);
		$query	= $this->db->get($table);
		$num_rows = $query->num_rows();
		return $num_rows;
	}
	
	function count_all()
	{
		$table	= 'tonic_permissions';
		$query	= $this->db->get($table);
		$num_rows = $query->num_rows();
		return $num_rows;
	}
	
	function get_max()
	{
		$table = 'tonic_permissions';
		$this->db->select_max('permission_id');
		$query = $this->db->get($table);
		$row   = $query->row();
		$id	= $row->id;
		return $id;
	}
	
	function custom_query($mysql_query)
	{
		$query = $this->db->query($mysql_query);
		return $query;
	}
}
