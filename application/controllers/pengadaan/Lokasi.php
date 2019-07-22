<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    class Lokasi extends CI_Controller
    {
      function __construct()
      {
        parent::__construct();
        $this->load->model('pengadaan/Lokasi_model');
        $this->load->model('pengadaan/Pekerjaan_model');
        $this->load->library('form_validation');
        if (!$this->ion_auth->logged_in())
        {
          redirect('auth/login', 'refresh');
        }else if ($this->ion_auth->in_group('user_biasa')) {
          return show_error('You not have access to view this page.');
        }
      }


      // index for admin only
      public function index($id_p)
      {
        $row = $this->Pekerjaan_model->get_by_id($id_p);
        if (!$row){
          $this->session->set_flashdata('error', 'Akses Dilarang (error 403 Prohibited)');
          redirect(site_url('pengadaan/pekerjaan'));
        } else {
          $lokasi = $this->Lokasi_model->get_by_id_p($id_p);
          $pekerjaan = $this->Pekerjaan_model->get_by_id($id_p);
          $data = array(
            'lokasi_data' => $lokasi,
            'controller' => 'lokasi',
            'uri1' => 'Lokasi '.$pekerjaan->nama,
            'pekerjaan_data' => $pekerjaan,
            'main_view' => 'pengadaan/lokasi/lokasi_list'
          );
          $data['hidden_attr'] = '';
          if (!$this->ion_auth->in_group('pptk') AND !$this->ion_auth->in_group('pengelola')){
            $data['hidden_attr'] = 'hidden';
          }
          $this->load->view('template_view', $data);
        }
      }

      // public function read($id)
      // {
      //   $row = $this->Kontrak_model->get_by_id($id);
      //   if ($row) {
      //     $data = array(
      //       'controller' => 'Kontrak',
      //       'uri1' => 'Data Kontrak',
      //       'main_view' => 'pengadaan/kontrak/kontrak_read',
      //
      //       'id' => $row->id,
      //       'nomor' => $row->nomor,
      //       'tanggal' => $row->tanggal,
      //       'penyedia' => $row->penyedia,
      //       'lama' => $row->lama,
      //       'awal' => $row->awal,
      //       'akhir' => $row->akhir,
      //       'ket' => $row->ket,
      //     );
      //     $this->load->view('template_view', $data);
      //   } else {
      //     $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
      //     redirect(site_url('kontrak'));
      //   }
      // }

      public function create($id_p){
        $row = $this->Pekerjaan_model->get_by_id($id_p);
        if (!$row){
          $this->session->set_flashdata('error', 'Akses Dilarang (error 403 Prohibited)');
          redirect(site_url('pengadaan/pekerjaan'));
        } else {
          if ($this->ion_auth->in_group('guest')) {
            return show_error('Guest Forbid to Access This Page.');
          }
          $data = array(
            'button' => 'Simpan',
            'action' => site_url('pengadaan/lokasi/create_action'),
            'controller' => 'Lokasi',
            'uri1' => 'Tambah Lokasi',
            'main_view' => 'pengadaan/lokasi/lokasi_form',

            'id_p' => set_value('id_p',$id_p),
            'id_l' => set_value('id_l'),
            'latitude' => set_value('latitude'),
            'longitude' => set_value('longitude'),
            'deskripsi' => set_value('deskripsi'),
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
            'pekerjaan' => $this->input->post('id_p',TRUE),
            'latitude' => $this->input->post('latitude',TRUE),
            'longitude' => $this->input->post('longitude',TRUE),
            'deskripsi' => $this->input->post('deskripsi',TRUE),
          );

          $this->Lokasi_model->insert($data);
          $this->session->set_flashdata('message', 'Data Berhasil Ditambahkan');
          redirect(site_url('pengadaan/lokasi/index/'.$this->input->post('id_p',TRUE)));
        }
      }

      // public function update($id_k,$id_p)
      // {
      //   $row = $this->Kontrak_model->get_by_id($id_k);
      //
      //   if ($row) {
      //     $data = array(
      //       'button' => 'Update',
      //       'action' => site_url('pengadaan/kontrak/update_action'),
      //       'controller' => 'Kontrak',
      //       'uri1' => 'Update Kontrak',
      //       'main_view' => 'pengadaan/kontrak/kontrak_form',
      //
      //       'id_k' => set_value('id_k', $row->id),
      //       'nomor' => set_value('nomor', $row->nomor),
      //       'tanggal' => set_value('tanggal', $row->tanggal),
      //       'penyedia' => set_value('penyedia', $row->penyedia),
      //       'lama' => set_value('lama', $row->lama),
      //       'awal' => set_value('awal', $row->awal),
      //       'akhir' => set_value('akhir', $row->akhir),
      //       'ket' => set_value('ket', $row->ket),
      //       'id_p' => set_value('id_p', $row->pekerjaan),
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
      //     $this->update($this->input->post('id_k', TRUE));
      //   } else {
      //     $data = array(
      //       'nomor' => $this->input->post('nomor',TRUE),
      //       'tanggal' => $this->input->post('tanggal',TRUE),
      //       'penyedia' => $this->input->post('penyedia',TRUE),
      //       'lama' => $this->input->post('lama',TRUE),
      //       'awal' => $this->input->post('awal',TRUE),
      //       'akhir' => $this->input->post('akhir',TRUE),
      //       'ket' => $this->input->post('ket',TRUE),
      //       'pekerjaan' => $this->input->post('id_p',TRUE),
      //     );
      //
      //     $this->Kontrak_model->update($this->input->post('id_k', TRUE), $data);
      //     $this->session->set_flashdata('message', 'Update Data Berhasil');
      //     redirect(site_url('pengadaan/pekerjaan/read/'.$this->input->post('id_p',TRUE)));
      //   }
      // }

      public function delete($id_l,$id_p)
      {
        $row = $this->Pekerjaan_model->get_by_id($id_p);
        if (!$row){
          $this->session->set_flashdata('error', 'Akses Dilarang (error 403 Prohibited)');
          redirect(site_url('pengadaan/pekerjaan'));
        } else {
          if ($this->ion_auth->in_group('guest')) {
             return show_error('Guest Forbid to Access This Page.');
          }
          $row = $this->Lokasi_model->get_by_id($id_l);

          if ($row) {
            $this->Lokasi_model->delete($id_l);
            $this->session->set_flashdata('message', 'Data Berhasil Dihapus');
            redirect(site_url('pengadaan/lokasi/index/'.$row->pekerjaan));
          } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
            redirect(site_url('pengadaan/lokasi/index/'.$row->pekerjaan));
          }
        }
      }

      public function _rules()
      {
        $this->form_validation->set_rules('deskripsi', 'deskripsi', 'trim|required');

        $this->form_validation->set_rules('id_l', 'id_l', 'trim');
        $this->form_validation->set_rules('id_p', 'id_p', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
      }

      // function pdf()
      // {
      //   $data = array(
      //     'kontrak_data' => $this->Kontrak_model->get_all(),
      //     'start' => 0
      //   );
      //
      //   ini_set('memory_limit', '32M');
      //   $this->load->library('pdfgenerator');
      //   $psize = 'folio'; //setting kertas
      //   $orient = 'landscape'; 	//setting orientasi
      //
      //   $html = $this->load->view('pengadaan/kontrak/kontrak_pdf', $data, true);
      //
      //   $this->pdfgenerator->generate($html,'list Kontrak',$psize,$orient);
      //
      // }

    }

/* End of file Kontrak.php */
/* Location: ./application/controllers/Kontrak.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-05-27 14:32:28 */
/* http://harviacode.com */
?>
