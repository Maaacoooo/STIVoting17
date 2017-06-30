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

					if($this->settings_model->update_setting($key)) {			
				
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

			$data['results'] = $this->settings_model->fetch_settings('vote_page');			
			
			$this->form_validation->set_rules('value', 'Content', 'trim'); 
			$this->form_validation->set_rules('title', 'Title', 'trim'); 
			$this->form_validation->set_rules('key', 'Key', 'trim|required'); 


			if($this->form_validation->run() == FALSE)	{
				$this->load->view('admin/voting/settings', $data);
			} else {			

				//Proceed saving 				
				$key = $this->encryption->decrypt($this->input->post('key')); //ID of the row

				if($this->settings_model->update_setting($key)) {			
			
					$this->session->set_flashdata('success', 'Succes! Page Updated!');
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




}
