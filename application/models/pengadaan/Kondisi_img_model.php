<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kondisi_img_model extends CI_Model{
  private $_table = "kondisi_img";

  public $id;
  public $filename;
  public $pekerjaan;
  public $kondisi;
  public $deskripsi_gambar;

  public function __construct()
  {
    parent::__construct();
     $this->db2 = $this->load->database('db2',TRUE);
  }

  public function rules()
   {
       return [

           ['field' => 'kondisi',
           'label' => 'Kondisi',
           'rules' => 'required','numeric'],

       ];
   }

   public function getAll($id_p)
    {
        $this->db2->where('pekerjaan',$id_p);
        $this->db2->order_by('kondisi','asc');
        return $this->db2->get($this->_table)->result();
    }

    public function get_img_by_kondisi($id_p,$kondisi){
      $this->db2->where('pekerjaan',$id_p);
      $this->db2->where('kondisi',$kondisi);
      $this->db2->order_by('kondisi','asc');
      return $this->db2->get($this->_table)->row();
    }

    public function getById($id)
    {
        return $this->db2->get_where($this->_table, ["id" => $id])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->kondisi = $post["kondisi"];
        $this->pekerjaan = $post["id_p"];
        $this->filename = $this->_uploadImage($post["id_p"]);
        $this->deskripsi_gambar = $post["deskripsi_gambar"] <> '' ? $post["deskripsi_gambar"] : 'Tidak Tersedia' ;
        $this->db2->insert($this->_table, $this);
    }

    public function update($data)
    {
      $this->db2->set('deskripsi_gambar',$data['deskripsi_gambar']);
      $this->db2->where('id', $data['id']);
      $this->db2->update('kondisi_img');
    }

    public function delete($id)
    {
      $this->_deleteImage($id);
      return $this->db2->delete($this->_table, array("id" => $id));
    }

    private function _uploadImage($id_p)
    {
      if (!is_dir('./images/pekerjaan/'.$this->pekerjaan))
  		{
  			mkdir('./images/pekerjaan/'.$this->pekerjaan, 0777, true);
  		}

      $config['upload_path']          = './images/pekerjaan/'.$this->pekerjaan.'/';
      $config['allowed_types']        = 'jpg|png|bmp|jpeg';
      $config['file_name']            = $this->kondisi.'_'.$this->pekerjaan.'_'.time();
      $config['overwrite']			      = true;
      $config['max_size']             = 2048; // 2 MB
      // $config['max_width']            = 1024;
      // $config['max_height']           = 768;

      $this->load->library('upload', $config);

      // if ($this->upload->do_upload('filename')) {
      //     return $this->upload->data("file_name");
      // }

      if ( !$this->upload->do_upload('filename'))
      {
        $error = $this->upload->display_errors();
        $this->session->set_flashdata('error', $error);
        redirect(site_url('pengadaan/kondisi_img/add/'.$id_p));
      }
      else
      {
        return $this->upload->data("file_name");
      }
    }

    private function _deleteImage($id)
    {
        $kondisi_img = $this->getById($id);
        $filename = explode(".", $kondisi_img->filename)[0];
        return array_map('unlink', glob(FCPATH."images/pekerjaan/$kondisi_img->pekerjaan/$filename.*"));
    }
}
