<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model');
	}

	public function index()
	{
		$this->load->view('auth/login');
	}

	public function login()
	{
		$this->load->view('auth/login');
	}

	public function check_user()
	{
		$user_data = $this->input->post();
		$verify_user = $this->auth_model->check_user($user_data);
		if ($verify_user === 1) {
			redirect('/dashboard/', 'refresh');
		} else {
			echo '<h1>' . $verify_user . '</h1>';
			echo '<a href="' . site_url('/auth/login/') . '">riprova</a>';
		}
	}


}
