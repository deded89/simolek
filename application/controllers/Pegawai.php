<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Pegawai extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('Pegawai_model');
    $this->load->library('form_validation');
    if (!$this->ion_auth->logged_in())
    {
      redirect('auth/login', 'refresh');
    }else if (!$this->ion_auth->in_group('admin')) {
      return show_error('You must be an pengelola to view this page.');
    }
  }

  public function index()
  {
    $pegawai = $this->Pegawai_model->get_all();

    $data = array(
      'pegawai_data' => $pegawai,
      'controller' => 'Pegawai',
      'uri1' => 'List Pegawai',
      'main_view' => 'pegawai/pegawai_list'
    );

    $this->load->view('template_view', $data);
  }

  public function read($id)
  {
    $row = $this->Pegawai_model->get_by_id($id);
    if ($row) {
      $data = array(
        'controller' => 'Pegawai',
        'uri1' => 'Data Pegawai',
        'main_view' => 'pegawai/pegawai_read',

        'nip' => $row->nip,
        'nama_lengkap' => $row->nama_lengkap,
        'id_skpd' => $row->nama_skpd,
      );
      $this->load->view('template_view', $data);
    } else {
      $this->session->set_flashdata('error', 'Data Tidak Ditemukan');
      redirect(site_url('pegawai'));
    }
  }

  public function create()
  {
    $data = array(
      'button' => 'Simpan',
      'action' => site_url('pegawai/create_action'),
      'controller' => 'Pegawai',
      'uri1' => 'Tambah Pegawai',
      'main_view' => 'pegawai/pegawai_form',

      'nip' => set_value('nip'),
      'nama_lengkap' => set_value('nama_lengkap'),
      'id_skpd' => set_value('id_skpd'),
    );
    $this->load->view('template_view', $data);
  }

  public function create_action()
  {
    $this->_rules();

    if ($this->form_validation->run() == FALSE) {
      $this->create();
    } else {
      $row = $this->Pegawai_model->get_pk_sama($this->input->post('nip', TRUE));
      if ($row > 0)
      {
        $this->session->set_flashdata('error', 'NIP tersebut sudah ada ');
        $this->update($this->input->post('nip', TRUE));
      } else
      {
        $data = array(
          'nip' => $this->input->post('nip',TRUE),
          'nama_lengkap' => $this->input->post('nama_lengkap',TRUE),
          'id_skpd' => $this->input->post('id_skpd',TRUE),
        );

        $this->Pegawai_model->insert($data);
        $this->session->set_flashdata('message', 'Data Berhasil Ditambahkan');
        redirect(site_url('pegawai/create'));
      }
    }
  }

  public function update($id)
  {
    $row = $this->Pegawai_model->get_by_id($id);

    if ($row) {
      $data = array(
        'button' => 'Update',
        'action' => site_url('pegawai/update_action/'.$id),
        'controller' => 'Pegawai',
        'uri1' => 'Update Pegawai',
        'main_view' => 'pegawai/pegawai_form',

        'nip' => set_value('nip', $row->nip),
        'nama_lengkap' => set_value('nama_lengkap', $row->nama_lengkap),
        'id_skpd' => set_value('id_skpd', $row->id_skpd),
      );
      $this->load->view('template_view', $data);
    } else {
      $this->session->set_flashdata('error', 'Data Tidak Ditemukan');
      redirect(site_url('pegawai'));
    }
  }

  public function update_action($id)
  {
    $this->_rules();

    if ($this->form_validation->run() == FALSE) {
      $this->update($this->input->post('nip', TRUE));
    } else {
      $data = array(
        'nip' => $this->input->post('nip',TRUE),
        'nama_lengkap' => $this->input->post('nama_lengkap',TRUE),
        'id_skpd' => $this->input->post('id_skpd',TRUE),
      );
      //JIKA NIP DIRUBAH
      if ($id <> $this->input->post('nip', TRUE))
      {
        //CEK APAKAH NIP YG DIRUBAH SUDAH ADA
        $row = $this->Pegawai_model->get_pk_sama($this->input->post('nip', TRUE));
        if ($row > 0)
        {
          //JIKA ADA ERROR
          $this->session->set_flashdata('error', 'NIP tersebut sudah ada ');
          $this->update($this->input->post('nip', TRUE));
        } else
        {
          $this->Pegawai_model->update($id, $data);
          $this->session->set_flashdata('message', 'Update Data Berhasil');
          redirect(site_url('pegawai'));
        }
      }
      else
      {
        $this->Pegawai_model->update($id, $data);
        $this->session->set_flashdata('message', 'Update Data Berhasil');
        redirect(site_url('pegawai'));
      }
    }
  }

  public function delete($id)
  {
    //CEK APAKAH DATA SUDAH ADA KONEKSI KE TABLE LAIN FK=FOREIGN KEY
    if ($this->cek_fk($id) != TRUE)
    {
      $row = $this->Pegawai_model->get_by_id($id);
      if ($row) {
        $this->Pegawai_model->delete($id);
        $this->session->set_flashdata('message', 'Data Berhasil Dihapus');
        redirect(site_url('pegawai'));
      } else {
        $this->session->set_flashdata('error', 'Data Tidak Ditemukan');
        redirect(site_url('pegawai'));
      }
    }else
    {
      $this->session->set_flashdata('error', 'Data tidak bisa dihapus karena memiliki koneksi ke data lain');
      redirect(site_url('jabatan'));
    }
  }

  public function cek_fk($id)
  {
    $fk = $this->Pegawai_model->get_fk_by_id($id);
    if ($fk > 0)
    {
      return TRUE;
    }
  }

  public function _rules()
  {
    $this->form_validation->set_rules('nama_lengkap', 'nama lengkap', 'trim|required');
    // $this->form_validation->set_rules('id_skpd', 'id skpd', 'trim|required');

    $this->form_validation->set_rules('nip', 'nip', 'trim|required|numeric');
    //|is_unique[pegawai.nip]',array('is_unique' => 'Pegawai dengan NIP tersebut sudah ada'));
    $this->form_validation->set_error_delimiters('<div class="callout callout-danger">', '</div>');
  }

  function pdf()
  {
    $data = array(
      'pegawai_data' => $this->Pegawai_model->get_all(),
      'start' => 0
    );

    ini_set('memory_limit', '32M');
    $this->load->library('pdfgenerator');
    $psize = 'folio'; //setting kertas
    $orient = 'landscape'; 	//setting orientasi

    $html = $this->load->view('pegawai/pegawai_pdf', $data, true);

    $this->pdfgenerator->generate($html,'list Pegawai',$psize,$orient);

  }

}

/* End of file Pegawai.php */
/* Location: ./application/controllers/Pegawai.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-07-14 20:08:03 */
/* http://harviacode.com */
?>
