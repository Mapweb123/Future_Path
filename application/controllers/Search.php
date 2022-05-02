<?php 

class Search extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();
		
		$this->data['page_title'] = 'Search';
		

		$this->load->model('model_search');
		$this->load->model('model_streams');
	}

	public function index()
	{
		/*if(!in_array('viewUser', $this->permission)) {
            redirect('dashboard', 'refresh');
        }*/
		$this->data['js'] = 'application/views/search/index-js.php';
		$stream_data = $this->model_streams->getActiveStreams();
		$this->data['stream_data'] = $stream_data;
		
		$category_data = $this->model_search->getActiveCategory();
		$this->data['category_data'] = $category_data;
		
		$year_data = $this->model_search->getActiveYear();
		$this->data['year_data'] = $year_data;
		
		$student_data = $this->model_search->getActiveStudent();
		$this->data['student_data'] = $student_data;
		
		#get exam - starts
		$exam_data = array();
		$stream = trim(@$_POST['stream']);
		if($stream != ''){
			$exam_data = $this->model_search->getExamData($stream);
			$this->data['exam_data'] = $exam_data;
		}
		#get exam - ends
		
		#get caste & table name - starts
		$cast_data = array();
		$exam = trim(@$_POST['exam']);
		$exam_name = @$this->model_search->getExamName($exam)->name;
		$this->data['exam_name'] = $exam_name;
		//echo '<pre>'; print_r($exam_name); echo '</pre>';die;
		$table = '';
		
		if($exam != ''){
			$yearData = trim(@$_POST['year']);		
			$yearArr = explode('#',$yearData);
			$year = $yearArr[1];
			
			
			if($exam == '2' || $exam == '3')
				$table = 'jee_main_adv_'.$year;
				
			$cast_data = $this->model_search->getCastCategoryFromTable($table);		
		}
		$this->data['cast_data'] = $cast_data;
		#get caste & table name - starts
		
		$collage_data = array();
		if($exam != ''){
			$collage_data = $this->model_search->getCollageFromTable($table,$_POST);	
		}
		$this->data['collage_data'] = $collage_data;
		
		//echo '<pre>'; print_r($_POST); echo '</pre>';
		$this->data['post_data'] = $_POST;

		$this->render_template('search/index', $this->data);
	}
	
	public function getAjaxData()
	{		
		//echo '<pre>'; print_r($_POST); echo '</pre>';
		$type = trim($_POST['type']);
		$id = trim($_POST['id']);
		
		if($type == 'exam'){
			$exam_data = $this->model_search->getExamData($id);
			//echo '<pre>'; print_r($exam_data); echo '</pre>';die;
			$strSel = '<label for="groups" class="bmd-label-floating">Exam</label>';
			$strSel .= '<select class="form-control" id="exam" name="exam" style="width:100%" onchange="getAjaxData(\'cast_category\',this.value);">';
			$strSel .= '<option value="">Select Exam</option>';
			if(count($exam_data) > 0){
				foreach($exam_data as $data){
					$strSel .= '<option value="'.$data['exam_id'].'">'.$data['name'].'</option>';
				}
			}		
			$strSel .= '</select>';	
			$response['data'] = $strSel;
			echo json_encode($response);
		}
		else if($type == 'cast_category'){
			//If id = 2 (JEE-Main), 3 (JEE-Adv)
			$yearData = trim($_POST['year']);
			$yearArr = explode('#',$yearData);
			$year = $yearArr[1];
			
			$table = '';
			if($id == '2' || $id == '3')
				$table = 'jee_main_adv_'.$year;
				
			$cast_data = $this->model_search->getCastCategoryFromTable($table);
			//echo '<pre>'; print_r($cast_data); echo '</pre>';die;
			$strSel = '<label for="groups" class="bmd-label-floating">Cast Category</label>';
			$strSel .= '<select class="form-control" id="cast" name="cast" style="width:100%">';
			$strSel .= '<option value="">Select Category</option>';
			if(count($cast_data) > 0){
				foreach($cast_data as $k => $data){
					$strSel .= '<option value="'.$data['cast'].'">'.$data['cast'].'</option>';
				}
			}		
			$strSel .= '</select>';	
			$response['data'] = $strSel;
			echo json_encode($response);
		}
		
		/*$response['success'] = true;
    	$response['messages'] = 'Error please refresh the page again!!';
		echo json_encode($response);*/
	}
	
	
	public function info()
	{
		/*if(!in_array('viewUser', $this->permission)) {
            redirect('dashboard', 'refresh');
        }*/
		$this->data['js'] = 'application/views/search/info-js.php';
		
		$year_data = $this->model_search->getActiveYear();
		$this->data['year_data'] = $year_data;
		
		$yearData = trim(@$_POST['year']);	
		$table_data = array();
		if($yearData != ''){
			$yearArr = explode('#',$yearData);
			$year = $yearArr[1];
			$table_data = $this->model_search->getTables($year);			
		}
		$this->data['table_data'] = $table_data;		
		
		if(@$_POST['btn_update_data'] == 'update_data'){
			$this->model_search->updateCollageIntakeData($_POST);
			$this->session->set_flashdata('success', 'All collages data updated successfully.');
        	//redirect('search/info', 'refresh');
		}
		
		$table = trim(@$_POST['table']);
		$update_data = array();
		if($table != ''){
			$update_data = $this->model_search->getDataToUpdate($table);			
		}
		$this->data['update_data'] = $update_data;
		
		//echo '<pre>'; print_r($_POST); echo '</pre>';
		$this->data['post_data'] = $_POST;

		$this->render_template('search/info', $this->data);
	}


}