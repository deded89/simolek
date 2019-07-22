<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Progress_pekerjaan_model extends CI_Model
{

  public $table = 'progress_pekerjaan';
  public $id = 'id';
  public $order = 'DESC';
  private $db2;

  function __construct()
  {
    parent::__construct();
    $this->db2 = $this->load->database('db2',TRUE);
  }

  // get all
  function get_all()
  {
    $this->db2->order_by($this->id, $this->order);
    return $this->db2->get($this->table)->result();
  }

  function get_last_record($id_p)
  {
    $this->db2->where('pekerjaan',$id_p);
    $this->db2->order_by($this->id, 'desc');
    return $this->db2->get($this->table)->row();
  }

  // get data by id
  function get_by_id($id)
  {
    $this->db2->where($this->id, $id);
    return $this->db2->get($this->table)->row();
  }

    // get data by id pekerjaan
  function get_by_id_p($id_p)
  {
    $this->db2->select('pp.id as id_pp, pp.real_keu, pp.real_fisik, pp.tgl_progress, pp.pekerjaan, pp.progress, pp.tgl_n_progress, pp.ket, pp.create_date, p.nama, p2.nama as next_progress');
    $this->db2->from('progress_pekerjaan pp');
    $this->db2->join('progress p', 'p.id=pp.progress', 'left');
    $this->db2->join('progress p2', 'p2.id=pp.next_progress', 'left');
    $this->db2->where('pp.pekerjaan', $id_p);
    $this->db2->order_by('pp.progress','desc');
    $this->db2->order_by('pp.id','desc');
    return $this->db2->get()->result();
  }

  function get_max_real_keu($id_p){
    $this->db2->select_max('real_keu');
    $this->db2->where('pekerjaan',$id_p);
    return $this->db2->get('progress_pekerjaan')->row();
  }

  function get_persen_real_keu($id_p){
    $this->load->model('Kontrak_model');
    $total_kontrak = $this->Kontrak_model->get_last_kontrak($id_p);
    if ($total_kontrak > 0){
      $real_keu = $this->get_max_real_keu($id_p)->real_keu;
      if ($real_keu <> 0){
        $persen = $real_keu / $total_kontrak *100;
      }else{
        $persen = 0;
      }
    }else{
      $persen = 0;
    }
    return $persen;
  }

  function get_max_real_fisik($id_p){
    $this->db2->select_max('real_fisik');
    $this->db2->where('pekerjaan',$id_p);
    return $this->db2->get('progress_pekerjaan')->row();
  }

  // insert data
  function insert($data)
  {
    $this->db2->insert($this->table, $data);
  }

  // update data
  function update($id, $data)
  {
    $this->db2->where($this->id, $id);
    $this->db2->update($this->table, $data);
  }

  // delete data
  function delete($id)
  {
    $this->db2->where($this->id, $id);
    $this->db2->delete($this->table);
  }

  // update progress now di tabel pekerjaan
  public function update_progress_now($id_p){
    $this->db2->select('max(progress) as now_progress');
    $this->db2->from('progress_pekerjaan');
    $this->db2->where('pekerjaan',$id_p);
    $q = $this->db2->get()->row();
    $now = $q->now_progress;


    if ($now) {
      $now = $now;
    } else {
      $now = 9;
    }
    $this->db2->set('progress_now',$now);
    $this->db2->where('id', $id_p);
    $this->db2->update('pekerjaan');
  }

}

/* End of file Progress_pekerjaan_model.php */
/* Location: ./application/models/Progress_pekerjaan_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-05-27 13:30:56 */
/* http://harviacode.com */
