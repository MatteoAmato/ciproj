<?php
  class Crud_model extends CI_Model {

    public $page_id;
    public $page_title;
    public $page_content;
    public $dateins;
    public $hidden;

    public function create_entry()
    {
      // $this->page_id    = $this->input->post('page_id');
      $this->page_title    = $this->input->post('page_title');
      $this->page_content  = $this->input->post('page_content');

      if ($this->db->insert('pages', $this)) {
          return $this->db->insert_id();
      }
    }

    public function read_entry($entry_id)
    {
      // $this->id    = $this->uri->segment(3);
      $this->db->where(array('page_id' => $entry_id));
      $query = $this->db->get('pages');

      return $query->row();
    }

    public function update_entry()
    {
      $this->page_id    = $this->input->post('page_id');
      $this->page_title    = $this->input->post('page_title');
      $this->page_content  = $this->input->post('page_content');

      if ($this->db->update('pages', $this, array('page_id' => $this->input->post('page_id')))) {
        return true;
      }
    }

    public function delete_entry()
    {
      $this->id    = $_POST['id'];

      $this->db->where('id', $this->id);
      $this->db->delete('pages');
    }

    public function get_all_entries()
    {
      $query = $this->db->get('pages');
      return $query->result();
    }

    public function get_last_entries($qty = 10)
    {
      $query = $this->db->get('pages', $qty);
      return $query->result();
    }

    public function bin_entry()
    {
      $this->page_id    = $this->uri->segment(3);

      if ($this->db->update('pages', array('hidden' => 1), array('page_id' => $this->page_id))) {
        return true;
      }
    }

    public function recover_entry()
    {
      $this->page_id    = $this->uri->segment(3);
      $this->hidden    = 'NULL';

      if ($this->db->update('pages', array('hidden' => NULL), array('page_id' => $this->page_id))) {
        return true;
      }
    }



  }
