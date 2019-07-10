<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengendalian_model extends CI_Model{

  private $db2;

  public function __construct()
  {
    parent::__construct();
     $this->db2 = $this->load->database('db2',TRUE);
  }

  public function total_pekerjaan(){
    $db2 = $this->db2;
    $db2->select('id');
    $db2->from('pekerjaan');
    return $db2->count_all_results();
  }

  // DAPATKAN DATA PEKERJAAN PER JENIS PENGADAAN
  public function count_pekerjaan_jenis(){
    $db2 = $this->db2;

    $db2->select('j.id, j.nama, count(p.jenis) as c_jenis, p.id, p.jenis');
    $db2->from('pekerjaan p');
    $db2->join('jenis j', 'j.id=p.jenis','left');
    $db2->group_by('p.jenis');
    $db2->order_by('p.id','asc');

    return $db2->get()->result();
  }

  // DAPATKAN DATA PEKERJAAN PER METODE PEMILIHAN
  public function count_pekerjaan_metode(){
    $db2 = $this->db2;

    $db2->select('m.id, m.nama, count(p.metode) as c_metode, p.id, p.metode');
    $db2->from('pekerjaan p');
    $db2->join('metode m', 'm.id=p.metode','left');
    $db2->group_by('p.metode');
    $db2->order_by('p.id','asc');

    return $db2->get()->result();
  }

  // DAPATKAN DATA PEKERJAAN DENGAN PAGU <200 JT
  public function count_k200(){
    $db2 = $this->db2;

    $db2->where('pagu <=',200000000);
    $db2->from('pekerjaan');
    return $db2->count_all_results();
  }
  // DAPATKAN DATA PEKERJAAN DENGAN PAGU >200 JT <= 2.5 m
  public function count_200(){
    $db2 = $this->db2;

    $db2->where('pagu >',200000000);
    $db2->where('pagu <=',2500000000);
    $db2->from('pekerjaan');
    return $db2->count_all_results();
  }
  // DAPATKAN DATA PEKERJAAN DENGAN PAGU >2.5m <= 50 m
  public function count_25(){
    $db2 = $this->db2;

    $db2->where('pagu >',2500000000);
    $db2->where('pagu <=',5000000000);
    $db2->from('pekerjaan');
    return $db2->count_all_results();
  }
  // DAPATKAN DATA PEKERJAAN DENGAN PAGU > 50 m
  public function count_50(){
    $db2 = $this->db2;

    $db2->where('pagu >',5000000000);
    $db2->from('pekerjaan');
    return $db2->count_all_results();
  }

  // DAPATKAN DATA PEKERJAAN DENGAN PAGU >200 JT <= 2.5 m PER TAHAPAN
  public function count_200_tahapan(){
    $db2 = $this->db2;
    $db2->select('p.id, p.pagu, p.progress_now, count(p.progress_now) as c_progress, pr.id, pr.nama');
    $db2->from('pekerjaan p');
    $db2->join('progress pr', 'pr.id=p.progress_now','left');
    $db2->where('p.pagu >',200000000);
    $db2->where('p.pagu <=',2500000000);
    $db2->where('p.progress_now <>',null);
    $db2->group_by('p.progress_now');
    return $db2->get()->result();
  }

  // DAPATKAN DATA PEKERJAAN DENGAN PAGU >2,5 m <= 50 m PER TAHAPAN
  public function count_25_tahapan(){
    $db2 = $this->db2;
    $db2->select('p.id, p.pagu, p.progress_now, count(p.progress_now) as c_progress, pr.id, pr.nama');
    $db2->from('pekerjaan p');
    $db2->join('progress pr', 'pr.id=p.progress_now','left');
    $db2->where('p.pagu >',2500000000);
    $db2->where('p.pagu <=',5000000000);
    $db2->where('p.progress_now <>',null);
    $db2->group_by('p.progress_now');
    return $db2->get()->result();
  }

  // DAPATKAN DATA PEKERJAAN DENGAN PAGU >2,5 m <= 50 m PER TAHAPAN
  public function count_50_tahapan(){
    $db2 = $this->db2;
    $db2->select('p.id, p.pagu, p.progress_now, count(p.progress_now) as c_progress, pr.id, pr.nama');
    $db2->from('pekerjaan p');
    $db2->join('progress pr', 'pr.id=p.progress_now','left');
    $db2->where('p.pagu >',5000000000);
    $db2->where('p.progress_now <>',null);
    $db2->group_by('p.progress_now');
    return $db2->get()->result();
  }

}
