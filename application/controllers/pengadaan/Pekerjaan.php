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
        if (!$this->ion_auth->logged_in())
        {
          redirect('auth/login', 'refresh');
        }else if ($this->ion_auth->in_group('user_biasa')) {
          return show_error('You must be an pptk to view this page.');
        }
    }

    public function index()
    {
      $pekerjaan = $this->Pekerjaan_model->get_all();
      $data = array(
        'pekerjaan_data' => $pekerjaan,
        'controller' => 'Pekerjaan',
        'uri1' => 'List Pekerjaan',
        'main_view' => 'pengadaan/pekerjaan/pekerjaan_list',
      );
      $data['hidden_attr'] = '';
      if (!$this->ion_auth->in_group('pengelola')){
        $data['hidden_attr'] = 'hidden';
      }
      $this->load->view('template_view', $data);
    }

    public function read($id)
    {
      // CEK AKSES
      $row = $this->Pekerjaan_model->get_by_id($id);
      if (!$row){
        $this->session->set_flashdata('error', 'Akses Dilarang (error 403 Prohibited)');
        redirect(site_url('pengadaan/pekerjaan'));
      } else {
        // SHOW INFO KELENGKAPAN DATA FOR PPTK
        $kontrak_data = $this->Kontrak_model->get_by_id_p($id);
        $st_data = $this->Serah_terima_model->get_by_id_p($id);
        $pp_data = $this->Progress_pekerjaan_model->get_by_id_p($id);
        $total_kontrak = $this->Kontrak_model->sum_nilai_kontrak($id);
        $now_real_keu = $this->Progress_pekerjaan_model->get_max_real_keu($id)->real_keu;
        $now_real_fisik = $this->Progress_pekerjaan_model->get_max_real_fisik($id)->real_fisik;
        $persen_real_keu = $this->Progress_pekerjaan_model->get_persen_real_keu($id);

        if ($row) {
          $data = array(
            'controller' => 'Pekerjaan',
            'uri1' => 'Data Pekerjaan',
            'main_view' => 'pengadaan/pekerjaan/pekerjaan_read',

            'id_p' => $row->id_p,
            'nama' => $row->nama,
            'kegiatan' => $row->kegiatan,
            'deskripsi' => $row->deskripsi,
            'skpd' => $row->nama_skpd,
            'jenis' => $row->jenis,
            'metode' => $row->metode,
            'pagu' => $row->pagu,
            'progress_now' => $row->pr_now,
            'id_rup' => $row->id_rup,
            'id_lpse' => $row->id_lpse,
            'link_rup' => $row->link_rup,
            'link_lpse' => $row->link_lpse,

            'kontrak_data'=>$kontrak_data,
            'st_data'=>$st_data,
            'pp_data'=>$pp_data,
            'nilai_kontrak'=>$total_kontrak,
            'now_real_keu'=>$now_real_keu,
            'now_real_fisik'=>$now_real_fisik,
            'persen_real_keu'=>$persen_real_keu,
          );
          $data['hidden_attr'] = '';
          if (!$this->ion_auth->in_group('pptk') AND !$this->ion_auth->in_group('pengelola')){
            $data['hidden_attr'] = 'hidden';
          }
          $data['pengelola_only'] = '';
          if (!$this->ion_auth->in_group('pengelola')){
            $data['pengelola_only'] = 'hidden';
          }
          $this->load->view('template_view', $data);
        } else {
          $this->session->set_flashdata('error', 'Data Tidak Ditemukan');
          redirect(site_url('pengadaan/pekerjaan'));
        }
      }
    }

    public function create()
    { if (!$this->ion_auth->in_group('pengelola')) {
      return show_error('You must be an pengelola to view this page.');
     }
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
      if (!$this->ion_auth->in_group('pengelola')) {
        return show_error('You must be an pengelola to view this page.');
      }
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

    public function update_id_pengadaan($id)
    {
      if (!$this->ion_auth->in_group('pengelola') AND !$this->ion_auth->in_group('pptk')) {
        return show_error('You must be an pengelola or pptk to view this page.');
      }
      $row = $this->Pekerjaan_model->get_by_id($id);

      if ($row) {
        $data = array(
          'button' => 'Update',
          'action' => site_url('pengadaan/pekerjaan/update_action_id_pengadaan'),
          'controller' => 'Pekerjaan',
          'uri1' => 'Update ID Pengadaan',
          'main_view' => 'pengadaan/pekerjaan/edit_id_rup_lpse_form',

          'id_p' => set_value('id', $id),
          'deskripsi' => set_value('deskripsi', $row->deskripsi),
          'id_rup' => set_value('id_rup', $row->id_rup),
          'id_lpse' => set_value('id_lpse', $row->id_lpse),
        );
        $this->load->view('template_view', $data);
      } else {
        $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
        redirect(site_url('pengadaan/pekerjaan/read/'.$id));
      }
    }

    public function update_action_id_pengadaan()
    {
      $this->_rules_id_pengadaan();

      if ($this->form_validation->run() == FALSE) {
        $this->update_id_pengadaan($this->input->post('id', TRUE));
      } else {
        $data = array(
          'deskripsi' => $this->input->post('deskripsi',TRUE),
          'id_rup' => $this->input->post('id_rup',TRUE),
          'id_lpse' => $this->input->post('id_lpse',TRUE),
        );

        $this->Pekerjaan_model->update_id_pengadaan($this->input->post('id', TRUE), $data);
        $this->session->set_flashdata('message', 'Update Data Berhasil');
        redirect(site_url('pengadaan/pekerjaan/read/'.$this->input->post('id',true)));
      }
    }


    public function delete($id)
    { if (!$this->ion_auth->in_group('pengelola')) {
      return show_error('You must be an pengelola to view this page.');
      }
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

    public function _rules_id_pengadaan()
    {
      $this->form_validation->set_rules('id_rup', 'ID RUP', 'trim|numeric');
      $this->form_validation->set_rules('id_lpse', 'ID LPSE', 'trim|numeric');

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
