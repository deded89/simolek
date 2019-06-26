<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kondisi_img_model extends CI_Model{
  private $_table = "kondisi_img";

  public $id;
  public $filename;
  public $pekerjaan;
  public $kondisi;

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

    public function getById($id)
    {
        return $this->db2->get_where($this->_table, ["id" => $id])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->kondisi = $post["kondisi"];
        $this->pekerjaan = $post["id_p"];
        $this->filename = $this->_uploadImage();
        $this->db2->insert($this->_table, $this);
    }
    //
    // public function update()
    // {
    //     $post = $this->input->post();
    //     $this->id = $post["id"];
    //     $this->pekerjaan = $post["id_p"];
    //     $this->kondisi = $post["kondisi"];
    //     $this->filename = $this->_uploadImage();
    //     $this->db2->update($this->_table, $this, array('id' => $post['id']));
    // }

    public function delete($id)
    {
        return $this->db2->delete($this->_table, array("id" => $id));
    }

    private function _uploadImage()
    {
      if (!is_dir('./images/pekerjaan/'.$this->pekerjaan))
  		{
  			mkdir('./images/pekerjaan/'.$this->pekerjaan, 0777, true);
  		}

      $config['upload_path']          = './images/pekerjaan/'.$this->pekerjaan.'/';
      $config['allowed_types']        = 'jpg';
      $config['file_name']            = $this->kondisi.'_'.$this->pekerjaan;
      $config['overwrite']			      = true;
      $config['max_size']             = 10240; // 1MB
      // $config['max_width']            = 1024;
      // $config['max_height']           = 768;

      $this->load->library('upload', $config);

      if ($this->upload->do_upload('filename')) {
          return $this->upload->data("file_name");
      }
    }
}
