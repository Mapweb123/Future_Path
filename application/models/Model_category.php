<?php 

class Model_category extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
    
	public function getCategoryData($id = null) {
		if($id) {
			$sql = "SELECT * FROM caste_category WHERE cat_id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM caste_category ORDER BY cat_id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data = array())
	{
		if($data) {
			$create = $this->db->insert('caste_category', $data);
			return ($create == true) ? true : false;
		}
	}

	public function update($id = null, $data = array())
	{
		if($id && $data) {
			$this->db->where('cat_id', $id);
			$update = $this->db->update('caste_category', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id = null)
	{
		if($id) {
			$this->db->where('cat_id', $id);
			$delete = $this->db->delete('caste_category');
			return ($delete == true) ? true : false;
		}

		return false;
	}
    
	public function checkIfExists($title) {
		if($title) {
			$sql   = "SELECT * FROM caste_category WHERE name  LIKE '$title'";
			$query = $this->db->query($sql);
			return $query->num_rows();
		}
	}
	
	public function getActiveCategorys()
	{
		$sql = "SELECT * FROM caste_category WHERE status = ?";
		$query = $this->db->query($sql, array('1'));
		return $query->result_array();
	}

	public function countTotalCategorys()
	{
		$sql = "SELECT * FROM caste_category WHERE status = ?";
		$query = $this->db->query($sql, array('1'));
		return $query->num_rows();
	}
}