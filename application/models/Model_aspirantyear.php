<?php 

class Model_aspirantyear extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
    
	public function getAspirantYearData($id = null) {
		if($id) {
			$sql = "SELECT * FROM aspirant_year WHERE aspirant_year_id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM aspirant_year ORDER BY aspirant_year_id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data = array())
	{
		if($data) {
			$create = $this->db->insert('aspirant_year', $data);
			return ($create == true) ? true : false;
		}
	}

	public function update($id = null, $data = array())
	{
		if($id && $data) {
			$this->db->where('aspirant_year_id', $id);
			$update = $this->db->update('aspirant_year', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id = null)
	{
		if($id) {
			$this->db->where('aspirant_year_id', $id);
			$delete = $this->db->delete('aspirant_year');
			return ($delete == true) ? true : false;
		}

		return false;
	}
    
	public function checkIfExists($title) {
		if($title) {
			$sql   = "SELECT * FROM aspirant_year WHERE title  LIKE '%$title%'";
			$query = $this->db->query($sql);
			return $query->num_rows();
		}
	}
	
	public function fetchActiveAspirantYears()
	{
		$sql = "SELECT * FROM aspirant_year WHERE status = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	public function countTotalAspirantYears()
	{
		$sql = "SELECT * FROM aspirant_year WHERE status = ?";
		$query = $this->db->query($sql, array(1));
		return $query->num_rows();
	}
}