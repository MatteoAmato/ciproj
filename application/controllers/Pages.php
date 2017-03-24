<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->output->enable_profiler(TRUE);
		$this->load->model('crud_model');
	}

	public function index()
	{
		$data = array();
		$data['view_modules'] = array( 'header'=>'header', 'footer'=>'footer', 'content_type'=>'home' );
		$data['entries'] = $this->crud_model->get_last_entries(5);
		$this->load->view('template', $data);
	}

	public function archive()
	{
		$data = array();
		$data['view_modules'] = array( 'header'=>'header', 'footer'=>'footer', 'content_type'=>'home' );
		$data['entries'] = $this->crud_model->get_all_entries();
		$this->load->view('template', $data);
	}


	public function read()
	{
		// print_r($this->uri->uri_string());die();
		$id = $this->uri->segment(3);
		$data = array();
		$data['view_modules'] = array( 'header'=>'header', 'footer'=>'footer', 'content_type'=>'single' );
		$data['entry'] = $this->crud_model->read_entry($id);
		$this->load->view('template', $data);
	}

	public function add_new()
	{
		$data = array();
		$data['view_modules'] = array( 'header'=>'header', 'footer'=>'footer', 'content_type'=>'add_new' );
		$this->load->view('template', $data);
	}

	public function save()
	{
		$data['create'] = $this->crud_model->create_entry();
		if($data['create']) {
			redirect(site_url($this->uri->segment(1) . '/' . 'read' . '/' . $data['create']));
		} else {
			echo "errore nel salvataggio, tornare indietro e riprovare.";
		}
	}

	public function edit()
	{
		// print_r($this->uri->uri_string());die();
		$id = $this->uri->segment(3);
		$data = array();
		$data['view_modules'] = array( 'header'=>'header', 'footer'=>'footer', 'content_type'=>'edit' );
		$data['entry'] = $this->crud_model->read_entry($id);
		$this->load->view('template', $data);
	}

	public function update()
	{
		// print_r($this->input->post());
		$id = $this->input->post('page_id');
		$data['update'] = $this->crud_model->update_entry($id);
		if($data['update']) {
			redirect(site_url($this->uri->segment(1) . '/' . 'read' . '/' . $id));
		} else {
			echo "errore nell'update, tornare indietro e riprovare.";
		}
	}

	public function trash()
	{
		$id = $this->uri->segment(3);
		$data = array();
		$data['trash'] = $this->crud_model->bin_entry($id);
		if($data['trash']) {
			redirect(site_url($this->uri->segment(1) . '/' . 'read' . '/' . $id));
		} else {
			echo "impossibile cestinare, tornare indietro e riprovare.";
		}
	}

	public function recover()
	{
		$id = $this->uri->segment(3);
		$data = array();
		$data['recover'] = $this->crud_model->recover_entry($id);
		if($data['recover']) {
			redirect(site_url($this->uri->segment(1) . '/' . 'read' . '/' . $id));
		} else {
			echo "impossibile recuperare, tornare indietro e riprovare.";
		}
	}


}
