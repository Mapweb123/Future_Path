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
		
		//echo '<pre>'; print_r($_POST); echo '</pre>';
		$this->data['post_data'] = $_POST;

		$this->render_template('search/index', $this->data);
	}


}