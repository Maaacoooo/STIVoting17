<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Vote extends CI_Controller {

	public function __construct()	{
		parent::__construct();		
       $this->load->model('vote_model');
       $this->load->model('candidates_model');
       $this->load->model('settings_model');
	}	


	public function index()		{

		if($this->session->userdata('voter_logged_in'))	{

			$data['title'] = 'Vote now!';
			$data['site_title'] = APP_NAME;

			$data['positions'] = $this->candidates_model->fetch_votable();

			$this->form_validation->set_rules('vote[]', 'Vote', 'trim|required');   

			if($this->form_validation->run() == FALSE)	{

				$this->load->view('vote/voting_page', $data); 

			} else {

				$vote = $this->input->post('vote[]');
				$user = $this->session->userdata('voter_logged_in')['votepass'];

				if($this->vote_model->submit_vote($vote, $user)) {
					//Change vote pass status
					$this->vote_model->used_votepass($user);
					//Logs out user 
					$this->session->unset_userdata('voter_logged_in');
					//redirect
					redirect('vote/success', 'refresh');
				} else {					
					//Logs out user 
					$this->session->unset_userdata('voter_logged_in');
					//redirect
					redirect('vote/error', 'refresh');
				}
				
				//redirect('vote/instructions', 'refresh');
			}

		} else {

			$this->session->set_flashdata('error', 'You need a Vote Pass!');
			redirect('login', 'refresh');
		}

	}

	public function success()		{

		$data['title'] = 'Vote Success!';
		$data['site_title'] = APP_NAME;

		$data['page_data'] = $this->settings_model->setting('vote_success');		

		$this->load->view('vote/vote_success', $data);

	}

	public function error()		{

		$data['title'] = 'Error Occured!';
		$data['site_title'] = APP_NAME;

		$data['page_data'] = $this->settings_model->setting('vote_error');

		$this->load->view('vote/vote_error', $data);

	}

	public function instructions()		{

		if($this->session->userdata('voter_logged_in'))	{

			$data['title'] = 'General Instructions';
			$data['site_title'] = APP_NAME;

			$data['page_data'] = $this->settings_model->setting('vote_instruc');

			$this->load->view('vote/vote_instructions', $data);			

		} else {

			$this->session->set_flashdata('error', 'You need a Vote Pass!');
			redirect('login', 'refresh');
		}

	}

	

	public function logout() {
		$this->session->set_flashdata('success', 'Nice! You can still vote later!');
		$this->session->unset_userdata('voter_logged_in');		  
		redirect('login', 'refresh');
	}
}
