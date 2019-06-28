<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kontrak_model extends CI_Model
{

    public $table = 'kontrak';
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

    // get data by id
    function get_by_id($id)
    {
        $this->db2->where($this->id, $id);
        return $this->db2->get($this->table)->row();
    }

    // get data by id pekerjaan
    function get_by_id_p($id_p)
    {
        $this->db2->where('pekerjaan', $id_p);
        return $this->db2->get($this->table)->result();
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

    //sum nilai kontrak by pekerjaan_read
    public function sum_nilai_kontrak($id_p){
      $this->db2->select('sum(nilai) as total_kontrak');
      $this->db2->from('kontrak');
      $this->db2->where('pekerjaan',$id_p);
      return $this->db2->get()->row();
    }

}

/* End of file Kontrak_model.php */
/* Location: ./application/models/Kontrak_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-05-27 14:32:28 */
/* http://harviacode.com */
