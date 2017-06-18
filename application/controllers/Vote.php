<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vote extends CI_Controller {

	public function __construct()	{
		parent::__construct();		
       $this->load->model('vote_model');
	}	


	public function index()		{

		if($this->session->userdata('voter_logged_in'))	{

			$data['title'] = 'Vote now!';
			$data['site_title'] = APP_NAME;
			$this->load->view('vote/voting_page', $data);

		} else {

			$this->session->set_flashdata('error', 'You need a Vote Pass!');
			redirect('login', 'refresh');
		}

	}

	public function success()		{

		$data['title'] = 'Vote Success!';
		$data['site_title'] = APP_NAME;
		$this->load->view('vote/vote_success', $data);

	}

	public function instructions()		{

		if($this->session->userdata('voter_logged_in'))	{

			$data['title'] = 'General Instructions';
			$data['site_title'] = APP_NAME;
			$this->load->view('vote/vote_instructions', $data);
		} else {

			$this->session->set_flashdata('error', 'You need a Vote Pass!');
			redirect('login', 'refresh');
		}

	}

	public function genkey() {
		for($x=1;$x<=10;$x++) {
			$rand = random_string('alnum', 5);
			$this->vote_model->generate_key($rand);

			echo $rand . "<br/>";
		}
	}

	public function logout() {
		$this->session->set_flashdata('success', 'You sucessfuly logged out!');
		$this->session->unset_userdata('voter_logged_in');		  
		redirect('login', 'refresh');
	}
}
