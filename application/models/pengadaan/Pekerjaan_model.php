<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pekerjaan_model extends CI_Model
{

    public $table = 'pekerjaan';
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
      $this->db->select('p.id, p.nama, p.kegiatan, p.pagu, p.user, p.skpd, s.nama_skpd, j.nama as jenis, m.nama as metode, p.pagu');
      $this->db->from('epiz_21636198_pengendalian.pekerjaan p');
      $this->db->join('epiz_21636198_simolek.skpd s', 's.id_skpd=p.skpd', 'left');
      $this->db->join('epiz_21636198_pengendalian.jenis j', 'p.jenis=j.id', 'left');
      $this->db->join('epiz_21636198_pengendalian.metode m', 'p.metode=m.id', 'left');
      if ($this->ion_auth->in_group('pimskpd')){
        $this->db->where('p.skpd',$this->session->userdata('id_skpd'));
      }
      if (!$this->ion_auth->in_group('pengelola') AND !$this->ion_auth->in_group('guest') AND !$this->ion_auth->in_group('pimskpd') ){
        $this->db->where('p.user',$this->session->userdata('user_id'));
      }
      $this->db->order_by('p.skpd', 'asc');
      $this->db->order_by('p.pagu', 'desc');
      return $this->db->get()->result();
    }

    // get data by id
    function get_by_id($id)
    {
      $this->db->select('p.id as id_p, p.deskripsi, p.id_rup, p.id_lpse, p.link_rup, p.link_lpse, p.nama, p.kegiatan, p.progress_now, pr.id, pr.nama as pr_now, s.id_skpd, s.nama_skpd, j.id as id_j, j.nama as jenis, m.id as id_m, m.nama as metode, p.pagu');
      $this->db->from('epiz_21636198_pengendalian.pekerjaan p');
      $this->db->join('epiz_21636198_simolek.skpd s', 'p.skpd=s.id_skpd', 'left');
      $this->db->join('epiz_21636198_pengendalian.jenis j', 'p.jenis=j.id', 'left');
      $this->db->join('epiz_21636198_pengendalian.metode m', 'p.metode=m.id', 'left');
      $this->db->join('epiz_21636198_pengendalian.progress pr', 'pr.id=p.progress_now', 'left');
      if ($this->ion_auth->in_group('pimskpd')){
        $this->db->where('p.skpd',$this->session->userdata('id_skpd'));
      }
      $this->db->where('p.id', $id);
      if (!$this->ion_auth->in_group('pengelola') and !$this->ion_auth->in_group('guest') and !$this->ion_auth->in_group('pimskpd')){
          $this->db->where('p.user',$this->session->userdata('user_id'));
      };
      return $this->db->get()->row();
    }

    // insert data
    function insert($data)
    {
        $this->db2->insert($this->table, $data);
    }

    // insert data lokasi
    function insert_lokasi($data)
    {
      $this->db2->insert('lokasi', $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db2->where($this->id, $id);
        $this->db2->update($this->table, $data);
    }

    function update_id_pengadaan($id, $data)
    {
        $this->db2->set('deskripsi',$data['deskripsi']);
        $this->db2->set('id_rup',$data['id_rup']);
        $this->db2->set('id_lpse',$data['id_lpse']);
        $this->db2->set('link_rup','https://sirup.lkpp.go.id/sirup/ro/cari?tahunAnggaran=2019&keyword='.$data['id_rup'].'&jenisPengadaan=0&metodePengadaan=0');
        $this->db2->set('link_lpse','http://lpse.banjarmasinkota.go.id/eproc4/lelang/'.$data['id_lpse'].'/pengumumanlelang');
        $this->db2->where($this->id, $id);
        $this->db2->update($this->table);
    }

    // delete data
    function delete($id)
    {
      $this->db2->where($this->id, $id);
      $this->db2->delete($this->table);
    }

    // FILTER SKPD UNTUK DASHBOARD
    function filter_skpd($skpd){
      $this->db->select('p.id, p.nama, p.kegiatan, p.pagu, p.user, p.skpd, s.nama_skpd, j.nama as jenis, m.nama as metode, p.pagu');
      $this->db->from('epiz_21636198_pengendalian.pekerjaan p');
      $this->db->join('epiz_21636198_simolek.skpd s', 's.id_skpd=p.skpd', 'left');
      $this->db->join('epiz_21636198_pengendalian.jenis j', 'p.jenis=j.id', 'left');
      $this->db->join('epiz_21636198_pengendalian.metode m', 'p.metode=m.id', 'left');
      if ($this->ion_auth->in_group('pimskpd')){
        $this->db->where('p.skpd',$this->session->userdata('id_skpd'));
      }
      if ($skpd <> null){
        if (!$this->ion_auth->in_group('pimskpd')){
          $this->db->where('p.skpd',$skpd);
        }
      }
      // $this->db->where('p.skpd',$skpd);
      $this->db->order_by('p.skpd', 'asc');
      $this->db->order_by('p.pagu', 'desc');
      return $this->db->get()->result();
    }

    // FILTER JENIS dan METODE UNTUK DASHBOARD
    function filter_jenis_metode($filter1,$filter2,$skpd){
      $this->db->select('p.id, p.nama, p.kegiatan, p.pagu, p.user, p.skpd, s.nama_skpd, j.nama as jenis, m.nama as metode, p.pagu');
      $this->db->from('epiz_21636198_pengendalian.pekerjaan p');
      $this->db->join('epiz_21636198_simolek.skpd s', 's.id_skpd=p.skpd', 'left');
      $this->db->join('epiz_21636198_pengendalian.jenis j', 'p.jenis=j.id', 'left');
      $this->db->join('epiz_21636198_pengendalian.metode m', 'p.metode=m.id', 'left');
      $this->db->where('p.'.$filter1,$filter2);
      if ($this->ion_auth->in_group('pimskpd')){
        $this->db->where('p.skpd',$this->session->userdata('id_skpd'));
      }
      if ($skpd <> null){
        if (!$this->ion_auth->in_group('pimskpd')){
          $this->db->where('p.skpd',$skpd);
        }
      }
      $this->db->order_by('p.skpd', 'asc');
      $this->db->order_by('p.pagu', 'desc');
      return $this->db->get()->result();
    }

    // FILTER PAGU UNTUK DASHBOARD
    function filter_pagu($filter1,$filter2,$skpd=null){
      $this->db->select('p.id, p.nama, p.kegiatan, p.pagu, p.user, p.skpd, s.nama_skpd, j.nama as jenis, m.nama as metode, p.pagu');
      $this->db->from('epiz_21636198_pengendalian.pekerjaan p');
      $this->db->join('epiz_21636198_simolek.skpd s', 's.id_skpd=p.skpd', 'left');
      $this->db->join('epiz_21636198_pengendalian.jenis j', 'p.jenis=j.id', 'left');
      $this->db->join('epiz_21636198_pengendalian.metode m', 'p.metode=m.id', 'left');
      $this->db->where('p.pagu <=',$filter1);
      $this->db->where('p.pagu >',$filter2);
      if ($this->ion_auth->in_group('pimskpd')){
        $this->db->where('p.skpd',$this->session->userdata('id_skpd'));
      }
      if ($skpd <> null){
        if (!$this->ion_auth->in_group('pimskpd')){
          $this->db->where('p.skpd',$skpd);
        }
      }
      $this->db->order_by('p.skpd', 'asc');
      $this->db->order_by('p.pagu', 'desc');
      return $this->db->get()->result();
    }

    // FILTER PAGU_PROGRESS UNTUK DASHBOARD xxxxxxxx
    function filter_pagu_progress($filter1,$filter2,$filter3,$skpd){
      $this->db->select('p.id, p.nama, p.kegiatan, p.pagu, p.user, p.skpd, s.nama_skpd, j.nama as jenis, m.nama as metode, p.pagu');
      $this->db->from('epiz_21636198_pengendalian.pekerjaan p');
      $this->db->join('epiz_21636198_simolek.skpd s', 's.id_skpd=p.skpd', 'left');
      $this->db->join('epiz_21636198_pengendalian.jenis j', 'p.jenis=j.id', 'left');
      $this->db->join('epiz_21636198_pengendalian.metode m', 'p.metode=m.id', 'left');
      $this->db->where('p.pagu <',$filter1);
      $this->db->where('p.pagu >',$filter2);
      $this->db->where('p.progress_now',$filter3);
      if ($this->ion_auth->in_group('pimskpd')){
        $this->db->where('p.skpd',$this->session->userdata('id_skpd'));
      }
      if ($skpd <> null){
        if (!$this->ion_auth->in_group('pimskpd')){
          $this->db->where('p.skpd',$skpd);
        }
      }
      $this->db->order_by('p.skpd', 'asc');
      $this->db->order_by('p.pagu', 'desc');
      return $this->db->get()->result();
    }

    //PROYEKSI PEKERJAAN BERDASARKAN MASA KONTRAK
    function get_proyeksi($id_p){
      $db2 = $this->db2;
      $db2->select('p.*,k.*');
      $db2->from('kontrak k');
      $db2->join('pekerjaan p', 'k.pekerjaan = p.id','left');
      $db2->where('p.id = '.$id_p.' and p.jenis = 2 ');
      $db2->or_where('p.id = '.$id_p.' and p.jenis = 3 ');
      $db2->order_by('k.tanggal','desc');
      $q_data = $db2->get()->row();

      if($q_data){
        $date1=date_create("$q_data->awal");
        $date2=date_create("$q_data->akhir");
        $masa_kontrak=date_diff($date1,$date2);

        //HITUNG ANTARA AWAL KONTRAK DAN HARI INI
        $date1=date_create("$q_data->awal");
        $date2=date_create(date('Y-m-d'));
        $hari_terlaksana=date_diff($date1,$date2);

        $persen_perday = 100 / ($masa_kontrak->format('%a')+1);
        $proyeksi_today = $persen_perday * ($hari_terlaksana->format('%a')+1);
        return array(
          'proyeksi_today' => $proyeksi_today,
          'hari_terlaksana' => $hari_terlaksana->format('%a')+1,
        );
      }
    }

    function cetak(){
      $db2 = $this->db2;
      $db2->select('id, kontak, pekerjaan, MAX(tmt) as tmt');
      $db2->from('pic');
      $db2->where('status','pptk');
      $db2->group_by('pekerjaan');
      $subquery = $db2->get_compiled_select();

      $db2->select('a.*');
      $db2->from('pic a');
      $db2->join('('.$subquery.') b','a.id = b.id AND a.pekerjaan = b.pekerjaan AND a.tmt = b.tmt');
      $subquery2 = $db2->get_compiled_select();

      $db2->select('p.*,p.nama as nama_pekerjaan, pr.nama as progress, s.*, j.nama as jenis, m.nama as metode, pic.*, pic.nama as nama_pic');
      $db2->from('pekerjaan p');
      $db2->join('progress pr','pr.id=p.progress_now','left');
      $db2->join('('.$subquery2.') pic','pic.pekerjaan=p.id','left');
      $db2->join('epiz_21636198_simolek.skpd s', 's.id_skpd=p.skpd', 'left');
      $db2->join('epiz_21636198_pengendalian.jenis j', 'p.jenis=j.id', 'left');
      $db2->join('epiz_21636198_pengendalian.metode m', 'p.metode=m.id', 'left');
      $db2->order_by('p.skpd');
      $db2->order_by('p.pagu');
      return $db2->get()->result();
    }
}

/* End of file Pekerjaan_model.php */
/* Location: ./application/models/Pekerjaan_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-05-27 13:30:41 */
/* http://harviacode.com */
