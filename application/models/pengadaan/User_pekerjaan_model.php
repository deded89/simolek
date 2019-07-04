<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_pekerjaan_model extends CI_Model{

  private $db2;
  public function __construct()
  {
    parent::__construct();
    $this->db2 = $this->load->database('db2',TRUE);
  }

  public function get_user_pekerjaan(){
    $this->db->select('p.nama, p.user, u.id, u.username');
    $this->db->from('simolek_p.pekerjaan p');
    $this->db->join('simolek.users u','u.id=p.user','left');
    return $this->db->get()->result();
  }

  public function update_user_pekerjaan(){
    $id_p = $this->input->post('pekerjaan',true);
    $id_u = $this->input->post('users',true);

    $this->db2->set('user',$id_u);
    $this->db2->where('id',$id_p);
    $this->db2->update('pekerjaan');
  }

}
