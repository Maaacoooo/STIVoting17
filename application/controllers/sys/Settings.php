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

class Settings extends CI_Controller {

	public function __construct()	{
		parent::__construct();		
       $this->load->model('user_model');
	}	


	public function profile()		{

		$userdata = $this->session->userdata('admin_logged_in'); //it's pretty clear it's a userdata

		if($userdata)	{
			
			$data['site_title'] = APP_NAME;
			$data['user'] = $this->user_model->userdetails($userdata['username']); //fetches users record
			$data['title'] = 'Profile : ' . $data['user']['name'];

			

			//FORM VALIDATION
				$this->form_validation->set_rules('name', 'Full Name', 'trim|required');
			
			if($this->input->post('resetpass')) {
				$this->form_validation->set_rules('oldpass', 'Old Password', 'trim|required|callback_check_user');
				$this->form_validation->set_rules('newpass', 'New Password', 'trim|required|matches[confpass]');
				$this->form_validation->set_rules('confpass', 'Confirm Password', 'trim|required');
			}
			 
			   if($this->form_validation->run() == FALSE)	{

					$this->load->view('admin/profile', $data);

				} else {

				//Proceed saving				
				if($this->user_model->update_profile($data['user']['username'])) {			
					if($this->input->post('resetpass')) {
						$this->user_model->update_profile_pass($data['user']['username']);
					}
					$this->session->set_flashdata('success', 'Success! Profile Updated!');
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
