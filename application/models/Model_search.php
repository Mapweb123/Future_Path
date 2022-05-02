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
	
	public function getTables($year) 
	{
		//echo 'Yesr : '.$year;die;
		$tblArr = array();
		$sql = "SHOW TABLES;";
		$query = $this->db->query($sql);
		$tables = $query->result_array();
		//echo '<pre>tables'; print_r($tables); echo '</pre>';
		if(count($tables) > 0){
			foreach($tables as $key => $names){
				if(strpos($names['Tables_in_future_path'], $year)){
					$tblArr[] = $names['Tables_in_future_path'];
				}
			}
		}
		return $tblArr;
	}
	
	public function getDataToUpdate($table) 
	{
		//echo $table;die;
		if(strpos('jee_main_adv_', $table)){
			$sql = "SELECT * FROM `".$table."` group by program ORDER BY `id` ASC";
		}
		else{
			$sql = "SELECT * FROM `".$table."` group by program ORDER BY `id` ASC";	
		}
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function updateCollageIntakeData($post) 
	{
		//echo '<pre>'; print_r($post); echo '</pre>';die;
		$table = $post['table'];
		$txt_collage = $post['txt_collage'];
		$txt_program = $post['txt_program'];
		$txt_intake = $post['txt_intake'];
		$txt_total_fees = $post['txt_total_fees'];
		$txt_collage_mobile = $post['txt_collage_mobile'];
		$txt_collage_email = $post['txt_collage_email'];
		$txt_collage_website = $post['txt_collage_website'];
		$txt_exstud_mobile = $post['txt_exstud_mobile'];
		
		if(count($txt_collage) > 0){
			foreach($txt_collage as $k => $value){
				$this->db->query("UPDATE `".$table."` SET `intake` = '".$txt_intake[$k]."', `total_fees` = '".$txt_total_fees[$k]."', `collage_mobile` = '".$txt_collage_mobile[$k]."', `collage_email` = '".$txt_collage_email[$k]."', `collage_website` = '".$txt_collage_website[$k]."', `exstud_mobile` = '".$txt_exstud_mobile[$k]."' WHERE `collage` = '".$value."' AND `program` = '".$txt_program[$k]."';");
			}
		}//end of if(count($txt_collage) > 0)
	}
}