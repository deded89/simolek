<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Jabatan extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('Jabatan_model');
    $this->load->library('form_validation');
    if (!$this->ion_auth->logged_in())
    {
      redirect('auth/login', 'refresh');
    }else if (!$this->ion_auth->in_group('admin')) {
      return show_error('You must be an admin to view this page.');
    }
  }

  public function index()
  {
    $jabatan = $this->Jabatan_model->get_all();
    $data = array(
      'jabatan_data' => $jabatan,
      'controller' => 'Jabatan',
      'uri1' => 'List Jabatan',
      'main_view' => 'jabatan/jabatan_list'
    );

    $this->load->view('template_view', $data);
  }

  public function read($id)
  {
    //$id = $this->encryption->decrypt($id);
    $row = $this->Jabatan_model->get_by_id($id);
    if ($row) {
      $data = array(
        'controller' => 'Jabatan',
        'uri1' => 'Data Jabatan',
        'main_view' => 'jabatan/jabatan_read',

        'id_jab' => $row->id_jab,
        'nama_level' => $row->nama_level,
        'nama_jab' => $row->nama_jab,
        'nama_skpd' => $row->nama_skpd,
        'nama_lengkap' => $row->nama_lengkap,
      );
      $this->load->view('template_view', $data);
    } else {
      $this->session->set_flashdata('error', 'Data Tidak Ditemukan');
      redirect(site_url('jabatan'));
    }
  }

  public function create()
  {
    $data = array(
      'button' => 'Simpan',
      'action' => site_url('jabatan/create_action'),
      'controller' => 'Jabatan',
      'uri1' => 'Tambah Jabatan',
      'main_view' => 'jabatan/jabatan_form',

      'id_jab' => set_value('id_jab'),
      'id_level' => set_value('id_level'),
      'nama_jab' => set_value('nama_jab'),
      'id_skpd' => set_value('id_skpd'),
      'nip' => set_value('nip'),
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
        'id_level' => $this->input->post('id_level',TRUE),
        'nama_jab' => $this->input->post('nama_jab',TRUE),
        'id_skpd' => $this->input->post('id_skpd',TRUE),
        'nip' => $this->input->post('nip',TRUE),
      );

      $this->Jabatan_model->insert($data);
      $this->session->set_flashdata('info', 'Buatkan Username untuk Jabatan '.$data['nama_jab']);
      $current_id = $this->Jabatan_model->get_last_id();
      redirect(site_url('auth/create_user/'.$current_id));
    }
  }

  public function update($id)
  {

    $row = $this->Jabatan_model->get_by_id($id);
    if ($row) {
      $data = array(
        'button' => 'Update',
        'action' => site_url('jabatan/update_action'),
        'controller' => 'Jabatan',
        'uri1' => 'List Jabatan',
        'main_view' => 'jabatan/jabatan_form',

        'id_jab' => set_value('id_jab', $row->id_jab),
        'id_level' => set_value('id_level', $row->id_level),
        'nama_jab' => set_value('nama_jab', $row->nama_jab),
        'id_skpd' => set_value('id_skpd', $row->id_skpd),
        'nip' => set_value('nip', $row->nip),
      );
      $this->load->view('template_view', $data);
    } else {
      $this->session->set_flashdata('error', 'Data Tidak Ditemukan');
      redirect(site_url('jabatan'));
    }
  }

  public function update_action()
  {
    $this->_rules();

    if ($this->form_validation->run() == FALSE) {
      $this->update($this->input->post('id_jab', TRUE));
    } else {
      $data = array(
        'id_level' => $this->input->post('id_level',TRUE),
        'nama_jab' => $this->input->post('nama_jab',TRUE),
        'id_skpd' => $this->input->post('id_skpd',TRUE),
        'nip' => $this->input->post('nip',TRUE),
      );

      $this->Jabatan_model->update($this->input->post('id_jab', TRUE), $data);
      $this->session->set_flashdata('message', 'Update Data Berhasil');
      redirect(site_url('jabatan'));
    }
  }

  public function delete($id)
  {

    if ($this->cek_fk($id) != TRUE)
    {
      $row = $this->Jabatan_model->get_by_id($id);
      if ($row) {
        $this->Jabatan_model->delete($id);
        $this->session->set_flashdata('message', 'Data Berhasil Dihapus');
        redirect(site_url('jabatan'));
      } else {
        $this->session->set_flashdata('error', 'Data Tidak Ditemukan');
        redirect(site_url('jabatan'));
      }
    }
    else
    {
      $this->session->set_flashdata('error', 'Data tidak bisa dihapus karena memiliki koneksi ke data lain');
      redirect(site_url('jabatan'));
    }
  }

  public function cek_fk($id)
  {
    $fk = $this->Jabatan_model->get_fk_by_id($id);
    if ($fk > 0)
    {
      return TRUE;
    }
  }

  public function _rules()
  {
    $this->form_validation->set_rules('id_level', 'id level', 'trim|required');
    $this->form_validation->set_rules('nama_jab', 'nama jab', 'trim|required');
    $this->form_validation->set_rules('id_skpd', 'id skpd', 'trim|required');
    $this->form_validation->set_rules('nip', 'nama pegawai', 'trim');

    $this->form_validation->set_rules('id_jab', 'id_jab', 'trim');
    $this->form_validation->set_error_delimiters('<div class="callout callout-danger">', '</div>');
  }

  function pdf()
  {
    $data = array(
      'jabatan_data' => $this->Jabatan_model->get_all(),
      'start' => 0
    );

    ini_set('memory_limit', '32M');
    $this->load->library('pdfgenerator');
    $psize = 'folio'; //setting kertas
    $orient = 'landscape'; 	//setting orientasi

    $html = $this->load->view('jabatan/jabatan_pdf', $data, true);

    $this->pdfgenerator->generate($html,'list jabatan',$psize,$orient);

  }

}

/* End of file Jabatan.php */
/* Location: ./application/controllers/Jabatan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-07-05 04:38:23 */
/* http://harviacode.com */
?>
