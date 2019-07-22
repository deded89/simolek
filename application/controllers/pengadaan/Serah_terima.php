<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Serah_terima extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('pengadaan/Serah_terima_model');
    $this->load->model('pengadaan/Pekerjaan_model');
    $this->load->library('form_validation');
    if (!$this->ion_auth->logged_in())
    {
      redirect('auth/login', 'refresh');
    }else if ($this->ion_auth->in_group('user_biasa')) {
      return show_error('You must be an pptk to view this page.');
    }
  }

  // public function index()
  // {
  //   $serah_terima = $this->Serah_terima_model->get_all();
  //
  //   $data = array(
  //     'serah_terima_data' => $serah_terima,
  //     'controller' => 'pengadaan/serah_terima',
  //     'uri1' => 'List Serah_terima',
  //     'main_view' => 'pengadaan/serah_terima/serah_terima_list'
  //   );
  //   $data['hidden_attr'] = '';
  //   if (!$this->ion_auth->in_group('pptk')){
  //     $data['hidden_attr'] = 'hidden';
  //   }
  //   $this->load->view('template_view', $data);
  // }

  // public function read($id)
  // {
  //   $row = $this->Serah_terima_model->get_by_id($id);
  //   if ($row) {
  //     $data = array(
  //       'controller' => 'pengadaan/serah_terima',
  //       'uri1' => 'Data Serah_terima',
  //       'main_view' => 'pengadaan/serah_terima/serah_terima_read',
  //
  //       'id' => $row->id,
  //       'nomor' => $row->nomor,
  //       'tanggal' => $row->tanggal,
  //       'penyedia' => $row->penyedia,
  //     );
  //     $this->load->view('template_view', $data);
  //   } else {
  //     $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
  //     redirect(site_url('pengadaan/serah_terima'));
  //   }
  // }

  public function create($id_p)
  {
    $row = $this->Pekerjaan_model->get_by_id($id_p);
    if (!$row){
      $this->session->set_flashdata('error', 'Akses Dilarang (error 403 Prohibited)');
      redirect(site_url('pengadaan/pekerjaan'));
    } else {
      $data = array(
        'button' => 'Simpan',
        'action' => site_url('pengadaan/serah_terima/create_action'),
        'controller' => 'pengadaan/serah_terima',
        'uri1' => 'Tambah Serah_terima',
        'main_view' => 'pengadaan/serah_terima/serah_terima_form',

        'id_p' => set_value('id_p',$id_p),
        'nomor' => set_value('nomor'),
        'tanggal' => set_value('tanggal'),
        'penyedia' => set_value('penyedia'),
        'id_st' => set_value('id_st'),
      );
      $this->load->view('template_view', $data);
    }
  }

  public function create_action()
  {
    $this->_rules();

    if ($this->form_validation->run() == FALSE) {
      $this->create($this->input->post('id_p',TRUE));
    } else {
      $data = array(
        'nomor' => $this->input->post('nomor',TRUE),
        'tanggal' => $this->input->post('tanggal',TRUE),
        'penyedia' => $this->input->post('penyedia',TRUE),
        'pekerjaan' => $this->input->post('id_p',TRUE),
      );

      $this->Serah_terima_model->insert($data);
      $this->session->set_flashdata('message', 'Data Berhasil Ditambahkan');
      redirect(site_url('pengadaan/pekerjaan/read/'.$this->input->post('id_p',TRUE)));
    }
  }

  // public function update($id_k,$id_st)
  // {
  //   $row = $this->Serah_terima_model->get_by_id($id_st);
  //
  //   if ($row) {
  //     $data = array(
  //       'button' => 'Update',
  //       'action' => site_url('pengadaan/serah_terima/update_action'),
  //       'controller' => 'pengadaan/serah_terima',
  //       'uri1' => 'Update Serah_terima',
  //       'main_view' => 'pengadaan/serah_terima/serah_terima_form',
  //
  //       'id_st' => set_value('id_st', $row->id),
  //       'nomor' => set_value('nomor', $row->nomor),
  //       'tanggal' => set_value('tanggal', $row->tanggal),
  //       'penyedia' => set_value('penyedia', $row->penyedia),
  //     );
  //     $this->load->view('template_view', $data);
  //   } else {
  //     $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
  //     redirect(site_url('pengadaan/pekerjaan/read/'.$id_p));
  //   }
  // }
  //
  // public function update_action()
  // {
  //   $this->_rules();
  //
  //   if ($this->form_validation->run() == FALSE) {
  //     $this->update($this->input->post('id', TRUE));
  //   } else {
  //     $data = array(
  //       'nomor' => $this->input->post('nomor',TRUE),
  //       'tanggal' => $this->input->post('tanggal',TRUE),
  //       'penyedia' => $this->input->post('penyedia',TRUE),
  //     );
  //
  //     $this->Serah_terima_model->update($this->input->post('id', TRUE), $data);
  //     $this->session->set_flashdata('message', 'Update Data Berhasil');
  //     redirect(site_url('pengadaan/pekerjaan/read/'.$this->input->post('id_p',TRUE)));
  //   }
  // }

  public function delete($id_st,$id_p)
  {
    $row = $this->Pekerjaan_model->get_by_id($id_p);
    if (!$row){
      $this->session->set_flashdata('error', 'Akses Dilarang (error 403 Prohibited)');
      redirect(site_url('pengadaan/pekerjaan'));
    } else {
      $row = $this->Serah_terima_model->get_by_id($id_st);

      if ($row) {
        $this->Serah_terima_model->delete($id_st);
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
    $this->form_validation->set_rules('nomor', 'nomor', 'trim|required');
    $this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');
    $this->form_validation->set_rules('penyedia', 'penyedia', 'trim|required');

    $this->form_validation->set_rules('id', 'id', 'trim');
    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
  }

}

/* End of file Serah_terima.php */
/* Location: ./application/controllers/Serah_terima.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-05-27 13:31:01 */
/* http://harviacode.com */
?>
