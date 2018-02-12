<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Collect_fees extends Base_Controller{

	function Collect_fees()
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
	
	function index11(){
		$limit = $this->uri->segment(2);  
		if(is_nan($limit)) $limit = 0;
		$this->display($limit);
	}
	
	function display($row = 0)// used for pagination 
	{
		$this->data['action_bar'] = array('add'=>'1','update'=>'0','delete'=>'1','edit'=>'1','save'=>'0','view'=>'1','confirm'=>'0','print'=>'0');
		$this->load->library('pagination');
		
		$config['base_url'] = base_url().'index.php/collect_fees/display/';
		$config['total_rows']=$this->Collect_fees_model->get_num_collect_fees();
		//$config['per_page']='5';
		$this->pagination->initialize($config);
		$this->data['batch_list']=$this->Collect_fees_model->get_all_collect_fees($row,TRUE);
		$this->data['links']=$this->pagination->create_links();
		$this->load_template('settings/collect_fees/default');
	}
	
	function batch_list(){
		
		$this->data['batch_list'] = $this->Collect_fees_model->get_all_collect_fees();
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
		$this->data['student_list'] = $this->Collect_fees_model->get_students_by_batch($collection_id, $bid);
		
		$this->load->view('settings/collect_fees/collection_list',$this->data);
	}
	
	public function clear_payment(){
		
		$amount = $this->uri->segment(3);
		$this->data['amount'] = $amount;
		$collection_id = 0;
		$student_id = 0;
		if(isset( $_GET['f']) && $_GET['f'] == 'insert'){
			if( isset( $_POST['student_id'] ) ){
				$collection_id = $_POST['fee_collection_id'];
				$student_id = $_POST['student_id'];
				$bid = $_POST['batch_id'];
			}
			$sibling = $this->Collect_fees_model->get_sibling_row($collection_id, $student_id);
			$this->data['dueAmount'] = $sibling[0]->due_amount;
			$this->data['fee_collection_id'] = $collection_id;
			$this->Collect_fees_model->clear_payment_by_collection();
			$this->data['student_list'] = $this->Collect_fees_model->get_students_by_batch($collection_id, $bid);
			$this->load->view('settings/collect_fees/student_payment_list',$this->data);
		}
		else {
			
			if( isset( $_GET['student_id'] ) ){
				$collection_id = $_GET['collection_id'];
				$student_id = $_GET['student_id'];
			}
			
			$this->data['student'] = $student_info = $this->Collect_fees_model->get_student_info($student_id);
			
			$sibling = $this->Collect_fees_model->get_sibling_row($collection_id, $student_id);
			if(!isset($sibling[0]) ){
				$deduct = ($student_info[0]->sibling_amount/100) * $amount;
				$this->Collect_fees_model->insert_sibling_row($collection_id, $student_id, $amount, $deduct);
			}
			$this->data['sibling'] = $sibling = $this->Collect_fees_model->get_sibling_row($collection_id, $student_id);
			$this->data['dueAmount'] = $sibling[0]->due_amount;
			$collection = $this->Collect_fees_model->get_collection_info($collection_id);
			$this->data['collection_name'] = $collection[0]->collection_name;
			$this->load->view('settings/collect_fees/payment_screen',$this->data);
		}
	}
	
	function payment_receipt(){
		$amount = $this->uri->segment(3);
		$this->data['amount'] = $amount;
		$collection_id = 0;
		$student_id = 0;
		if( isset( $_GET['student_id'] ) ){
			$collection_id = $_GET['collection_id'];
			$student_id = $_GET['student_id'];
		}
		$this->data['sibling'] = $this->Collect_fees_model->get_sibling_row($collection_id, $student_id);
		
		$this->data['student'] = $this->Collect_fees_model->get_student_info($student_id);
		$this->data['particular'] = $this->Collect_fees_model->get_fee_particulars_by_collection($collection_id);
		$this->load->view('settings/collect_fees/payment_receipt',$this->data);
	}
	
	function add(){
		$this->data['action_bar'] = array('add'=>'0','update'=>'0','delete'=>'0','edit'=>'0','save'=>'1','view'=>'0','confirm'=>'0','print'=>'0');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('course_id', 'Course Name','required');
		$this->form_validation->set_rules('batch_id', 'Batch Name','required');
		$this->form_validation->set_rules('collection_name', 'Collection Name','alfa_numeric|min_length[3]|required');
		
		if($this->form_validation->run() == TRUE){
			$this->Collect_fees_model->insert();
			redirect('collect_fees','location');
		}
		else
		{
			$id = $this->session->userdata('company_id');
			$this->data['fee_category_list'] = Base_model::get_fee_categories();
			$this->load_template('settings/collect_fees/add');
		} 
	}
	
	function edit(){
		$this->data['action_bar'] = array('add'=>'0','update'=>'','delete'=>'0','edit'=>'0','save'=>'1','view'=>'0','confirm'=>'0','print'=>'0');
		$this->load->helper('form');
		
		$id = $this->uri->segment(3);
		$record = $this->data['form'] = $this->Collect_fees_model->get_collect_fees($id);
		$params = $record[0]->course_id;
		$this->data['fee_category_list'] = Base_model::get_fee_categories();
		$this->load_template('settings/collect_fees/edit');
	}
	
	function update(){
		$this->Collect_fees_model->update();
		$config['base_url'] = base_url().'index.php/collect_fees/';
		redirect('collect_fees','location');
	}
	
	function delete(){
		if(isset($_GET['selected_id']) && !empty($_GET['selected_id'])){
			$this->Collect_fees_model->delete($_GET['selected_id']);
			redirect('collect_fees','location');
		}
	}
}