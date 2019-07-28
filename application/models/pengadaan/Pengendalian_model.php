<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengendalian_model extends CI_Model{

  private $db2;

  public function __construct()
  {
    parent::__construct();
     $this->db2 = $this->load->database('db2',TRUE);
  }

  public function total_pagu_pekerjaan($skpd=null){
    $db2 = $this->db2;
    $db2->select('sum(pagu) as total_pagu');
    $db2->from('pekerjaan');
    if ($this->ion_auth->in_group('pimskpd')){
      $db2->where('skpd',$this->session->userdata('id_skpd'));
    }
    if ($skpd <> null){
      if (!$this->ion_auth->in_group('pimskpd')){
        $db2->where('skpd',$skpd);
      }
    }
    return $db2->get()->row()->total_pagu;
  }

  public function total_pekerjaan($skpd=null){
    $db2 = $this->db2;
    $db2->select('id');
    $db2->from('pekerjaan');
    if ($this->ion_auth->in_group('pimskpd')){
      $db2->where('skpd',$this->session->userdata('id_skpd'));
    }
    if ($skpd <> null){
      if (!$this->ion_auth->in_group('pimskpd')){
        $db2->where('skpd',$skpd);
      }
    }
    return $db2->count_all_results();
  }

  // DAPATKAN DATA PEKERJAAN PER SKPD
  public function count_pekerjaan_skpd(){
    $db2 = $this->db2;

    $db2->select('s.id_skpd, s.nama_skpd, count(p.skpd) as c_skpd, sum(p.pagu) as sum_pagu, p.id, p.skpd');
    $db2->from('epiz_21636198_pengendalian.pekerjaan p');
    $db2->join('epiz_21636198_simolek.skpd s', 's.id_skpd=p.skpd','left');
    if ($this->ion_auth->in_group('pimskpd')){
      $db2->where('p.skpd',$this->session->userdata('id_skpd'));
    }
    $db2->group_by('p.skpd');
    $db2->order_by('s.id_skpd','asc');

    return $db2->get()->result();
  }

  // DAPATKAN DATA PEKERJAAN PER JENIS PENGADAAN
  public function count_pekerjaan_jenis($skpd=null){
    $db2 = $this->db2;

    $db2->select('j.id, j.nama, count(p.jenis) as c_jenis, p.id, p.jenis, p.skpd');
    $db2->from('pekerjaan p');
    $db2->join('jenis j', 'j.id=p.jenis','left');
    if ($this->ion_auth->in_group('pimskpd')){
      $db2->where('p.skpd',$this->session->userdata('id_skpd'));
    }
    if ($skpd <> null){
      if (!$this->ion_auth->in_group('pimskpd')){
        $db2->where('skpd',$skpd);
      }
    }
    $db2->group_by('p.jenis');
    $db2->order_by('p.id','asc');

    return $db2->get()->result();
  }

  // DAPATKAN DATA PEKERJAAN PER METODE PEMILIHAN
  public function count_pekerjaan_metode($skpd=null){
    $db2 = $this->db2;

    $db2->select('m.id, m.nama, count(p.metode) as c_metode, p.id, p.metode, p.skpd');
    $db2->from('pekerjaan p');
    $db2->join('metode m', 'm.id=p.metode','left');
    if ($this->ion_auth->in_group('pimskpd')){
      $db2->where('p.skpd',$this->session->userdata('id_skpd'));
    }
    if ($skpd <> null){
      if (!$this->ion_auth->in_group('pimskpd')){
        $db2->where('skpd',$skpd);
      }
    }
    $db2->group_by('p.metode');
    $db2->order_by('p.id','asc');

    return $db2->get()->result();
  }

  // DAPATKAN DATA PEKERJAAN DENGAN PAGU <200 JT
  public function count_k200($skpd=null){
    $db2 = $this->db2;

    $db2->where('pagu <=',200000000);
    $db2->from('pekerjaan');
    if ($this->ion_auth->in_group('pimskpd')){
      $db2->where('skpd',$this->session->userdata('id_skpd'));
    }
    if ($skpd <> null){
      if (!$this->ion_auth->in_group('pimskpd')){
        $db2->where('skpd',$skpd);
      }
    }
    return $db2->count_all_results();
  }
  // DAPATKAN DATA PEKERJAAN DENGAN PAGU >200 JT <= 2.5 m
  public function count_200($skpd=null){
    $db2 = $this->db2;

    $db2->where('pagu >',200000000);
    $db2->where('pagu <=',2500000000);
    $db2->from('pekerjaan');
    if ($this->ion_auth->in_group('pimskpd')){
      $db2->where('skpd',$this->session->userdata('id_skpd'));
    }
    if ($skpd <> null){
      if (!$this->ion_auth->in_group('pimskpd')){
        $db2->where('skpd',$skpd);
      }
    }
    return $db2->count_all_results();
  }
  // DAPATKAN DATA PEKERJAAN DENGAN PAGU >2.5m <= 50 m
  public function count_25($skpd=null){
    $db2 = $this->db2;

    $db2->where('pagu >',2500000000);
    $db2->where('pagu <=',50000000000);
    $db2->from('pekerjaan');
    if ($this->ion_auth->in_group('pimskpd')){
      $db2->where('skpd',$this->session->userdata('id_skpd'));
    }
    if ($skpd <> null){
      if (!$this->ion_auth->in_group('pimskpd')){
        $db2->where('skpd',$skpd);
      }
    }
    return $db2->count_all_results();
  }
  // DAPATKAN DATA PEKERJAAN DENGAN PAGU > 50 m
  public function count_50($skpd=null){
    $db2 = $this->db2;

    $db2->where('pagu >',50000000000);
    $db2->from('pekerjaan');
    if ($this->ion_auth->in_group('pimskpd')){
      $db2->where('skpd',$this->session->userdata('id_skpd'));
    }
    if ($skpd <> null){
      if (!$this->ion_auth->in_group('pimskpd')){
        $db2->where('skpd',$skpd);
      }
    }
    return $db2->count_all_results();
  }

  // DAPATKAN DATA PEKERJAAN DENGAN PAGU >200 JT <= 2.5 m PER TAHAPAN
  public function count_200_tahapan($skpd=null){
    $db2 = $this->db2;
    $db2->select('p.id, p.pagu, p.skpd, p.progress_now, count(p.progress_now) as c_progress, pr.id, pr.nama');
    $db2->from('pekerjaan p');
    $db2->join('progress pr', 'pr.id=p.progress_now','left');
    $db2->where('p.pagu >',200000000);
    $db2->where('p.pagu <=',2500000000);
    if ($this->ion_auth->in_group('pimskpd')){
      $db2->where('p.skpd',$this->session->userdata('id_skpd'));
    }
    if ($skpd <> null){
      if (!$this->ion_auth->in_group('pimskpd')){
        $db2->where('skpd',$skpd);
      }
    }
    $db2->group_by('p.progress_now');
    return $db2->get()->result();
  }

  // DAPATKAN DATA PEKERJAAN DENGAN PAGU >2,5 m <= 50 m PER TAHAPAN
  public function count_25_tahapan($skpd=null){
    $db2 = $this->db2;
    $db2->select('p.id, p.pagu, p.skpd, p.progress_now, count(p.progress_now) as c_progress, pr.id, pr.nama');
    $db2->from('pekerjaan p');
    $db2->join('progress pr', 'pr.id=p.progress_now','left');
    $db2->where('p.pagu >',2500000000);
    $db2->where('p.pagu <=',50000000000);
    if ($this->ion_auth->in_group('pimskpd')){
      $db2->where('p.skpd',$this->session->userdata('id_skpd'));
    }
    if ($skpd <> null){
      if (!$this->ion_auth->in_group('pimskpd')){
        $db2->where('skpd',$skpd);
      }
    }
    $db2->group_by('p.progress_now');
    return $db2->get()->result();
  }

  // DAPATKAN DATA PEKERJAAN DENGAN PAGU >2,5 m <= 50 m PER TAHAPAN
  public function count_50_tahapan($skpd=null){
    $db2 = $this->db2;
    $db2->select('p.id, p.pagu, p.skpd, p.progress_now, count(p.progress_now) as c_progress, pr.id, pr.nama');
    $db2->from('pekerjaan p');
    $db2->join('progress pr', 'pr.id=p.progress_now','left');
    $db2->where('p.pagu >',50000000000);
    if ($this->ion_auth->in_group('pimskpd')){
      $db2->where('p.skpd',$this->session->userdata('id_skpd'));
    }
    if ($skpd <> null){
      if (!$this->ion_auth->in_group('pimskpd')){
        $db2->where('skpd',$skpd);
      }
    }
    $db2->group_by('p.progress_now');
    return $db2->get()->result();
  }

  //INFO KE PENGELOLA UNTUK PEKERJAAN YANG NEXT UPDATENYA BULAN LALU

  //GET PROGRESS PROGRESS PEKERJAAN YANG NEXT PROGRESS BULAN LALU
  public function get_next_last_month(){
    $db2 = $this->db2;
    $db2->select('id, pekerjaan, progress, tgl_progress, MAX(tgl_n_progress) as tgl_n_progress');
    $db2->from('progress_pekerjaan');
    $db2->group_by('pekerjaan');
    $subquery = $db2->get_compiled_select();

    $db2->select('p.id as id_p, p.nama, p.progress_now, p.kegiatan, p.pagu, pr.pekerjaan, pr.progress, pr.tgl_progress, pr.tgl_n_progress, s.nama_skpd');
    $db2->from('pekerjaan p');
    $db2->join('('.$subquery.') pr', 'pr.pekerjaan=p.id','left');
    $db2->join('epiz_21636198_simolek.skpd s', 's.id_skpd=p.skpd','left');
    $db2->where('p.progress_now = pr.progress');
    $db2->where('year(pr.tgl_n_progress) <= year(current_date - interval 1 month)');
    $db2->where('month(pr.tgl_n_progress) <= month(current_date - interval 1 month)');
    return $db2->get()->result();
  }
}
