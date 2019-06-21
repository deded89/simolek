<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lokasi_model extends CI_Model{
  public $table = 'lokasi';
  public $id = 'id';
  public $order = 'DESC';
  private $db2;

  public function __construct()
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

}
