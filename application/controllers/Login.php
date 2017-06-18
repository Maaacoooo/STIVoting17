<?php

/*
 * Copyright (c)2017, Jenmar "Maco" Cortes
 * Copyright TechDepot PH
 * All Rights Reserved
 * 
 * This license is a legal agreement between you and the Maco Cortes
 * for the use of STI Online Voting Systen referred to as the "Software"
 * By obtaining the Software you agree to comply with the terms and conditions of this license.
 *
 * PERMITTED USE
 * With approval from Maco Cortes, You are permitted to use the program for educational purposes only.
 * 
 * MODIFICATION AND REDISTRIBUTION 
 * Unless with written approval obtained from Maco Cortes, 
 * You are NOT allowed to modify, copy, redistribute, and sell the Software.
 *
 * For any concerns, you may reach Maco Cortes via:
 * maco.techdepot@gmail.com
 * facebook.com/Maaacoooo
 * maco@techdepot-ph.com
 * TechDepot-PH.com
 */


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
