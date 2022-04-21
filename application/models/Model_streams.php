<?php 

class Model_streams extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
    
	public function getStreamData($id = null) {
		if($id) {
			$sql = "SELECT * FROM streams WHERE stream_id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM streams ORDER BY stream_id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data = array())
	{
		if($data) {
			$create = $this->db->insert('streams', $data);
			return ($create == true) ? true : false;
		}
	}

	public function update($id = null, $data = array())
	{
		if($id && $data) {
			$this->db->where('stream_id', $id);
			$update = $this->db->update('streams', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id = null)
	{
		if($id) {
			$this->db->where('stream_id', $id);
			$delete = $this->db->delete('streams');
			return ($delete == true) ? true : false;
		}

		return false;
	}
    
	public function checkIfExists($title) {
		if($title) {
			$sql   = "SELECT * FROM streams WHERE name  LIKE '$title'";
			$query = $this->db->query($sql);
			return $query->num_rows();
		}
	}
	
	public function getActiveMaster()
	{
		$sql = "SELECT * FROM stream_id WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	public function countTotalMasters()
	{
		$sql = "SELECT * FROM stream_id WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->num_rows();
	}
}