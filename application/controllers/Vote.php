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

		$data['page_data'] = $this->settings_model->page('vote_success');		

		$this->load->view('vote/vote_success', $data);

	}

	public function error()		{

		$data['title'] = 'Error Occured!';
		$data['site_title'] = APP_NAME;

		$data['page_data'] = $this->settings_model->page('vote_error');

		$this->load->view('vote/vote_error', $data);

	}

	public function instructions()		{

		if($this->session->userdata('voter_logged_in'))	{

			$data['title'] = 'General Instructions';
			$data['site_title'] = APP_NAME;

			$data['page_data'] = $this->settings_model->page('vote_instruc');

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
