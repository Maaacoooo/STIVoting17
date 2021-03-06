<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Voting extends CI_Controller {

	public function __construct()	{
		parent::__construct();		
       $this->load->model('user_model');
       $this->load->model('candidates_model');
       $this->load->model('vote_model');
       $this->load->model('settings_model');
	}	


	public function index()		{

		$userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

		if($userdata)	{

			$data['title'] = 'Dashboard';
			$data['site_title'] = APP_NAME;
			$data['user'] = $this->user_model->userdetails($userdata['username']); //fetches users record


			$this->load->view('admin/blank', $data);

		} else {

			$this->session->set_flashdata('error', 'You need to login!');
			redirect('sys/dashboard/login', 'refresh');
		}

	}


	public function voting_passes()		{

		$userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

		if($userdata)	{

			$data['title'] = 'Voting Passes';
			$data['site_title'] = APP_NAME;
			$data['user'] = $this->user_model->userdetails($userdata['username']); //fetches users record


			//Page Data 
			$data['passes'] = $this->vote_model->fetch_votepass('all'); //fetches all data
			$data['total_passes'] = $this->vote_model->count_votepass('all');
			$data['total_passUsed'] = $this->vote_model->count_votepass(1);

			//Form Validation for Modal
			$this->form_validation->set_rules('passes', 'Number of Vote Pass', 'trim|required|less_than_equal_to[5000]|greater_than[0]'); 

			if($this->form_validation->run() == FALSE)	{
				$this->load->view('admin/voting/voting_passes', $data);
			} else {

				//Clear Votes and Vote Pass Tables
				$this->vote_model->clear_votekeys();
				$this->vote_model->clear_votes();

				//Proceed saving 				
				if($this->vote_model->generate_key($this->input->post('passes'))) {			
			
					$this->session->set_flashdata('success', 'Success! Voting Passes Generated!');
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


	public function print_page()		{

		$userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

		if($userdata)	{

			$data['title'] = 'Voting Passes &middot; ' . date('Y-m-d');
			$data['site_title'] = APP_NAME;
			$data['user'] = $this->user_model->userdetails($userdata['username']); //fetches users record

			$data['passes'] = $this->vote_model->fetch_votepass('0'); //fetches all data


			$this->load->view('admin/voting/print_page', $data);

		} else {

			$this->session->set_flashdata('error', 'You need to login!');
			redirect('sys/dashboard/login', 'refresh');
		}

	}



	public function results() {

		$userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

		if($userdata)	{

			$data['title'] = 'Voting Results';
			$data['site_title'] = APP_NAME;
			$data['user'] = $this->user_model->userdetails($userdata['username']); //fetches users record

			$data['positions'] = $this->candidates_model->fetch_votable();			
			$data['total_passUsed'] = $this->vote_model->count_votepass(1);

			$this->load->view('admin/voting/voting_results', $data);

		} else {

			$this->session->set_flashdata('error', 'You need to login!');
			redirect('sys/dashboard/login', 'refresh');
		}
		
	}


	public function pages() {

		$userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

		if($userdata)	{

			
			$data['site_title'] = APP_NAME;
			$data['user'] = $this->user_model->userdetails($userdata['username']); //fetches users record

			$page_id = $this->uri->segment(4); // the page ID

			//If Page ID exist, show update form
			if($page_id) {

				$data['res'] = $this->settings_model->setting($page_id);		
				$data['title'] = $data['res']['title'];	
			
				$this->form_validation->set_rules('value', 'Content', 'trim'); 
				$this->form_validation->set_rules('title', 'Title', 'trim|required'); 
				$this->form_validation->set_rules('key', 'Key', 'trim|required'); 


				if($this->form_validation->run() == FALSE)	{
					$this->load->view('admin/voting/pages/update', $data);
				} else {			

					//Proceed saving 				
					$key = $this->encryption->decrypt($this->input->post('key')); //ID of the row
					$title = $this->input->post('title');
					$value = $this->input->post('value');

					if($this->settings_model->update_setting($key, $title, $value)) {			
				
						$this->session->set_flashdata('success', 'Succes! Page Updated!');
						redirect($_SERVER['HTTP_REFERER'], 'refresh');
					} else {
						//failure
						$this->session->set_flashdata('error', 'Oops! Error occured!');
						redirect($_SERVER['HTTP_REFERER'], 'refresh');
					}
					
				}

			} else {
				//show list
				$data['title'] = 'Pages';
				$data['results'] = $this->settings_model->fetch_settings('vote_page');	
				$this->load->view('admin/voting/pages/list', $data);

			}

			

		} else {

			$this->session->set_flashdata('error', 'You need to login!');
			redirect('sys/dashboard/login', 'refresh');
		}
		
	}


	public function settings() {

		$userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

		if($userdata)	{

			$data['title'] = 'Settings';
			$data['site_title'] = APP_NAME;
			$data['user'] = $this->user_model->userdetails($userdata['username']); //fetches users record

			$data['vote_results'] 	= $this->settings_model->setting('publish_vote_result');			
			$data['vote_status'] 	= $this->settings_model->setting('voting_status');			
			
			if($this->input->post('master')) {
				$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_user'); 
			}
			


			if($this->form_validation->run() == FALSE)	{
				$this->load->view('admin/voting/settings', $data);
			} else {	
				
				//For modals submission	
				$master = $this->encryption->decrypt($this->input->post('master'));

				if($master == 'clearvote') {

					$methods[] = $this->vote_model->clear_votekeys();
					$methods[] = $this->vote_model->clear_votes();	

					if($methods) {
						$this->session->set_flashdata('success', 'Success! Cleared all Votes and Passes!');
						redirect($_SERVER['HTTP_REFERER'], 'refresh');
					} else {
						$this->session->set_flashdata('error', 'Oops! Error occured!');
						redirect($_SERVER['HTTP_REFERER'], 'refresh');
					}

				} elseif($master == 'reset') {

					if($this->settings_model->reset_setting()) {
						$this->session->set_flashdata('success', 'Success! You have Resetted the Voting System!');
						redirect($_SERVER['HTTP_REFERER'], 'refresh');
					} else {
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

	function update_basic_setting() {

		//Switches Submission
		$method[] = $this->settings_model->update_setting('publish_vote_result', 'Publish Vote Results', $this->input->post('vote_results'));
		$method[] = $this->settings_model->update_setting('voting_status', 'Publish Vote Results', $this->input->post('vote_status'));
		
				if($method) {
					$this->session->set_flashdata('success', 'Success! Updated Setting');
					redirect($_SERVER['HTTP_REFERER'], 'refresh');
				} elseif($this->input->post('vote_status')) {

		}
				

	}


	public function check_user($password) {
		$username = $this->session->userdata('admin_logged_in')['username'];
		$result = $this->user_model->check_user($username, $password);

		if($result) {			
			return TRUE;
		} else {
			$this->form_validation->set_message('check_user', 'Incorrect Password!');
			return FALSE;
		}
	}




}
