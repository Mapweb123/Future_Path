<?php 

class Masters extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();
		
		$this->data['page_title'] = 'Masters';
		//$this->load->model('model_masters');
		$this->load->model('model_aspirantyear');
		$this->load->model('model_streams');
		$this->load->model('Model_exams');
		$this->load->model('Model_feestype');
		$this->load->model('model_category');		
	}
	
	/*--------- Aspirant Year Functions START----------*/
	
	public function aspirantyear() {
		if(!in_array('viewMaster', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
		$this->data['js'] = 'application/views/masters/aspirantyear-js.php';
		$this->render_template('masters/aspirantyear', $this->data);
	}

	public function createAspirantYear() {
		if(!in_array('createMaster', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		$this->form_validation->set_rules('aspirantyear_name', 'Aspirant Year', 'trim|required');
		$this->form_validation->set_rules('active', 'Active', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'title' => $this->input->post('aspirantyear_name'),
        		'status' => $this->input->post('active'),	
        	);
            
			$checkIfExists = $this->model_aspirantyear->checkIfExists($data['title']);
			if((int)$checkIfExists === 0 ) {
				$create = $this->model_aspirantyear->create($data);
				if($create == true) {
					$response['success'] = true;
					$response['messages'] = 'Succesfully created';
				}
				else {
					$response['success'] = false;
					$response['messages'] = 'Error in the database while creating the brand information';			
				}
			} else {
				$response['success']  = false;
				$response['messages'] = 'Record Already Exists..';
			}
        }
        else {
        	$response['success'] = false;
        	foreach ($_POST as $key => $value) {
        		$response['messages'][$key] = form_error($key);
        	}
        }

        echo json_encode($response);
	}
	
	public function fetchAspirantYearData()
	{
		if(!in_array('viewMaster', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$result = array('data' => array());

		$data = $this->model_aspirantyear->getAspirantYearData();

		foreach ($data as $key => $value) {
			// button
			$buttons = '';

			if(in_array('updateMaster', $this->permission)) {
				$buttons = '<button type="button" class="btn btn-default" onclick="editFunc('.$value['aspirant_year_id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit"></i></button>';
			}

			if(in_array('deleteMaster', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['aspirant_year_id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			}

			$status = ($value['status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

			$result['data'][$key] = array(
				$value['title'],
				$status,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}
    
	public function fetchAspirantYearDataById($id = null)
	{
		if($id) {
			$data = $this->model_aspirantyear->getAspirantYearData($id);
			echo json_encode($data);
		}
		
	}
	
	public function updateAspirantYear($id)
	{
		if(!in_array('updateMaster', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		if($id) {
			$this->form_validation->set_rules('edit_aspirantyear_name', 'Aspirant Year', 'trim|required');
			$this->form_validation->set_rules('edit_active', 'Active', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		'title' => $this->input->post('edit_aspirantyear_name'),
        			'status' => $this->input->post('edit_active'),	
	        	);
                
				$checkIfExists = $this->model_aspirantyear->checkIfExists($data['title']);
				if((int)$checkIfExists === 0 ) {
					$update = $this->model_aspirantyear->update($id, $data);
					if($update == true) {
						$response['success'] = true;
						$response['messages'] = 'Succesfully updated';
					}
					else {
						$response['success'] = false;
						$response['messages'] = 'Error in the database while updated the brand information';			
					}
				} else {
					$response['success']  = false;
					$response['messages'] = 'Record Already Exists..';
				}
	        }
	        else {
	        	$response['success'] = false;
	        	foreach ($_POST as $key => $value) {
	        		$response['messages'][$key] = form_error($key);
	        	}
	        }
		}
		else {
			$response['success'] = false;
    		$response['messages'] = 'Error please refresh the page again!!';
		}

		echo json_encode($response);
	}
	
	
	public function index()
	{
		if(!in_array('viewMaster', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        $this->data['js'] = 'application/views/masters/index-js.php';
		$this->render_template('masters/index', $this->data);
	}

	public function removeAspirantYear()
	{
		if(!in_array('deleteMaster', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$ay_id = $this->input->post('id');

		$response = array();
		if($ay_id) {
			$delete = $this->model_aspirantyear->remove($ay_id);
			if($delete == true) {
				$response['success'] = true;
				$response['messages'] = "Successfully removed";	
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while removing the brand information";
			}
		}
		else {
			$response['success'] = false;
			$response['messages'] = "Refersh the page again!!";
		}

		echo json_encode($response);
	}
	
	/*--------- Aspirant Year Functions END----------*/
	
	/*--------- Streams Functions START----------*/
	public function streams() {
		if(!in_array('viewMaster', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
		$this->data['js'] = 'application/views/masters/streams/streams-js.php';
		$this->render_template('masters/streams/index', $this->data);
	}
	
	public function fetchStreamData()
	{
		if(!in_array('viewMaster', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$result = array('data' => array());

		$data = $this->model_streams->getStreamData();

		foreach ($data as $key => $value) {
			// button
			$buttons = '';

			if(in_array('updateMaster', $this->permission)) {
				$buttons = '<button type="button" class="btn btn-default" onclick="editFunc('.$value['stream_id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit"></i></button>';
			}

			if(in_array('deleteMaster', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['stream_id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			}

			$status = ($value['status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

			$result['data'][$key] = array(
				$value['name'],
				$status,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}
	
	public function createStream() {
		if(!in_array('createMaster', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		$this->form_validation->set_rules('stream_name', 'Stream', 'trim|required');
		$this->form_validation->set_rules('active', 'Active', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'name' => $this->input->post('stream_name'),
        		'status' => $this->input->post('active'),	
        	);
            
			$checkIfExists = $this->model_streams->checkIfExists($data['name']);
			if((int)$checkIfExists === 0 ) {
				$create = $this->model_streams->create($data);
				if($create == true) {
					$response['success'] = true;
					$response['messages'] = 'Succesfully created';
				}
				else {
					$response['success'] = false;
					$response['messages'] = 'Error in the database while creating the brand information';			
				}
			} else {
				$response['success']  = false;
				$response['messages'] = 'Record Already Exists..';
			}
        }
        else {
        	$response['success'] = false;
        	foreach ($_POST as $key => $value) {
        		$response['messages'][$key] = form_error($key);
        	}
        }

        echo json_encode($response);
	}
	
	public function fetchStreamDataById($id = null)
	{
		if($id) {
			$data = $this->model_streams->getStreamData($id);
			echo json_encode($data);
		}
		
	}
	
	public function updateStream($id)
	{
		if(!in_array('updateMaster', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		if($id) {
			$this->form_validation->set_rules('edit_stream_name', 'Stream', 'trim|required');
			$this->form_validation->set_rules('edit_active', 'Active', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		'name'   => $this->input->post('edit_stream_name'),
        			'status' => $this->input->post('edit_active'),	
	        	);
                
				$checkIfExists = $this->model_streams->checkIfExists($data['name']);
				if((int)$checkIfExists === 0 ) {
					$update = $this->model_streams->update($id, $data);
					if($update == true) {
						$response['success'] = true;
						$response['messages'] = 'Succesfully updated';
					}
					else {
						$response['success'] = false;
						$response['messages'] = 'Error in the database while updated the brand information';			
					}
				} else {
					$response['success']  = false;
					$response['messages'] = 'Record Already Exists..';
				}
	        }
	        else {
	        	$response['success'] = false;
	        	foreach ($_POST as $key => $value) {
	        		$response['messages'][$key] = form_error($key);
	        	}
	        }
		}
		else {
			$response['success'] = false;
    		$response['messages'] = 'Error please refresh the page again!!';
		}

		echo json_encode($response);
	}
	
	public function removeStream()
	{
		if(!in_array('deleteMaster', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$stream_id = $this->input->post('id');

		$response = array();
		if($stream_id) {
			$delete = $this->model_streams->remove($stream_id);
			if($delete == true) {
				$response['success'] = true;
				$response['messages'] = "Successfully removed";	
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while removing the brand information";
			}
		}
		else {
			$response['success'] = false;
			$response['messages'] = "Refersh the page again!!";
		}

		echo json_encode($response);
	}
	
	/*--------- Streams Functions END----------*/
	
	/*--------- Exams Functions START----------*/
	
	public function exams() {
		if(!in_array('viewMaster', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
		$this->data['js']      = 'application/views/masters/exams/exams-js.php';
		$this->data['streams'] = $this->model_streams->getStreamData();
		$this->render_template('masters/exams/index', $this->data);
	}
	
	public function fetchExamData()
	{
		if(!in_array('viewMaster', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$result = array('data' => array());

		$data = $this->Model_exams->getExamData();

		foreach ($data as $key => $value) {
			// button
			$buttons = '';

			if(in_array('updateMaster', $this->permission)) {
				$buttons = '<button type="button" class="btn btn-default" onclick="editFunc('.$value['exam_id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit"></i></button>';
			}

			if(in_array('deleteMaster', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['exam_id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			}

			$status = ($value['status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

			$result['data'][$key] = array(
				$value['name'],
				$value['stream_name'],
				$status,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}
	
	public function createExam() {
		if(!in_array('createMaster', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		$this->form_validation->set_rules('exam_name', 'Exam Name', 'trim|required');
        $this->form_validation->set_rules('stream_name', 'Stream Name', 'trim|required');
		$this->form_validation->set_rules('active', 'Active', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'name'      => $this->input->post('exam_name'),
                'stream_id' => $this->input->post('stream_name'),
        		'status'    => $this->input->post('active'),	
        	);
            
			$checkIfExists = $this->Model_exams->checkIfExists($data['name']);
			if((int)$checkIfExists === 0 ) {
				$create = $this->Model_exams->create($data);
				if($create == true) {
					$response['success'] = true;
					$response['messages'] = 'Succesfully created';
				}
				else {
					$response['success'] = false;
					$response['messages'] = 'Error in the database while creating the brand information';			
				}
			} else {
				$response['success']  = false;
				$response['messages'] = 'Record Already Exists..';
			}
        }
        else {
        	$response['success'] = false;
        	foreach ($_POST as $key => $value) {
        		$response['messages'][$key] = form_error($key);
        	}
        }

        echo json_encode($response);
	}
	
	public function updateExam($id)
	{
		if(!in_array('updateMaster', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		if($id) {
            $this->form_validation->set_rules('edit_exam_name', 'Exam Name', 'trim|required');
			$this->form_validation->set_rules('edit_stream_name', 'Exam', 'trim|required');
			$this->form_validation->set_rules('edit_active', 'Active', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		'name'   => $this->input->post('edit_exam_name'),
                    'stream_id'   => $this->input->post('edit_stream_name'),
        			'status' => $this->input->post('edit_active'),	
	        	);
                
				$checkIfExists = $this->Model_exams->checkIfExists($data['name']);
				if((int)$checkIfExists === 0 ) {
					$update = $this->Model_exams->update($id, $data);
					if($update == true) {
						$response['success'] = true;
						$response['messages'] = 'Succesfully updated';
					}
					else {
						$response['success'] = false;
						$response['messages'] = 'Error in the database while updated the brand information';			
					}
				} else {
					$response['success']  = false;
					$response['messages'] = 'Record Already Exists..';
				}
	        }
	        else {
	        	$response['success'] = false;
	        	foreach ($_POST as $key => $value) {
	        		$response['messages'][$key] = form_error($key);
	        	}
	        }
		}
		else {
			$response['success'] = false;
    		$response['messages'] = 'Error please refresh the page again!!';
		}

		echo json_encode($response);
	}
	
	public function removeExam()
	{
		if(!in_array('deleteMaster', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$exam_id = $this->input->post('id');

		$response = array();
		if($exam_id) {
			$delete = $this->Model_exams->remove($exam_id);
			if($delete == true) {
				$response['success'] = true;
				$response['messages'] = "Successfully removed";	
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while removing the brand information";
			}
		}
		else {
			$response['success'] = false;
			$response['messages'] = "Refersh the page again!!";
		}

		echo json_encode($response);
	}
	
	public function fetchExamDataById($id = null)
	{
		if($id) {
			$data = $this->Model_exams->getExamData($id);
			echo json_encode($data);
		}
		
	}
	/*--------- Exams Functions END----------*/
	
	/*--------- FEES TYPE Functions START----------*/
	public function feestype() {
		if(!in_array('viewMaster', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
		$this->data['js'] = 'application/views/masters/feestype/feestype-js.php';
		$this->render_template('masters/feestype/index', $this->data);
	}
	
	public function fetchFeestypeData()
	{
		if(!in_array('viewMaster', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$result = array('data' => array());

		$data = $this->Model_feestype->getFeestypeData();

		foreach ($data as $key => $value) {
			// button
			$buttons = '';

			if(in_array('updateMaster', $this->permission)) {
				$buttons = '<button type="button" class="btn btn-default" onclick="editFunc('.$value['fees_id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit"></i></button>';
			}

			if(in_array('deleteMaster', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['fees_id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			}

			$status = ($value['status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

			$result['data'][$key] = array(
				$value['name'],
				$value['amount'],
				$status,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}
	
	public function createFeestype() {
		if(!in_array('createMaster', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		$this->form_validation->set_rules('feestype_name', 'Feestype Name', 'trim|required');
        $this->form_validation->set_rules('amount', 'Amount', 'trim|required');
		$this->form_validation->set_rules('active', 'Active', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'name'      => $this->input->post('feestype_name'),
                'amount'    => $this->input->post('amount'),
        		'status'    => $this->input->post('active'),	
        	);
			$checkIfExists = $this->Model_feestype->checkIfExists($data['name']);
			if((int)$checkIfExists === 0 ) {
				$create = $this->Model_feestype->create($data);
				if($create == true) {
					$response['success']  = true;
					$response['messages'] = 'Succesfully created';
				}
				else {
					$response['success']  = false;
					$response['messages'] = 'Error in the database while creating the Fees Type information';			
				}
			} else {
				$response['success']  = false;
				$response['messages'] = 'Record Already Exists..';
			}
        }
        else {
        	$response['success'] = false;
        	foreach ($_POST as $key => $value) {
        		$response['messages'][$key] = form_error($key);
        	}
        }

        echo json_encode($response);
	}
	
	public function updateFeestype($id)
	{
		if(!in_array('updateMaster', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		if($id) {
            $this->form_validation->set_rules('edit_feestype_name', 'Feestype Name', 'trim|required');
			$this->form_validation->set_rules('edit_amount', 'Amount', 'trim|required');
			$this->form_validation->set_rules('edit_active', 'Active', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		'name'    => $this->input->post('edit_feestype_name'),
                    'amount'  => $this->input->post('edit_amount'),
        			'status'  => $this->input->post('edit_active'),	
	        	);
                
				$checkIfExists = $this->Model_feestype->checkIfExists($data['name']);
				if((int)$checkIfExists === 0 ) {
					$update = $this->Model_feestype->update($id, $data);
					if($update == true) {
						$response['success'] = true;
						$response['messages'] = 'Succesfully updated';
					}
					else {
						$response['success'] = false;
						$response['messages'] = 'Error in the database while updated the brand information';			
					}
				} else {
					$response['success']  = false;
					$response['messages'] = 'Record Already Exists..';
				}
	        }
	        else {
	        	$response['success'] = false;
	        	foreach ($_POST as $key => $value) {
	        		$response['messages'][$key] = form_error($key);
	        	}
	        }
		}
		else {
			$response['success'] = false;
    		$response['messages'] = 'Error please refresh the page again!!';
		}

		echo json_encode($response);
	}
	
	public function removeFeestype()
	{
		if(!in_array('deleteMaster', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$feestype_id = $this->input->post('id');

		$response = array();
		if($feestype_id) {
			$delete = $this->Model_feestype->remove($feestype_id);
			if($delete == true) {
				$response['success'] = true;
				$response['messages'] = "Successfully removed";	
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while removing the brand information";
			}
		}
		else {
			$response['success'] = false;
			$response['messages'] = "Refersh the page again!!";
		}

		echo json_encode($response);
	}
	
	public function fetchFeestypeDataById($id = null)
	{
		if($id) {
			$data = $this->Model_feestype->getFeestypeData($id);
			echo json_encode($data);
		}
		
	}	
	/*--------- FEES TYPE Functions END----------*/
    
		/*--------- Category Functions START----------*/
	public function category() {
		if(!in_array('viewMaster', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
		$this->data['js'] = 'application/views/masters/category/category-js.php';
		$this->render_template('masters/category/index', $this->data);
	}
	
	public function fetchCategoryData()
	{
		if(!in_array('viewMaster', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$result = array('data' => array());

		$data = $this->model_category->getCategoryData();

		foreach ($data as $key => $value) {
			// button
			$buttons = '';

			if(in_array('updateMaster', $this->permission)) {
				$buttons = '<button type="button" class="btn btn-default" onclick="editFunc('.$value['cat_id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit"></i></button>';
			}

			if(in_array('deleteMaster', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['cat_id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			}

			$status = ($value['status'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

			$result['data'][$key] = array(
				$value['name'],
				$status,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}
	
	public function createCategory() {
		if(!in_array('createMaster', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		$this->form_validation->set_rules('category_name', 'Category', 'trim|required');
		$this->form_validation->set_rules('active', 'Active', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'name' => $this->input->post('category_name'),
        		'status' => $this->input->post('active'),	
        	);
            
			$checkIfExists = $this->model_category->checkIfExists($data['name']);
			if((int)$checkIfExists === 0 ) {
				$create = $this->model_category->create($data);
				if($create == true) {
					$response['success'] = true;
					$response['messages'] = 'Succesfully created';
				}
				else {
					$response['success'] = false;
					$response['messages'] = 'Error in the database while creating the brand information';			
				}
			} else {
				$response['success']  = false;
				$response['messages'] = 'Record Already Exists..';
			}
        }
        else {
        	$response['success'] = false;
        	foreach ($_POST as $key => $value) {
        		$response['messages'][$key] = form_error($key);
        	}
        }

        echo json_encode($response);
	}
	
	public function fetchCategoryDataById($id = null)
	{
		if($id) {
			$data = $this->model_category->getCategoryData($id);
			echo json_encode($data);
		}
		
	}
	
	public function updateCategory($id)
	{
		if(!in_array('updateMaster', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		if($id) {
			$this->form_validation->set_rules('edit_category_name', 'Category', 'trim|required');
			$this->form_validation->set_rules('edit_active', 'Active', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		'name'   => $this->input->post('edit_category_name'),
        			'status' => $this->input->post('edit_active'),	
	        	);
                
				$checkIfExists = $this->model_category->checkIfExists($data['name']);
				if((int)$checkIfExists === 0 ) {
					$update = $this->model_category->update($id, $data);
					if($update == true) {
						$response['success'] = true;
						$response['messages'] = 'Succesfully updated';
					}
					else {
						$response['success'] = false;
						$response['messages'] = 'Error in the database while updated the brand information';			
					}
				} else {
					$response['success']  = false;
					$response['messages'] = 'Record Already Exists..';
				}
	        }
	        else {
	        	$response['success'] = false;
	        	foreach ($_POST as $key => $value) {
	        		$response['messages'][$key] = form_error($key);
	        	}
	        }
		}
		else {
			$response['success'] = false;
    		$response['messages'] = 'Error please refresh the page again!!';
		}

		echo json_encode($response);
	}
	
	public function removeCategory()
	{
		if(!in_array('deleteMaster', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$catgeory_id = $this->input->post('id');

		$response = array();
		if($catgeory_id) {
			$delete = $this->model_category->remove($catgeory_id);
			if($delete == true) {
				$response['success'] = true;
				$response['messages'] = "Successfully removed";	
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while removing the brand information";
			}
		}
		else {
			$response['success'] = false;
			$response['messages'] = "Refersh the page again!!";
		}

		echo json_encode($response);
	}
	
	/*--------- Category Functions END----------*/
}