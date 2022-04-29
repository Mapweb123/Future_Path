<?php 

class Model_search extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getActiveCategory() 
	{
		$sql = "SELECT * FROM caste_category WHERE status = ?";
		$query = $this->db->query($sql, array('1'));
		return $query->result_array();
	}
	
	public function getExamData($id) {
		$sql = "SELECT * FROM entrance_exam WHERE stream_id = ? AND status = '1';";
		$query = $this->db->query($sql, array($id));
		//echo $this->db->last_query();die;
		return $query->result_array();
	}
	
	public function getActiveYear() 
	{
		$sql = "SELECT * FROM aspirant_year WHERE status = ? ORDER BY `aspirant_year`.`aspirant_year_id` ASC";
		$query = $this->db->query($sql, array('1'));
		return $query->result_array();
	}
	
	public function getCastCategoryFromTable($table) 
	{
		$sql = "SELECT DISTINCT(`caste_category`) as cast FROM ".$table." WHERE 1 ORDER BY `caste_category` ASC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function getActiveStudent() 
	{
		$sql = "SELECT * FROM students WHERE status = ? ORDER BY `fname` ASC";
		$query = $this->db->query($sql, array('1'));
		return $query->result_array();
	}
	
	public function getCollageFromTable($table,$post) 
	{
		$min_marks = $post['min_marks'];
		$actual_marks = $post['actual_marks'];
		$max_marks = $post['max_marks'];
		$cast = $post['cast'];
		
		$sql = "SELECT * FROM ".$table." WHERE open_rank >= $min_marks AND close_rank <= $max_marks AND caste_category = '$cast'";
		$query = $this->db->query($sql);
		//echo $this->db->last_query();die;
		return $query->result_array();
	}
	
	public function getExamName($exam) 
	{
		$sql = "SELECT * FROM entrance_exam WHERE exam_id = ? AND status = '1';";
		$query = $this->db->query($sql, array($exam));
		return $query->row();
	}
	
}