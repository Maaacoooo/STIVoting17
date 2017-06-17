<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	
	public function __construct()	{
		parent::__construct();		
       $this->load->model('vote_model');
	}	

	public function index()		{
		$data['title'] = 'Login';
		$data['site_title'] = APP_NAME;	


		if($this->session->userdata('logged_in'))	{
		        redirect('vote/instructions', 'refresh');
		} else {
			
				//FORM VALIDATION
			$this->form_validation->set_rules('votepass', 'Vote Pass', 'trim|required|callback_check_votepass');   
			 
			   if($this->form_validation->run() == FALSE)	{

					$this->load->view('login', $data);

				} else {

					redirect('vote/instructions', 'refresh');
			}
				
		}	
	}

	function check_votepass($pass) {

		if($this->vote_model->check_votepass($pass)) { //checks the existence of the vote pass

			if($this->vote_model->verify_votepass($pass)) { //checks the vote pass validity
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
