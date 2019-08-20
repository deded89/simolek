<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Kondisi_img extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("pengadaan/Kondisi_img_model");
        $this->load->model("pengadaan/Pekerjaan_model");
        if (!$this->ion_auth->logged_in())
        {
          redirect('auth/login', 'refresh');
        }else if ($this->ion_auth->in_group('user_biasa')) {
          return show_error('You must be an pptk to view this page.');
        }
    }

    public function index($id_p)
    {
      $akses = $this->Pekerjaan_model->get_by_id($id_p);
      if (!$akses){
        $this->session->set_flashdata('error', 'Akses Dilarang (error 403 Prohibited)');
        redirect(site_url('pengadaan/pekerjaan'));
      } else {
       $kondisi_img = $this->Kondisi_img_model->getAll($id_p);
       $data = array(
         'kondisi_img_data' => $kondisi_img,
         'controller' => 'KPPBJ',
         'uri1' => 'Gambar Kondisi Pekerjaan',
         'main_view' => 'pengadaan/kondisi_img/list',
         'id_p'=>$id_p,
       );
       $data['hidden_attr'] = '';
       if (!$this->ion_auth->in_group('pptk') and !$this->ion_auth->in_group('pengelola') ){
         $data['hidden_attr'] = 'hidden';
       }
       $this->load->view('template_view', $data);
     }
    }

   public function add($id_p)
   {
     $akses = $this->Pekerjaan_model->get_by_id($id_p);
     if (!$akses){
       $this->session->set_flashdata('error', 'Akses Dilarang (error 403 Prohibited)');
       redirect(site_url('pengadaan/pekerjaan'));
     } else {
    if ($this->ion_auth->in_group('guest')) {
      return show_error('Guest Forbid to Access This Page.');
    }
     $kondisi_img = $this->Kondisi_img_model;
     $validation = $this->form_validation;
     $validation->set_rules($kondisi_img->rules());

     if ($validation->run()) {
       $kondisi_img->save();
       $this->session->set_flashdata('message', 'Berhasil diupload');
       redirect(site_url('pengadaan/kondisi_img/index/'.$id_p));
     }

     $data = array(
       'controller' => 'KPPBJ',
       'uri1' => 'Upload Gambar Kondisi Pekerjaan',
       'main_view' => 'pengadaan/kondisi_img/new_form',
       'id_p' => $id_p,
     );
     $this->load->view('template_view', $data);
    }
   }

   public function update($id,$id_p)
    {
      $akses = $this->Pekerjaan_model->get_by_id($id_p);
      if (!$akses){
        $this->session->set_flashdata('error', 'Akses Dilarang (error 403 Prohibited)');
        redirect(site_url('pengadaan/pekerjaan'));
      } else {
      if ($this->ion_auth->in_group('guest')) {
       return show_error('Guest Forbid to Access This Page.');
      }

        $kondisi_data = $this->Kondisi_img_model->getById($id);
        if (!$kondisi_data) show_404();
        $data = array(
          'controller' => 'KPPBJ',
          'uri1' => 'Edit Deskripsi Foto',
          'main_view' => 'pengadaan/kondisi_img/edit_form',
          'id_p' => $id_p,
          'kondisi_img_data' => $kondisi_data,
        );
        $this->load->view('template_view', $data);
      }
    }

    public function update_action(){
      $data = array(
        'deskripsi_gambar' => $this->input->post('deskripsi_gambar',true),
        'id' => $this->input->post('id',true),
      );
      $this->Kondisi_img_model->update($data);
      $this->session->set_flashdata('message', 'Berhasil diedit');
      redirect(site_url('pengadaan/kondisi_img/index/'.$this->input->post('id_p',true)));
    }

    public function delete($id=null,$id_p){

    $akses = $this->Pekerjaan_model->get_by_id($id_p);
    if (!$akses){
      $this->session->set_flashdata('error', 'Akses Dilarang (error 403 Prohibited)');
      redirect(site_url('pengadaan/pekerjaan'));
    } else {
      if ($this->ion_auth->in_group('guest')) {
         return show_error('Guest Forbid to Access This Page.');
      }
        if (!isset($id)) show_404();

        if ($this->Kondisi_img_model->delete($id)) {
          $this->session->set_flashdata('message', 'Berhasil dihapus');
          redirect(site_url('pengadaan/kondisi_img/index/'.$id_p));
        }
    }
  }
}
