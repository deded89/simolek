<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PIC_pekerjaan extends CI_Controller
{


  function __construct()
  {
      parent::__construct();
      $this->load->model('pengadaan/Pekerjaan_model');
      $this->load->model('pengadaan/Pic_model');
      $this->load->library('form_validation');
      if (!$this->ion_auth->logged_in())
      {
        redirect('auth/login', 'refresh');
      }else if ($this->ion_auth->in_group('user_biasa')) {
        return show_error('You must be an pptk to view this page.');
      }
  }

  public function add_pic($id_p)
  {
    $pekerjaan = $this->Pekerjaan_model->get_by_id($id_p);
    if (!$pekerjaan){
      $this->session->set_flashdata('error', 'Akses Dilarang (error 403 Prohibited)');
      redirect(site_url('pengadaan/pekerjaan'));
    } else {

      if ($this->ion_auth->in_group('guest')) {
         return show_error('Guest Forbid to Access This Page.');
      }

      $data = array(
        'pekerjaan_data' => $pekerjaan,
        'controller' => 'Pekerjaan',
        'uri1' => 'Tambah Penanggung Jawab',
        'main_view' => 'pengadaan/pic_pekerjaan/add_pptk_form',
      );
      $this->load->view('template_view', $data);
    }
  }

  public function simpan(){
    $this->_rules();

    if ($this->form_validation->run() == FALSE) {
      $this->add_pic($this->input->post('id_p',TRUE));
    } else {
      $data = array(
        'nip' => $this->input->post('nip',TRUE),
        'nama' => $this->input->post('nama',TRUE),
        'status' => $this->input->post('status',TRUE),
        'tmt' => $this->input->post('tmt',TRUE),
        'pekerjaan' => $this->input->post('id_p',TRUE),
      );

      $this->Pic_model->insert($data);
      $this->session->set_flashdata('message', 'Data Berhasil Ditambahkan');
      redirect(site_url('pengadaan/pekerjaan/read/'.$this->input->post('id_p',TRUE)));
    }
  }

  public function delete($id,$id_p){
    $row = $this->Pekerjaan_model->get_by_id($id_p);
    if (!$row){
      $this->session->set_flashdata('error', 'Akses Dilarang (error 403 Prohibited)');
      redirect(site_url('pengadaan/pekerjaan'));
    } else {

      if ($this->ion_auth->in_group('guest')) {
         return show_error('Guest Forbid to Access This Page.');
      }
      $row = $this->Pic_model->get_by_id($id);

      if ($row) {
        $this->Pic_model->delete($id);
        $this->session->set_flashdata('message', 'Data Berhasil Dihapus');
        redirect(site_url('pengadaan/pekerjaan/read/'.$row->pekerjaan));
      } else {
        $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
        redirect(site_url('pengadaan/pekerjaan/read/'.$row->pekerjaan));
      }
    }
  }

  public function _rules()
  {
    $this->form_validation->set_rules('nip', 'Nip', 'trim|required');
    $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
    $this->form_validation->set_rules('status', 'Status', 'trim|required');
    $this->form_validation->set_rules('tmt', 'TMT', 'trim|required');

    $this->form_validation->set_rules('id_p', 'Pekerjaan', 'trim');
    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
  }

}
