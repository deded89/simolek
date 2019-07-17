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
    $this->db->select('p.id as id_p, p.nama, p.kegiatan, p.pagu, p.skpd, p.user, u.id, u.username, s.id_skpd, s.nama_skpd');
    $this->db->from('epiz_21636198_pengendalian.pekerjaan p');
    $this->db->join('epiz_21636198_simolek.users u','u.id=p.user','left');
    $this->db->join('epiz_21636198_simolek.skpd s','s.id_skpd=p.skpd','left');
    $this->db->order_by('p.skpd','asc');
    $this->db->order_by('p.pagu','desc');
    return $this->db->get()->result();
  }

  public function update_user_pekerjaan(){
    $id_p = $this->input->post('pekerjaan',true);
    $id_u = $this->input->post('users',true);

    $this->db2->set('user',$id_u);
    $this->db2->where('id',$id_p);
    $this->db2->update('pekerjaan');
  }

  public function remove_user_pekerjaan($id_p){
    $this->db2->set('user','');
    $this->db2->where('id',$id_p);
    $this->db2->update('pekerjaan');
  }

}
