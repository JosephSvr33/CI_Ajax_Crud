<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {


	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function insert(){
	
				$input_data = array('Country_Name' => $this->input->post('country'), 
				'Country_Code' => $this->input->post('code'), 
				);
				$this->load->model('country_model');
			
					if ($this->country_model->insert($input_data)) {
						$data  = array('responce' => 'success', 'message' => 'Data Added Successfully');
					}
					else{
						$data  = array('responce' => 'error', 'message' => 'Operation Failed');
					}
					
              echo json_encode($data);
		

		
	}


	public function fetch()
	{
		if ($this->input->is_ajax_request()) {
			$posts = $this->country_model->getEntries();
			echo json_encode($posts);
		}
	}

	public function delete(){
		if ($this->input->is_ajax_request()) {
			$del = $this->input->post('id');

			if ($this->country_model->delete($del)) {
				$data = array('responce' => "success");
			}
			else{
				$data = array('responce' => "error");
			}
			echo json_encode($data);
		}
	}

	public function edit()
	{
		if ($this->input->is_ajax_request()) {
			$edt = $this->input->post('id');

			if ($post = $this->country_model->single_entry($edt)) {
				$data = array('responce' => "success", 'post' => $post);
			}
			else{
				$data = array('responce' => "error", 'message' => "failed");
			}
			echo json_encode($data);
		}
	}

	public function update(){

				$input_data = array(
					'Country_Id' => $this->input->post('id'),
					'Country_Name' => $this->input->post('country'), 
					'Country_Code' => $this->input->post('code'));
				$this->db->where('Country_Id',$this->input->post('id'));
				$this->load->model('country_model');
			
					if ($this->country_model->update($input_data)) {
						$data  = array('responce' => 'success', 'message' => 'Data Updated Successfully');
					}
					else{
						$data  = array('responce' => 'error', 'message' => 'Operation Failed');
					}
					
              echo json_encode($data);
	}
}
?>