<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Periode_setting extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('lkpk/Periode_setting_model');
    $this->load->library('form_validation');
  }

  public function index()
  {
    $periode_setting = $this->Periode_setting_model->get_all();

    $data = array(
      'periode_setting_data' => $periode_setting,
      'controller' => 'Periode_setting',
      'uri1' => 'List Periode_setting',
      'main_view' => 'lkpk/periode_setting/periode_setting_list'
    );

    $this->load->view('template_view', $data);
  }

  public function read($id)
  {
    $row = $this->Periode_setting_model->get_by_id($id);
    if ($row) {
      $data = array(
        'controller' => 'Periode_setting',
        'uri1' => 'Data Periode_setting',
        'main_view' => 'lkpk/periode_setting/periode_setting_read',

        'id_per_setting' => $row->id_per_setting,
        'tahun' => $row->tahun,
        'skpd' => $row->skpd,
        'b01' => $row->b01,
        'b02' => $row->b02,
        'b03' => $row->b03,
        'b04' => $row->b04,
        'b05' => $row->b05,
        'b06' => $row->b06,
        'b07' => $row->b07,
        'b08' => $row->b08,
        'b09' => $row->b09,
        'b10' => $row->b10,
        'b11' => $row->b11,
        'b12' => $row->b12,
      );
      $this->load->view('template_view', $data);
    } else {
      $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
      redirect(site_url('lkpk/periode_setting'));
    }
  }

  public function create()
  {
    $data = array(
      'button' => 'Simpan',
      'action' => site_url('lkpk/periode_setting/create_action'),
      'controller' => 'Periode_setting',
      'uri1' => 'Tambah Periode_setting',
      'main_view' => 'lkpk/periode_setting/periode_setting_form',

      'id_per_setting' => set_value('id_per_setting'),
      'tahun' => set_value('tahun'),
      'skpd' => set_value('skpd'),
      'b01' => set_value('b01'),
      'b02' => set_value('b02'),
      'b03' => set_value('b03'),
      'b04' => set_value('b04'),
      'b05' => set_value('b05'),
      'b06' => set_value('b06'),
      'b07' => set_value('b07'),
      'b08' => set_value('b08'),
      'b09' => set_value('b09'),
      'b10' => set_value('b10'),
      'b11' => set_value('b11'),
      'b12' => set_value('b12'),
    );
    $this->load->view('template_view', $data);
  }

  public function create_action()
  {
    $this->_rules();

    if ($this->form_validation->run() == FALSE) {
      $this->create();
    } else {
      $data = array(
        'tahun' => $this->input->post('tahun',TRUE),
        'skpd' => $this->input->post('skpd',TRUE),
        'b01' => $this->input->post('b01',TRUE),
        'b02' => $this->input->post('b02',TRUE),
        'b03' => $this->input->post('b03',TRUE),
        'b04' => $this->input->post('b04',TRUE),
        'b05' => $this->input->post('b05',TRUE),
        'b06' => $this->input->post('b06',TRUE),
        'b07' => $this->input->post('b07',TRUE),
        'b08' => $this->input->post('b08',TRUE),
        'b09' => $this->input->post('b09',TRUE),
        'b10' => $this->input->post('b10',TRUE),
        'b11' => $this->input->post('b11',TRUE),
        'b12' => $this->input->post('b12',TRUE),
      );

      $this->Periode_setting_model->insert($data);
      $this->session->set_flashdata('message', 'Data Berhasil Ditambahkan');
      redirect(site_url('lkpk/periode_setting'));
    }
  }

  public function update($id)
  {
    $row = $this->Periode_setting_model->get_by_id($id);

    if ($row) {
      $data = array(
        'button' => 'Update',
        'action' => site_url('lkpk/periode_setting/update_action'),
        'controller' => 'Periode_setting',
        'uri1' => 'Update Periode_setting',
        'main_view' => 'lkpk/periode_setting/periode_setting_form',

        'id_per_setting' => set_value('id_per_setting', $row->id_per_setting),
        'tahun' => set_value('tahun', $row->tahun),
        'skpd' => set_value('skpd', $row->skpd),
        'b01' => set_value('b01', $row->b01),
        'b02' => set_value('b02', $row->b02),
        'b03' => set_value('b03', $row->b03),
        'b04' => set_value('b04', $row->b04),
        'b05' => set_value('b05', $row->b05),
        'b06' => set_value('b06', $row->b06),
        'b07' => set_value('b07', $row->b07),
        'b08' => set_value('b08', $row->b08),
        'b09' => set_value('b09', $row->b09),
        'b10' => set_value('b10', $row->b10),
        'b11' => set_value('b11', $row->b11),
        'b12' => set_value('b12', $row->b12),
      );
      $this->load->view('template_view', $data);
    } else {
      $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
      redirect(site_url('lkpk/periode_setting'));
    }
  }

  public function update_action()
  {
    $this->_rules();

    if ($this->form_validation->run() == FALSE) {
      $this->update($this->input->post('id_per_setting', TRUE));
    } else {
      $data = array(
        'tahun' => $this->input->post('tahun',TRUE),
        'skpd' => $this->input->post('skpd',TRUE),
        'b01' => $this->input->post('b01',TRUE),
        'b02' => $this->input->post('b02',TRUE),
        'b03' => $this->input->post('b03',TRUE),
        'b04' => $this->input->post('b04',TRUE),
        'b05' => $this->input->post('b05',TRUE),
        'b06' => $this->input->post('b06',TRUE),
        'b07' => $this->input->post('b07',TRUE),
        'b08' => $this->input->post('b08',TRUE),
        'b09' => $this->input->post('b09',TRUE),
        'b10' => $this->input->post('b10',TRUE),
        'b11' => $this->input->post('b11',TRUE),
        'b12' => $this->input->post('b12',TRUE),
      );

      $this->Periode_setting_model->update($this->input->post('id_per_setting', TRUE), $data);
      $this->session->set_flashdata('message', 'Update Data Berhasil');
      redirect(site_url('lkpk/periode_setting'));
    }
  }

  public function delete($id)
  {
    $row = $this->Periode_setting_model->get_by_id($id);

    if ($row) {
      $this->Periode_setting_model->delete($id);
      $this->session->set_flashdata('message', 'Data Berhasil Dihapus');
      redirect(site_url('lkpk/periode_setting'));
    } else {
      $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
      redirect(site_url('lkpk/periode_setting'));
    }
  }

  public function _rules()
  {
    $this->form_validation->set_rules('tahun', 'tahun', 'trim|required');
    $this->form_validation->set_rules('skpd', 'skpd', 'trim|required');
    $this->form_validation->set_rules('b01', 'b01', 'trim|required');
    $this->form_validation->set_rules('b02', 'b02', 'trim|required');
    $this->form_validation->set_rules('b03', 'b03', 'trim|required');
    $this->form_validation->set_rules('b04', 'b04', 'trim|required');
    $this->form_validation->set_rules('b05', 'b05', 'trim|required');
    $this->form_validation->set_rules('b06', 'b06', 'trim|required');
    $this->form_validation->set_rules('b07', 'b07', 'trim|required');
    $this->form_validation->set_rules('b08', 'b08', 'trim|required');
    $this->form_validation->set_rules('b09', 'b09', 'trim|required');
    $this->form_validation->set_rules('b10', 'b10', 'trim|required');
    $this->form_validation->set_rules('b11', 'b11', 'trim|required');
    $this->form_validation->set_rules('b12', 'b12', 'trim|required');

    $this->form_validation->set_rules('id_per_setting', 'id_per_setting', 'trim');
    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
  }

}

/* End of file Periode_setting.php */
/* Location: ./application/controllers/Periode_setting.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-09-30 09:06:30 */
/* http://harviacode.com */
?>
