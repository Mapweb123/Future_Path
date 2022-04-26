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
	
	
	
}