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

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('/auth/login', 'refresh');
	}

	public function check_user()
	{
		$user_data = $this->input->post();
		$verify_user = $this->auth_model->check_user($user_data);
		if (is_int($verify_user)) {
			$this->session->logged_in = 1;
			$this->session->logged_data = $this->auth_model->get_user_by_id($verify_user);
			redirect('/dashboard/', 'refresh');
		} else {
			echo '<h1>' . $verify_user . '</h1>';
			echo '<a href="' . site_url('/auth/login/') . '">riprova</a>';
		}
	}


}
