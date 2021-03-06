<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Candidates extends CI_Controller {

	public function __construct()	{
		parent::__construct();		
       $this->load->model('user_model');
       $this->load->model('candidates_model');
	}	



	public function index()		{

		$userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

		if($userdata)	{

			$data['title'] 		= 'Candidates';
			$data['site_title'] = APP_NAME;
			$data['user'] 		= $this->user_model->userdetails($userdata['username']); //fetches users record

			//Page Data 
			$data['years']		= $this->candidates_model->years();
			$data['courses']	= $this->candidates_model->courses();
			$data['party']		= $this->candidates_model->party();
			$data['positions']	= $this->candidates_model->positions();

			//Paginated data - Candidate Names				            
	   		$config['num_links'] = 5;
			$config['base_url'] = base_url('/sys/candidates/index/');
			$config["total_rows"] = $this->candidates_model->count_candidates();
			$config['per_page'] = 10;				
			$this->load->config('pagination'); //LOAD PAGINATION CONFIG

			$this->pagination->initialize($config);
		    if($this->uri->segment(4)){
		       $page = ($this->uri->segment(4)) ;
		  	}	else 	{
		       $page = 1;		               
		    }

		    $data["results"] = $this->candidates_model->fetch_candidates($config["per_page"], $page);
		    $str_links = $this->pagination->create_links();
		    $data["links"] = explode('&nbsp;',$str_links );

		    //ITEM NUMBERING
		    $data['per_page'] = $config['per_page'];
		    $data['page'] = $page;

		    //GET TOTAL RESULT
		    $data['total_result'] = $config["total_rows"];
		    //END PAGINATION

		    //the action key
		    $key = $this->encryption->decrypt($this->input->post('key'));

			if($key == 'candidate') {
				//Form Validation for candidate
				$this->form_validation->set_rules('name', 'Name', 'trim|required'); 
				$this->form_validation->set_rules('party', 'Partylist', 'trim|required'); 
				$this->form_validation->set_rules('course', 'Courses', 'trim|required'); 
				$this->form_validation->set_rules('year', 'Year', 'trim|required'); 
			} elseif($key == 'partylist') {
				//Form Validation for partylist
				$this->form_validation->set_rules('title', 'Title', 'trim|required'); 
				$this->form_validation->set_rules('color', 'color', 'trim|required'); 
			}

			if($this->form_validation->run() == FALSE)	{
				$this->load->view('admin/voting/candidate/list', $data);
			} else {		

				if($key == 'candidate') {
					//Proceed saving candidate				
					if($this->candidates_model->create_candidate()) {			
				
						$this->session->set_flashdata('success', 'Succes! Candidate registered!');
						redirect($_SERVER['HTTP_REFERER'], 'refresh');
					} else {
						//failure
						$this->session->set_flashdata('error', 'Oops! Error occured!');
						redirect($_SERVER['HTTP_REFERER'], 'refresh');
					}

				} elseif($key == 'partylist') {
					//Proceed saving partylist				
					if($this->candidates_model->create_partylist()) {			
				
						$this->session->set_flashdata('success', 'Succes! Partylist registered!');
						redirect($_SERVER['HTTP_REFERER'], 'refresh');
					} else {
						//failure
						$this->session->set_flashdata('error', 'Oops! Error occured!');
						redirect($_SERVER['HTTP_REFERER'], 'refresh');
					}

				}
				
			}

		} else {

			$this->session->set_flashdata('error', 'You need to login!');
			redirect('sys/dashboard/login', 'refresh');
		}

	}

	public function update($id)		{

		$userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

		if($userdata)	{

			$data['title'] = 'Update Candidate';
			$data['site_title'] = APP_NAME;
			$data['user'] = $this->user_model->userdetails($userdata['username']); //fetches users record

			//Page Data 
			$data['years']		= $this->candidates_model->years();
			$data['courses']	= $this->candidates_model->courses();
			$data['party']		= $this->candidates_model->party();
			$data['positions']	= $this->candidates_model->positions();

			$data['info']		= $this->candidates_model->read_candidate($id);		

			//Validate if record exist
			 //IF NO ID OR NO RESULT, REDIRECT
				if(!$id OR !$data['info']) {
					redirect('sys/candidates', 'refresh');
			}	

			//Form Validation for candidate
			$this->form_validation->set_rules('name', 'Name', 'trim|required'); 
			$this->form_validation->set_rules('party', 'Partylist', 'trim|required'); 
			$this->form_validation->set_rules('course', 'Courses', 'trim|required'); 
			$this->form_validation->set_rules('year', 'Year', 'trim|required'); 
			$this->form_validation->set_rules('id', 'ID', 'trim|required'); 
		

			if($this->form_validation->run() == FALSE)	{
				$this->load->view('admin/voting/candidate/update', $data);
			} else {			

				//Proceed saving candidate				
				$key_id = $this->encryption->decrypt($this->input->post('id')); //ID of the row
				if($this->candidates_model->update_candidate($key_id)) {			
				
					$this->session->set_flashdata('success', 'Succes! Candidate Updated!');
					redirect($_SERVER['HTTP_REFERER'], 'refresh');
				} else {
					//failure
					$this->session->set_flashdata('error', 'Oops! Error occured!');
					redirect($_SERVER['HTTP_REFERER'], 'refresh');
				}			
				
			}			

		} else {

			$this->session->set_flashdata('error', 'You need to login!');
			redirect('sys/dashboard/login', 'refresh');
		}

	}


	public function delete()		{

		$userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

		if($userdata)	{

			//FORM VALIDATION
			$this->form_validation->set_rules('id', 'ID', 'trim|required');   
		 
		   if($this->form_validation->run() == FALSE)	{

				$this->session->set_flashdata('error', 'An Error has Occured!');
				redirect($_SERVER['HTTP_REFERER'], 'refresh');

			} else {

				$key_id = $this->encryption->decrypt($this->input->post('id')); //ID of the row				

				if($this->candidates_model->delete_candidate($key_id)) {
					$this->session->set_flashdata('success', 'Deleted!');
					redirect($_SERVER['HTTP_REFERER'], 'refresh');
				}
			}

		} else {

			$this->session->set_flashdata('error', 'You need to login!');
			redirect('sys/dashboard/login', 'refresh');
		}

	}


	public function delete_party()		{

		$userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

		if($userdata)	{

			//FORM VALIDATION
			$this->form_validation->set_rules('id', 'ID', 'trim|required');   
		 
		   if($this->form_validation->run() == FALSE)	{

				$this->session->set_flashdata('error', 'An Error has Occured!');
				redirect($_SERVER['HTTP_REFERER'], 'refresh');

			} else {

				$key_id = $this->encryption->decrypt($this->input->post('id')); //ID of the row				

				if($this->candidates_model->delete_party($key_id)) {
					$this->session->set_flashdata('success', 'Deleted!');
					redirect($_SERVER['HTTP_REFERER'], 'refresh');
				}
			}

		} else {

			$this->session->set_flashdata('error', 'You need to login!');
			redirect('sys/dashboard/login', 'refresh');
		}

	}


	public function update_party()		{

		$userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

		if($userdata)	{

			//FORM VALIDATION
			$this->form_validation->set_rules('id', 'ID', 'trim|required');   
		 
		   if($this->form_validation->run() == FALSE)	{

				$this->session->set_flashdata('error', 'An Error has Occured!');
				redirect($_SERVER['HTTP_REFERER'], 'refresh');

			} else {

				$key_id = $this->encryption->decrypt($this->input->post('id')); //ID of the row				

				if($this->candidates_model->update_party($key_id)) {
					$this->session->set_flashdata('success', 'Party Updated!');
					redirect($_SERVER['HTTP_REFERER'], 'refresh');
				}
			}

		} else {

			$this->session->set_flashdata('error', 'You need to login!');
			redirect('sys/dashboard/login', 'refresh');
		}

	}



}
