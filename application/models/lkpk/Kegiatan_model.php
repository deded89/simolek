<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Kegiatan_model extends CI_Model
{

  public $table = 'kegiatan';
  public $id = 'id_kegiatan';
  public $order = 'DESC';

  function __construct()
  {
    parent::__construct();
    $this->db3 = $this->load->database('db3',TRUE);
  }

  // get all
  function get_all()
  {
    $this->db->select('k.*,s.*');
    $this->db->from('epiz_21636198_lkpk.kegiatan k');
    $this->db->join('epiz_21636198_simolek.skpd s', 's.id_skpd=k.skpd', 'left');
    $this->db->order_by($this->id, $this->order);
    return $this->db->get()->result();
  }

  // get data by id
  function get_by_id($id)
  {
    $this->db->select('k.*,s.*');
    $this->db->from('epiz_21636198_lkpk.kegiatan k');
    $this->db->join('epiz_21636198_simolek.skpd s', 's.id_skpd=k.skpd', 'left');
    $this->db->where('k.id_kegiatan', $id);
    return $this->db->get()->row();
  }

  // get data by skpd
  function get_by_skpd($skpd,$ta)
  {
    $this->db3->where('skpd', $skpd);
    $this->db3->where('tahun_anggaran', $ta);
    return $this->db3->get('kegiatan')->result();
  }

  function get_by_skpd_pagu($skpd,$ta,$periode)
  {
    $this->db3->select('k.*,np.*');
    $this->db3->from('nilai_pagu np');
    $this->db3->join('kegiatan k','np.kegiatan=k.id_kegiatan','left');
    $this->db3->where('k.skpd', $skpd);
    $this->db3->where('k.tahun_anggaran', $ta);
    $this->db3->where('np.periode_pagu', $periode);
    return $this->db3->get()->result();
  }

  // insert data
  function insert($data)
  {
    $this->db3->where('kode_kegiatan', $data['kode_kegiatan']);
    $num = $this->db3->get($this->table)->num_rows();
    if ($num > 0){
      $this->db3->where('kode_kegiatan', $data['kode_kegiatan']);
      $this->db3->update($this->table, $data);
    } else {
      $this->db3->insert($this->table, $data);
    }
  }

  // insert data
  function insert_rencana($data,$jenis_rencana)
  {
    if ($jenis_rencana==='keuangan'){
      $jenis_rencana = 'ren_keu';
    } else {
      $jenis_rencana = 'ren_fisik';
    }

    $this->db3->where('kegiatan', $data['kegiatan']);
    $this->db3->where('periode_pagu', $data['periode_pagu']);
    $num = $this->db3->get($jenis_rencana)->num_rows();
    if ($num > 0){
      $this->db3->where('kegiatan', $data['kegiatan']);
      $this->db3->where('periode_pagu', $data['periode_pagu']);
      $this->db3->update($jenis_rencana, $data);
    } else {
      $this->db3->insert($jenis_rencana, $data);
    }
  }

  // insert data total
  function insert_rencana_total($data,$jenis_rencana)
  {
    if ($jenis_rencana==='keuangan'){
      $jenis_rencana = 'ren_keu_skpd';
    } else {
      $jenis_rencana = 'ren_fisik_skpd';
    }

    $this->db3->where('skpd', $data['skpd']);
    $this->db3->where('periode_pagu', $data['periode_pagu']);
    $num = $this->db3->get($jenis_rencana)->num_rows();
    if ($num > 0){
      $this->db3->where('skpd', $data['skpd']);
      $this->db3->where('periode_pagu', $data['periode_pagu']);
      $this->db3->update($jenis_rencana, $data);
    } else {
      $this->db3->insert($jenis_rencana, $data);
    }
  }

  // insert data realisasi
  function insert_realisasi($data,$jenis_realisasi)
  {
    if ($jenis_realisasi==='keuangan'){
      $tabel_db = 'real_keu';
    } else {
      $tabel_db = 'real_fisik';
    }

    $this->db3->where('kegiatan', $data['kegiatan']);
    $num = $this->db3->get($tabel_db)->num_rows();
    if ($num > 0){
      $this->db3->where('kegiatan', $data['kegiatan']);
      $this->db3->update($tabel_db, $data);
    } else {
      $this->db3->insert($tabel_db, $data);
    }
  }

  // insert data total
  function insert_realisasi_total($data,$jenis_realisasi)
  {
    if ($jenis_realisasi==='keuangan'){
      $jenis_realisasi = 'real_keu_skpd';
    } else {
      $jenis_realisasi = 'real_fisik_skpd';
    }

    $this->db3->where('skpd', $data['skpd']);
    $this->db3->where('periode_pagu', $data['periode_pagu']);
    $num = $this->db3->get($jenis_realisasi)->num_rows();
    if ($num > 0){
      $this->db3->where('skpd', $data['skpd']);
      $this->db3->where('periode_pagu', $data['periode_pagu']);
      $this->db3->update($jenis_realisasi, $data);
    } else {
      $this->db3->insert($jenis_realisasi, $data);
    }
  }

  // update data
  function update($id, $data)
  {
    $this->db3->where($this->id, $id);
    $this->db3->update($this->table,$data);
  }

  // delete data
  function delete($id)
  {
    $this->db3->where($this->id, $id);
    $this->db3->delete($this->table);
  }

  //Realisasi
  // function get_real_by_id_keg($id_keg){
  //   $this->db3->select('k.*,rk.*,rf.*,pl.*');
  //   $this->db3->from('kegiatan k');
  //   $this->db3->join('real_fisik rf','rf.kegiatan=k.id_kegiatan','left');
  //   $this->db3->join('real_keu rk','rk.kegiatan=k.id_kegiatan and rk.periode_laporan=rf.periode_laporan','left');
  //   $this->db3->join('periode_laporan pl','pl.id_per_lap=rf.periode_laporan and pl.id_per_lap=rk.periode_laporan','left');
  //   $this->db3->where('k.id_kegiatan',$id_keg);
  //   $this->db3->order_by('pl.tanggal','desc');
  //   return $this->db3->get()->result();
  // }

  // function get_last_periode_id(){
  //   $this->db3->order_by('id_per_lap','desc');
  //   return $this->db3->get('periode_laporan')->row();
  // }


// untuk di excel
  function get_rencana_keu($id_keg,$periode_pagu){
    $this->db3->where('kegiatan',$id_keg);
    $this->db3->where('periode_pagu',$periode_pagu);
    return $this->db3->get('ren_keu')->row();
  }

  function get_rencana_fisik($id_keg,$periode_pagu){
    $this->db3->where('kegiatan',$id_keg);
    $this->db3->where('periode_pagu',$periode_pagu);
    return $this->db3->get('ren_fisik')->row();
  }

  function get_realisasi_keu($id_keg){
    $this->db3->where('kegiatan',$id_keg);
    return $this->db3->get('real_keu')->row();
  }

  function get_realisasi_fisik($id_keg){
    $this->db3->where('kegiatan',$id_keg);
    return $this->db3->get('real_fisik')->row();
  }


  //Rencana
  function get_ren_by_id_keg($id_keg){
    $this->db3->select('k.*,rk.*,rf.*,pr.*');
    $this->db3->from('kegiatan k');
    $this->db3->join('ren_fisik rf','rf.kegiatan=k.id_kegiatan','left');
    $this->db3->join('ren_keu rk','rk.kegiatan=k.id_kegiatan and rk.periode_rencana=rf.periode_rencana','left');
    $this->db3->join('periode_rencana pr','pr.id_per_ren=rf.periode_rencana and pr.id_per_ren=rk.periode_rencana','left');
    $this->db3->where('k.id_kegiatan',$id_keg);
    $this->db3->order_by('pr.tanggal','desc');
    return $this->db3->get()->result();
  }

  function get_last_periode_ren_id(){
    $this->db3->order_by('id_per_ren','desc');
    return $this->db3->get('periode_rencana')->row();
  }

  function masukkan_batch_ren($data_keu,$data_fisik){
    $this->db3->insert_batch('ren_keu', $data_keu);
    $this->db3->insert_batch('ren_fisik', $data_fisik);
  }

  function sum_ren_keu($id_skpd,$bulan){
    $this->db3->select('sum(nk.kumb'.$bulan.') as ren_keu_all');
    $this->db3->from('ren_keu nk');
    $this->db3->where('skpd',$id_skpd);
    return $this->db3->get()->row();
  }

}

/* End of file Kegiatan_model.php */
/* Location: ./application/models/Kegiatan_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-09-02 09:54:30 */
/* http://harviacode.com */
