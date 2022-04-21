<?php 

class Model_masters extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getMastersData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM masters WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM masters ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data = array())
	{
		if($data) {
			$create = $this->db->insert('masters', $data);
			return ($create == true) ? true : false;
		}
	}

	public function update($id = null, $data = array())
	{
		if($id && $data) {
			$this->db->where('id', $id);
			$update = $this->db->update('masters', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id = null)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('masters');
			return ($delete == true) ? true : false;
		}

		return false;
	}

	public function getActiveMaster()
	{
		$sql = "SELECT * FROM masters WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	public function countTotalMasters()
	{
		$sql = "SELECT * FROM masters WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->num_rows();
	}
}