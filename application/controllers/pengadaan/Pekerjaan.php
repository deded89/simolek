<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pekerjaan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('pengadaan/Pekerjaan_model');
        $this->load->model('pengadaan/Kontrak_model');
        $this->load->model('pengadaan/Serah_terima_model');
        $this->load->model('pengadaan/Progress_pekerjaan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
      $pekerjaan = $this->Pekerjaan_model->get_all();
      $data = array(
        'pekerjaan_data' => $pekerjaan,
        'controller' => 'Pekerjaan',
        'uri1' => 'List Pekerjaan',
        'main_view' => 'pengadaan/pekerjaan/pekerjaan_list'
      );
      $this->load->view('template_view', $data);
    }

    public function read($id)
    {
      $this->Progress_pekerjaan_model->update_progress_now($id);
      
      $row = $this->Pekerjaan_model->get_by_id($id);
      $kontrak_data = $this->Kontrak_model->get_by_id_p($id);
      $st_data = $this->Serah_terima_model->get_by_id_p($id);
      $pp_data = $this->Progress_pekerjaan_model->get_by_id_p($id);
      $total_kontrak = $this->Kontrak_model->sum_nilai_kontrak($id);

      if ($row) {
        $data = array(
          'controller' => 'Pekerjaan',
          'uri1' => 'Data Pekerjaan',
          'main_view' => 'pengadaan/pekerjaan/pekerjaan_read',

          'id_p' => $row->id_p,
          'nama' => $row->nama,
          'kegiatan' => $row->kegiatan,
          'skpd' => $row->nama_skpd,
          'jenis' => $row->jenis,
          'metode' => $row->metode,
          'pagu' => $row->pagu,
          'progress_now' => $row->pr_now,

          'kontrak_data'=>$kontrak_data,
          'st_data'=>$st_data,
          'pp_data'=>$pp_data,
          'nilai_kontrak'=>$total_kontrak,
        );
        $this->load->view('template_view', $data);
      } else {
        $this->session->set_flashdata('error', 'Data Tidak Ditemukan');
        redirect(site_url('pengadaan/pekerjaan'));
      }
    }

    public function create()
    {
      $data = array(
        'button' => 'Simpan',
        'action' => site_url('pengadaan/pekerjaan/create_action'),
        'controller' => 'Pekerjaan',
        'uri1' => 'Tambah Pekerjaan',
        'main_view' => 'pengadaan/pekerjaan/pekerjaan_form',

        'id_p' => set_value('id_p'),
        'nama' => set_value('nama'),
        'kegiatan' => set_value('kegiatan'),
        'skpd' => set_value('skpd'),
        'jenis' => set_value('jenis'),
        'metode' => set_value('metode'),
        'pagu' => set_value('pagu'),
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
          'nama' => $this->input->post('nama',TRUE),
          'kegiatan' => $this->input->post('kegiatan',TRUE),
          'skpd' => $this->input->post('skpd',TRUE),
          'jenis' => $this->input->post('jenis',TRUE),
          'metode' => $this->input->post('metode',TRUE),
          'pagu' => $this->input->post('pagu',TRUE),
        );

        $this->Pekerjaan_model->insert($data);
        $this->session->set_flashdata('message', 'Data Berhasil Ditambahkan');
        redirect(site_url('pengadaan/pekerjaan'));
      }
    }

    public function update($id)
    {
      $row = $this->Pekerjaan_model->get_by_id($id);

      if ($row) {
        $data = array(
          'button' => 'Update',
          'action' => site_url('pengadaan/pekerjaan/update_action'),
          'controller' => 'Pekerjaan',
          'uri1' => 'Update Pekerjaan',
          'main_view' => 'pengadaan/pekerjaan/pekerjaan_form',

          'id_p' => set_value('id', $id),
          'nama' => set_value('nama', $row->nama),
          'kegiatan' => set_value('kegiatan', $row->kegiatan),
          'skpd' => set_value('skpd', $row->id_skpd),
          'jenis' => set_value('jenis', $row->id_j),
          'metode' => set_value('metode', $row->id_m),
          'pagu' => set_value('pagu', $row->pagu),
        );
        $this->load->view('template_view', $data);
      } else {
        $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
        redirect(site_url('pengadaan/pekerjaan'));
      }
    }

    public function update_action()
    {
      $this->_rules();

      if ($this->form_validation->run() == FALSE) {
        $this->update($this->input->post('id', TRUE));
      } else {
        $data = array(
          'nama' => $this->input->post('nama',TRUE),
          'kegiatan' => $this->input->post('kegiatan',TRUE),
          'skpd' => $this->input->post('skpd',TRUE),
          'jenis' => $this->input->post('jenis',TRUE),
          'metode' => $this->input->post('metode',TRUE),
          'pagu' => $this->input->post('pagu',TRUE),
        );

        $this->Pekerjaan_model->update($this->input->post('id', TRUE), $data);
        $this->session->set_flashdata('message', 'Update Data Berhasil');
        redirect(site_url('pengadaan/pekerjaan'));
      }
    }

    public function delete($id)
    {
        $row = $this->Pekerjaan_model->get_by_id($id);

        if ($row) {
            $this->Pekerjaan_model->delete($id);
            $this->session->set_flashdata('message', 'Data Berhasil Dihapus');
            redirect(site_url('pengadaan/pekerjaan'));
        } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
            redirect(site_url('pengadaan/pekerjaan'));
        }
    }

    public function _rules()
    {
      $this->form_validation->set_rules('nama', 'nama', 'trim|required');
      $this->form_validation->set_rules('kegiatan', 'kegiatan', 'trim|required');
      $this->form_validation->set_rules('skpd', 'skpd', 'trim|required');
      $this->form_validation->set_rules('jenis', 'jenis', 'trim|required');
      $this->form_validation->set_rules('metode', 'metode', 'trim|required');
      $this->form_validation->set_rules('pagu', 'pagu', 'trim|required|numeric');

      $this->form_validation->set_rules('id', 'id', 'trim');
      $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Pekerjaan.php */
/* Location: ./application/controllers/Pekerjaan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-05-27 13:30:41 */
/* http://harviacode.com */
?>
