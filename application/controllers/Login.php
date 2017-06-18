<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	
	public function __construct()	{
		parent::__construct();		
       $this->load->model('vote_model');
	}	

	public function index()		{
		$data['title'] = 'Login';
		$data['site_title'] = APP_NAME;	


		if($this->session->userdata('voter_logged_in'))	{
		        redirect('vote/instructions', 'refresh');
		} else {
			
				//FORM VALIDATION
			$this->form_validation->set_rules('votepass', 'Vote Pass', 'trim|required|callback_check_votepass');   
			 
			   if($this->form_validation->run() == FALSE)	{

					$this->load->view('vote/login', $data);

				} else {

					redirect('vote/instructions', 'refresh');
			}
				
		}	
	}

	function check_votepass($pass) {

		if($this->vote_model->check_votepass($pass)) { //checks the existence of the vote pass

			if($this->vote_model->verify_votepass($pass)) { //checks the vote pass validity
				$this->session->set_userdata('voter_logged_in', array('votepass' => $pass)); //sets votepass session data
				return true;				
			} else {
				$this->form_validation->set_message('check_votepass', 'Vote Pass is already used!');
				return false;
			}

		} else {
			$this->form_validation->set_message('check_votepass', 'Vote Pass does not exist!');
			return false;
		}		

	}
}
