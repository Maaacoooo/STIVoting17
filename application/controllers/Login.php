<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {


	public function index()
	{
		$data['title'] = 'Login';
		$data['site_title'] = APP_NAME;
		$this->load->view('login', $data);
	}
}
