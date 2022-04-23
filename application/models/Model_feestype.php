<?php 

class Model_feestype extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
    
	public function getFeestypeData($id = null) {
		if($id) {
			$sql = "SELECT * FROM fees_type WHERE fees_id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM fees_type ORDER BY fees_id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data = array())
	{
		if($data) {
			$create = $this->db->insert('fees_type', $data);
			return ($create == true) ? true : false;
		}
	}

	public function update($id = null, $data = array())
	{
		if($id && $data) {
			$this->db->where('fees_id', $id);
			$update = $this->db->update('fees_type', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id = null)
	{
		if($id) {
			$this->db->where('fees_id', $id);
			$delete = $this->db->delete('fees_type');
			return ($delete == true) ? true : false;
		}

		return false;
	}
    
	public function checkIfExists($title) {
		if($title) {
			$sql   = "SELECT * FROM fees_type WHERE name LIKE '$title'";
			$query = $this->db->query($sql);
			return $query->num_rows();
		}
	}
}