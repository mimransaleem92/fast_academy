<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Unpaid_collection extends Base_Controller{

	function Unpaid_collection()
	{
		parent::__construct();
		if (!$this->session->userdata(SESSION_CONST_PRE.'userId'))
		{
			redirect('login', 'refresh');
		}
		$this->load->model('Collect_fees_model','',TRUE);
		
	}
		
	function index(){
		$this->data['courses_list'] = Base_model::get_all_courses();
		$this->load_template('settings/collect_fees/default');
	}
	
	public function collection(){
		$params = $this->uri->segment(3);
		$this->data['fee_collection_list'] = $this->Collect_fees_model->get_fee_collection_by_batch($params);
	
		$this->load->view('common/dropdown/collection',$this->data);
	}
	
	function student_collect_fee(){
		$id = $this->uri->segment(3);
		$bid = $_POST['batch_id'];
		$arr = explode('-', $_POST['combine_id']);
		$collection_id = $arr[0];
		$category_id = $arr[1];
		$this->data['fee_collection_id'] = $collection_id;
		$this->data['fee_particular_list'] = $this->Collect_fees_model->get_fee_particulars($category_id);
		$this->data['student_list'] = $this->Collect_fees_model->get_students_unpaid_list($collection_id, $bid);
		
		$this->load->view('settings/collect_fees/unpaid_collection_list',$this->data);
	}
	
	function add(){
		$this->index();
	}
	
	function edit(){
		$this->index();
	}
	
	function update(){
		$this->Fee_collection_model->update();
		$config['base_url'] = base_url().'index.php/fee_collection/';
		redirect('fee_collection','location');
	}
	
	function delete(){
		if(isset($_GET['selected_id']) && !empty($_GET['selected_id'])){
			$this->Fee_collection_model->delete($_GET['selected_id']);
			redirect('fee_collection','location');
		}
	}
}