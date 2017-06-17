<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vote extends CI_Controller {


	public function index()
	{
		$data['title'] = 'Voting page!';
		$data['site_title'] = APP_NAME;
		$this->load->view('vote/voting_page', $data);
	}

	public function success()
	{
		$data['title'] = 'Voting page!';
		$data['site_title'] = APP_NAME;
		$this->load->view('vote/vote_success', $data);
	}

	public function genkey() {
		for($x=1;$x<=100;$x++) {
			echo $x . " " . random_string('alnum', 5) . " Hi <br/>";
		}
	}
}
