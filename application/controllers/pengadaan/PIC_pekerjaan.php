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
        $data_pegawai = $this->session->userdata('data_pegawai');
        $nip_dicari = $this->session->userdata('nip_dicari');
        if ($data_pegawai){
          $data['nip'] = set_value('nip',$data_pegawai->nip);
          $data['nama'] = set_value('nama',$data_pegawai->nama);
          $data['kontak'] = set_value('kontak',$data_pegawai->kontak);
          $data['field_cari'] = 'disabled';
          $data['field_pic'] ='';
          $this->session->unset_userdata('data_pegawai');
        } elseif ($nip_dicari){
          $data['nip'] = set_value('nip',$nip_dicari);
          $data['nama'] = set_value('nama');
          $data['kontak'] = set_value('kontak');
          $data['field_cari'] = 'disabled';
          $data['field_pic'] ='';
          $this->session->unset_userdata('nip_dicari');
        } else {
          $data['nip'] = set_value('nip');
          $data['nama'] = set_value('nama');
          $data['kontak'] = set_value('kontak');
          $data['field_cari'] = '';
          $data['field_pic'] ='disabled';
        }
      $this->load->view('template_view', $data);
    }
  }

  public function simpan(){
    $this->_rules();

    if ($this->form_validation->run() == FALSE) {
      $this->session->set_userdata('nip_dicari',$this->input->post('id_p',TRUE));
      $this->add_pic($this->input->post('id_p',TRUE));
    } else {
      $data = array(
        'nip' => $this->input->post('nip',TRUE),
        'nama' => $this->input->post('nama',TRUE),
        'status' => $this->input->post('status',TRUE),
        'tmt' => $this->input->post('tmt',TRUE),
        'pekerjaan' => $this->input->post('id_p',TRUE),
        'kontak' => $this->input->post('kontak',TRUE),
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
    $this->form_validation->set_rules('nip', 'Nip', 'trim|required|callback_cek_duplikat');
    $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
    $this->form_validation->set_rules('status', 'Status', 'trim|required|callback_cek_duplikat');
    $this->form_validation->set_rules('tmt', 'TMT', 'trim|required');
    $this->form_validation->set_rules('kontak', 'Kontak', 'trim|required');

    $this->form_validation->set_rules('id_p', 'Pekerjaan', 'trim');
    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
  }

  public function cek_duplikat(){
    $data = array (
      'nip'    => $this->input->post('nip',TRUE),
      'status'  => $this->input->post('status',TRUE),
      'id_p'  => $this->input->post('id_p',TRUE),
    );
    $num = $this->Pic_model->cek_duplikat_pegawai($data);
    if ($num > 0){
      $this->form_validation->set_message('cek_duplikat', 'Pegawai dengan nip dan status ini sudah ada, silakan hapus terlebih dahulu jika ada perbaikan');
      return false;
    }else{
      return true;
    }
  }

  public function cari_pegawai($id_p){
    $nip = $this->input->post('cari_nip',TRUE);
    $result = $this->Pic_model->cek_pegawai($nip);
    if ($result){
      $this->session->set_userdata('data_pegawai',$result);
      redirect(site_url('pengadaan/PIC_pekerjaan/add_pic/'.$id_p));
    }else{
      $this->session->set_userdata('nip_dicari',$nip);
      $this->session->set_flashdata('error','Pegawai dengan NIP '.$nip.' tidak ada di database, silakan tambahkan data di kolom yang disediakan');
      redirect(site_url('pengadaan/PIC_pekerjaan/add_pic/'.$id_p));
    }

  }

}
