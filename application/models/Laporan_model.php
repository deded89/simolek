<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Laporan_model extends CI_Model
{

    public $table = 'laporan';
    public $id = 'id_lap';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

	function get_all()
    {
		//JIKA USER ADALAH ADMIN
        if ($this->ion_auth->in_group('admin')) {
			$this->db->select('l.id_lap, l.nama_lap, l.batas_waktu, l.status, l.id_skpd, l.id_jab, t.status as mystatus, s.nama_skpd, p.id_status, p.ket');
			$this->db->from('laporan l');
			$this->db->join('skpd s', 's.id_skpd=l.id_skpd', 'left');
			$this->db->join('pelaporan p', 'p.id_lap=l.id_lap', 'left');
			$this->db->join('status t', 'p.id_status=t.id_status', 'left');
			$this->db->order_by('l.id_lap', 'desc');
			return $this->db->get()->result();
		} else
		//JIKA USER BUKAN ADMIN
		{
			$this->db->select('l.id_lap, l.nama_lap, l.batas_waktu, l.status, l.id_skpd, l.id_jab, t.status as mystatus, s.nama_skpd, p.id_status, p.ket');
			$this->db->from('laporan l');
			$this->db->where('p.id_skpd',$this->session->userdata('id_skpd'));
			$this->db->join('skpd s', 's.id_skpd=l.id_skpd', 'left');
			$this->db->join('pelaporan p', 'p.id_lap=l.id_lap', 'left');
			$this->db->join('status t', 'p.id_status=t.id_status', 'left');
			$this->db->order_by('l.id_lap', 'desc');
			return $this->db->get()->result();
		}
    }

    // get all under me
    function get_all_under_me()
    {
        if (!$this->ion_auth->in_group('admin')) {
			$this->db->select('*');
			$this->db->from('laporan l');
			$this->db->where('l.id_skpd',$this->session->userdata('id_skpd'));
			$this->db->join('skpd s', 's.id_skpd=l.id_skpd', 'left');
			$this->db->order_by('l.id_lap', 'desc');
			return $this->db->get()->result();

		} else
		{
			$this->db->select('*');
			$this->db->from('laporan l');
			$this->db->join('skpd s', 's.id_skpd=l.id_skpd', 'left');
			$this->db->order_by('l.id_lap', 'desc');
			return $this->db->get()->result();
		}
    }

	function get_nama_laporan($id)
	{
		$this->db->select('*');
		$this->db->from('laporan');
		$this->db->where($this->id, $id);
		return $this->db->get()->row();
	}

    // get data by id
    function get_by_id($id)
    {
		//JIKA USER ADALAH ADMIN
        if ($this->ion_auth->in_group('admin')) {
			$this->db->select('*');
			$this->db->from('laporan');
			$this->db->where($this->id, $id);
			return $this->db->get()->row();
		}else
		//JIKA USER ADALAH PENGELOLA
		if ($this->ion_auth->in_group('pengelola')) {
			$this->db->select('*');
			$this->db->from('laporan');
			$this->db->where($this->id, $id);
			$this->db->where('id_skpd', $this->session->userdata('id_skpd'));
			return $this->db->get()->row();
		}else{
		//JIKA USER ADALAH USER BIASA
			$this->db->select('*');
			$this->db->from('laporan');
			$this->db->where($this->id, $id);
			$this->db->where('id_skpd', $this->session->userdata('id_skpd'));
			$this->db->where('id_jab', $this->session->userdata('id_jab'));
			return $this->db->get()->row();
		}
    }

    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_lap', $q);
		$this->db->or_like('nama_lap', $q);
		$this->db->or_like('batas_waktu', $q);
		$this->db->or_like('status', $q);
		$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_lap', $q);
		$this->db->or_like('nama_lap', $q);
		$this->db->or_like('batas_waktu', $q);
		$this->db->or_like('status', $q);
		$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

	/* function update_akses($id,$status)
	{
		if ($status == 'open'){
			$ubah_ke = 'closed';
		} else {
		if ($status == 'closed'){
			$ubah_ke = 'open';
		}}
		$this->db->set('status', $ubah_ke);
		$this->db->where('id_lap', $id);
		$this->db->update($this->table);

	} */

	function update_status_otomatis()
	{
		//TUTUP LAPORAN YANG HABIS WAKTU
		$this->db->set('status','closed');
		$this->db->where('status','open');
		//$this->db->where('datediff(batas_waktu, current_date()) <',0);
    $now = date('Y-m-d H:i:s');
		$this->db->where('TIMESTAMPDIFF(second,batas_waktu,"'.$now.'") >',-1);
		$this->db->update('laporan');

		//BUKA LAPORAN YANG WAKTUNYA DIPERPANJANG
		$this->db->set('status','open');
		$this->db->where('status','closed');
		//$this->db->where('datediff(batas_waktu, current_date()) >',1);
		$this->db->where('TIMESTAMPDIFF(second,batas_waktu,"'.$now.'") <',0);
		$this->db->update('laporan');
	}

	function cek_pelapor_sama($id_skpd,$id_lap)
	{
		$this->db->where('id_skpd',$id_skpd);
		$this->db->where('id_lap',$id_lap);
		return $this->db->count_all_results('pelaporan');
	}

	function get_akses_upload($id_lap)
	{
		$this->db->select('*');
		$this->db->from('pelaporan p');
		$this->db->where('p.id_skpd',$this->session->userdata('id_skpd'));
		$this->db->where('p.id_lap',$id_lap);
		$this->db->join('laporan l', 'l.id_lap=p.id_lap', 'left');

		$query = $this->db->get();
		$num_rows = $query->num_rows();
		$data = $query->row();

		return array(
			'num_rows' => $num_rows,
			'data'	   => $data,
		);
	}

	function get_skpd_by_klasifikasi($id_klasifikasi)
	{
		$this->db->select('*');
		$this->db->from('skpd');
		$this->db->where('id_klasifikasi',$id_klasifikasi);
		$query = $this->db->get();
		$num_rows = $query->num_rows();
		$data = $query->result();

		return array(
			'num_rows' => $num_rows,
			'data'	   => $data,
		);
	}

	function delete_data_file($id)
	{
		$this->db->where('id_pelaporan', $id);
        $this->db->delete('file_upload');
	}
}


/* End of file Laporan_model.php */
/* Location: ./application/models/Laporan_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-08-14 21:16:08 */
/* http://harviacode.com */
