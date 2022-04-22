<?php 

class Model_exams extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
    
	public function getExamData($id = null) {
		if($id) {
			$sql = "SELECT e.*,s.stream_id as stream_id FROM entrance_exam as e INNER JOIN streams as s ON e.stream_id = s.stream_id WHERE e.exam_id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT e.*,s.name as stream_name FROM entrance_exam as e INNER JOIN streams as s ON e.stream_id = s.stream_id ORDER BY e.exam_id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data = array())
	{
		if($data) {
			$create = $this->db->insert('entrance_exam', $data);
			return ($create == true) ? true : false;
		}
	}

	public function update($id = null, $data = array())
	{
		if($id && $data) {
			$this->db->where('exam_id', $id);
			$update = $this->db->update('entrance_exam', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id = null)
	{
		if($id) {
			$this->db->where('exam_id', $id);
			$delete = $this->db->delete('entrance_exam');
			return ($delete == true) ? true : false;
		}

		return false;
	}
    
	public function checkIfExists($title) {
		if($title) {
			$sql   = "SELECT * FROM entrance_exam WHERE name LIKE '$title'";
			$query = $this->db->query($sql);
			return $query->num_rows();
		}
	}
}