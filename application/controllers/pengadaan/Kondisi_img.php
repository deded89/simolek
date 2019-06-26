<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Kondisi_img extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("pengadaan/Kondisi_img_model");
    }

    public function index($id_p)
   {
     $kondisi_img = $this->Kondisi_img_model->getAll($id_p);
     $data = array(
       'kondisi_img_data' => $kondisi_img,
       'controller' => 'Kondisi_img',
       'uri1' => 'List Kondisi_img',
       'main_view' => 'pengadaan/kondisi_img/list',
       'id_p'=>$id_p,
     );

     $this->load->view('template_view', $data);
   }

   public function add($id_p)
   {
       $kondisi_img = $this->Kondisi_img_model;
       $validation = $this->form_validation;
       $validation->set_rules($kondisi_img->rules());

       if ($validation->run()) {
           $kondisi_img->save();
           $this->session->set_flashdata('success', 'Berhasil disimpan');
       }

       $data = array(
         'controller' => 'Kondisi_img',
         'uri1' => 'List Kondisi_img',
         'main_view' => 'pengadaan/kondisi_img/new_form',
         'id_p' => $id_p,
       );
       $this->load->view('template_view', $data);
   }

   // public function edit($id = null)
   //  {
   //      if (!isset($id)) redirect('pengadaan/kondisi_img');
   //
   //      $kondisi_img = $this->Kondisi_img_model;
   //      $validation = $this->form_validation;
   //      $validation->set_rules($kondisi_img->rules());
   //
   //      if ($validation->run()) {
   //          $kondisi_img->update();
   //          $this->session->set_flashdata('success', 'Berhasil disimpan');
   //      }
   //
   //      $data["kondisi_img_data"] = $kondisi_img->getById($id);
   //      if (!$data["kondisi_img_data"]) show_404();
   //
   //      $this->load->view("pengadaa/kondisi_img/edit_form", $data);
   //  }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();

        if ($this->kondisi_img_model->delete($id)) {
            redirect(site_url('pengadaan/kondisi_img'));
        }
    }
}
