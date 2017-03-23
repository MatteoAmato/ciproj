<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

  public $user_id;
  public $user_email;
  public $user_key;
  public $user_name;
  public $user_lastname;
  public $user_nickname;
  public $user_role;
  public $hidden;
  public $datains;

  public function create_user()
  {
    $this->user_email = $_POST["user_email"];
    $this->user_key = $_POST["user_key"];
    $this->user_role = 1;

    if ($this->db->insert('users', $this)) {
      return $this->db->insert_id();
    } else {
      return '100 - error';
    }
  }

  public function read_user()
  {

  }

  public function update_user()
  {

  }

  public function delete_user()
  {

  }

  public function check_user($user_data)
  {
    // print_r($user_data);
    $query = $this->db->get_where('users', array('user_email' => $user_data['user_email']));
    // print_r($query);
    if ($query->num_rows() === 1) {
      $result = $query->row_array();
      // print_r($result);
      if ( $result['user_key'] == md5($user_data['user_key']) ) {
        $check = (int)$result['user_id'];
      } else {
        $check = 'Password sbagliata';
      }
    } else {
      $check = 'Email non esiste';
    }
    return $check;
  }

  public function get_user_by_id($user_id)
  {
    $result = null;
    $query = $this->db->get_where('users', array('user_id' => $user_id));
    if ($query->num_rows() === 1) {
      $result = $query->row_array();
    }
    return $result;
  }


}
