<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Progress_pekerjaan extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('pengadaan/Progress_pekerjaan_model');
    $this->load->model('pengadaan/Pekerjaan_model');
    $this->load->model('pengadaan/Kontrak_model');
    $this->load->library('form_validation');
    if (!$this->ion_auth->logged_in())
    {
      redirect('auth/login', 'refresh');
    }else if (!$this->ion_auth->in_group('pptk') AND !$this->ion_auth->in_group('pengelola')) {
      return show_error('You must be an pptk to view this page.');
    }
  }

  // public function index()
  // {
  //   $progress_pekerjaan = $this->Progress_pekerjaan_model->get_all();
  //
  //   $data = array(
  //     'progress_pekerjaan_data' => $progress_pekerjaan,
  //     'controller' => 'pengadaan/progress_pekerjaan',
  //     'uri1' => 'List Progress_pekerjaan',
  //     'main_view' => 'pengadaan/progress_pekerjaan/progress_pekerjaan_list'
  //   );
  //   $data['hidden_attr'] = '';
  //   if (!$this->ion_auth->in_group('pptk') AND !$this->ion_auth->in_group('pengelola')){
  //     $data['hidden_attr'] = 'hidden';
  //   }
  //
  //   $this->load->view('template_view', $data);
  // }

  // public function read($id)
  // {
  //   $row = $this->Progress_pekerjaan_model->get_by_id($id);
  //   if ($row) {
  //     $data = array(
  //       'controller' => 'pengadaan/progress_pekerjaan',
  //       'uri1' => 'Data Progress_pekerjaan',
  //       'main_view' => 'pengadaan/progress_pekerjaan/progress_pekerjaan_read',
  //
  //       'id' => $row->id,
  //       'pekerjaan' => $row->pekerjaan,
  //       'progress' => $row->progress,
  //       'tgl_progress' => $row->tgl_progress,
  //       'next_progress' => $row->next_progress,
  //       'tgl_n_progress' => $row->tgl_n_progress,
  //       'ket' => $row->ket,
  //     );
  //     $this->load->view('template_view', $data);
  //   } else {
  //     $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
  //     redirect(site_url('pengadaan/progress_pekerjaan'));
  //   }
  // }

  public function create($id_p)
  {
    $row = $this->Pekerjaan_model->get_by_id($id_p);
    if (!$row){
      $this->session->set_flashdata('error', 'Akses Dilarang (error 403 Prohibited)');
      redirect(site_url('pengadaan/pekerjaan'));
    } else {
      $row = $this->Progress_pekerjaan_model->get_last_record($id_p);
      if ($row){
        $data = array(
          'button' => 'Simpan',
          'action' => site_url('pengadaan/progress_pekerjaan/create_action'),
          'controller' => 'pengadaan/progress_pekerjaan',
          'uri1' => 'Tambah Progress_pekerjaan',
          'main_view' => 'pengadaan/progress_pekerjaan/progress_pekerjaan_form',

          'id_prog' => set_value('id_prog'),
          'id_p' => set_value('id_p',$id_p),
          'progress' => set_value('progress',$row->progress),
          'tgl_progress' => set_value('tgl_progress',$row->tgl_progress),
          'next_progress' => set_value('next_progress',$row->next_progress),
          'tgl_n_progress' => set_value('tgl_n_progress',$row->tgl_n_progress),
          'ket' => set_value('ket',$row->ket),
          'real_keu' => set_value('real_keu',$row->real_keu),
          'real_fisik' => set_value('real_fisik',$row->real_fisik),
        );
      } else {
        $data = array(
          'button' => 'Simpan',
          'action' => site_url('pengadaan/progress_pekerjaan/create_action'),
          'controller' => 'pengadaan/progress_pekerjaan',
          'uri1' => 'Tambah Progress_pekerjaan',
          'main_view' => 'pengadaan/progress_pekerjaan/progress_pekerjaan_form',

          'id_prog' => set_value('id_prog'),
          'id_p' => set_value('id_p',$id_p),
          'progress' => set_value('progress'),
          'tgl_progress' => set_value('tgl_progress'),
          'next_progress' => set_value('next_progress'),
          'tgl_n_progress' => set_value('tgl_n_progress'),
          'ket' => set_value('ket'),
          'real_keu' => set_value('real_keu'),
          'real_fisik' => set_value('real_fisik'),
        );
      }
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
        'pekerjaan' => $this->input->post('id_p',TRUE),
        'progress' => $this->input->post('progress',TRUE),
        'tgl_progress' => $this->input->post('tgl_progress',TRUE),
        'next_progress' => $this->input->post('next_progress',TRUE),
        'tgl_n_progress' => $this->input->post('tgl_n_progress',TRUE),
        'ket' => $this->input->post('ket',TRUE),
        'real_keu' => $this->input->post('real_keu',TRUE),
        'real_fisik' => $this->input->post('real_fisik',TRUE),
        'create_date' => date('Y-m-d H:i:s'),
      );
      //CEK JIKA MAU ADD REALISASI KEUANGAN NILAINYA TIDAK BOLEH > TOTAL KONTRAK
      $new_real_keu = $this->input->post('real_keu',TRUE) + 0;
      // $int_real_keu = int()$new_real_keu;
      $total_kontrak = $this->Kontrak_model->sum_nilai_kontrak($this->input->post('id_p',TRUE));
      if($new_real_keu > $total_kontrak){
        $this->session->set_flashdata('error', 'Realisasi Pengadaan Tidak Boleh Melebihi Total Kontrak');
        redirect(site_url('pengadaan/pekerjaan/read/'.$this->input->post('id_p',TRUE)));
      }


      $this->Progress_pekerjaan_model->insert($data);
      $this->Progress_pekerjaan_model->update_progress_now($this->input->post('id_p',TRUE));
      $id_p = $this->input->post('id_p',TRUE);

      $this->session->set_flashdata('message', 'Data Berhasil Ditambahkan');
      redirect(site_url('pengadaan/pekerjaan/read/'.$this->input->post('id_p',TRUE)));
    }
  }


  // public function update($id)
  // {
  //   $row = $this->Progress_pekerjaan_model->get_by_id($id);
  //
  //   if ($row) {
  //     $data = array(
  //       'button' => 'Update',
  //       'action' => site_url('pengadaan/progress_pekerjaan/update_action'),
  //       'controller' => 'pengadaan/progress_pekerjaan',
  //       'uri1' => 'Update Progress_pekerjaan',
  //       'main_view' => 'pengadaan/progress_pekerjaan/progress_pekerjaan_form',
  //
  //       'id' => set_value('id', $row->id),
  //       'pekerjaan' => set_value('pekerjaan', $row->pekerjaan),
  //       'progress' => set_value('progress', $row->progress),
  //       'tgl_progress' => set_value('tgl_progress', $row->tgl_progress),
  //       'next_progress' => set_value('next_progress', $row->next_progress),
  //       'tgl_n_progress' => set_value('tgl_n_progress', $row->tgl_n_progress),
  //       'ket' => set_value('ket', $row->ket),
  //     );
  //     $this->load->view('template_view', $data);
  //   } else {
  //     $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
  //     redirect(site_url('pengadaan/progress_pekerjaan'));
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
  //       'pekerjaan' => $this->input->post('pekerjaan',TRUE),
  //       'progress' => $this->input->post('progress',TRUE),
  //       'tgl_progress' => $this->input->post('tgl_progress',TRUE),
  //       'next_progress' => $this->input->post('next_progress',TRUE),
  //       'tgl_n_progress' => $this->input->post('tgl_n_progress',TRUE),
  //       'ket' => $this->input->post('ket',TRUE),
  //     );
  //
  //     $this->Progress_pekerjaan_model->update($this->input->post('id', TRUE), $data);
  //     $this->session->set_flashdata('message', 'Update Data Berhasil');
  //     redirect(site_url('pengadaan/progress_pekerjaan'));
  //   }
  // }

  public function delete($id,$id_p)
  {
    $row = $this->Pekerjaan_model->get_by_id($id_p);
    if (!$row){
      $this->session->set_flashdata('error', 'Akses Dilarang (error 403 Prohibited)');
      redirect(site_url('pengadaan/pekerjaan'));
    } else {
      $row = $this->Progress_pekerjaan_model->get_by_id($id);

      if ($row) {
        $this->Progress_pekerjaan_model->delete($id);
        $this->Progress_pekerjaan_model->update_progress_now($id_p);
        $this->session->set_flashdata('message', 'Data Berhasil Dihapus');
        redirect(site_url('pengadaan/pekerjaan/read/'.$row->pekerjaan));
      } else {
        $this->session->set_flashdata('error', 'Data Tidak Ditemukan or Akses Prohibited');
        redirect(site_url('pengadaan/pekerjaan/read/'.$row->pekerjaan));
      }
    }
  }

  public function _rules()
  {
    $this->form_validation->set_rules('pekerjaan', 'pekerjaan', 'trim|required');
    $this->form_validation->set_rules('progress', 'progress', 'trim|required');
    $this->form_validation->set_rules('tgl_progress', 'tgl progress', 'trim|required');
    $this->form_validation->set_rules('next_progress', 'next progress', 'trim|required');
    $this->form_validation->set_rules('tgl_n_progress', 'tgl n progress', 'trim|required');
    $this->form_validation->set_rules('ket', 'ket', 'trim|required');

    $this->form_validation->set_rules('id', 'id', 'trim');
    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
  }

}

/* End of file Progress_pekerjaan.php */
/* Location: ./application/controllers/Progress_pekerjaan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-05-27 13:30:56 */
/* http://harviacode.com */
