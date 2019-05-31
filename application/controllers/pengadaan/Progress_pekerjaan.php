<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Progress_pekerjaan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('pengadaan/Progress_pekerjaan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $progress_pekerjaan = $this->Progress_pekerjaan_model->get_all();

        $data = array(
            'progress_pekerjaan_data' => $progress_pekerjaan,
			'controller' => 'pengadaan/progress_pekerjaan',
			'uri1' => 'List Progress_pekerjaan',
			'main_view' => 'pengadaan/progress_pekerjaan/progress_pekerjaan_list'
        );

        $this->load->view('template_view', $data);
    }

    public function read($id)
    {
        $row = $this->Progress_pekerjaan_model->get_by_id($id);
        if ($row) {
            $data = array(
			'controller' => 'pengadaan/progress_pekerjaan',
			'uri1' => 'Data Progress_pekerjaan',
			'main_view' => 'pengadaan/progress_pekerjaan/progress_pekerjaan_read',

			'id' => $row->id,
			'pekerjaan' => $row->pekerjaan,
			'progress' => $row->progress,
			'tgl_progress' => $row->tgl_progress,
			'next_progress' => $row->next_progress,
			'tgl_n_progress' => $row->tgl_n_progress,
			'ket' => $row->ket,
	    );
            $this->load->view('template_view', $data);
        } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
            redirect(site_url('pengadaan/progress_pekerjaan'));
        }
    }

    public function create()
    {
      $data = array(
        'button' => 'Simpan',
        'action' => site_url('pengadaan/progress_pekerjaan/create_action'),
        'controller' => 'pengadaan/progress_pekerjaan',
        'uri1' => 'Tambah Progress_pekerjaan',
        'main_view' => 'pengadaan/progress_pekerjaan/progress_pekerjaan_form',

        'id' => set_value('id'),
        'pekerjaan' => set_value('pekerjaan'),
        'progress' => set_value('progress'),
        'tgl_progress' => set_value('tgl_progress'),
        'next_progress' => set_value('next_progress'),
        'tgl_n_progress' => set_value('tgl_n_progress'),
        'ket' => set_value('ket'),
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
          'pekerjaan' => $this->input->post('pekerjaan',TRUE),
          'progress' => $this->input->post('progress',TRUE),
          'tgl_progress' => $this->input->post('tgl_progress',TRUE),
          'next_progress' => $this->input->post('next_progress',TRUE),
          'tgl_n_progress' => $this->input->post('tgl_n_progress',TRUE),
          'ket' => $this->input->post('ket',TRUE),
        );

        $this->Progress_pekerjaan_model->insert($data);
        $this->session->set_flashdata('message', 'Data Berhasil Ditambahkan');
        redirect(site_url('pengadaan/progress_pekerjaan'));
      }
    }

    public function update($id)
    {
        $row = $this->Progress_pekerjaan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('pengadaan/progress_pekerjaan/update_action'),
				'controller' => 'pengadaan/progress_pekerjaan',
				'uri1' => 'Update Progress_pekerjaan',
				'main_view' => 'pengadaan/progress_pekerjaan/progress_pekerjaan_form',

			'id' => set_value('id', $row->id),
			'pekerjaan' => set_value('pekerjaan', $row->pekerjaan),
			'progress' => set_value('progress', $row->progress),
			'tgl_progress' => set_value('tgl_progress', $row->tgl_progress),
			'next_progress' => set_value('next_progress', $row->next_progress),
			'tgl_n_progress' => set_value('tgl_n_progress', $row->tgl_n_progress),
			'ket' => set_value('ket', $row->ket),
	    );
            $this->load->view('template_view', $data);
        } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
            redirect(site_url('pengadaan/progress_pekerjaan'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'pekerjaan' => $this->input->post('pekerjaan',TRUE),
		'progress' => $this->input->post('progress',TRUE),
		'tgl_progress' => $this->input->post('tgl_progress',TRUE),
		'next_progress' => $this->input->post('next_progress',TRUE),
		'tgl_n_progress' => $this->input->post('tgl_n_progress',TRUE),
		'ket' => $this->input->post('ket',TRUE),
	    );

            $this->Progress_pekerjaan_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Data Berhasil');
            redirect(site_url('pengadaan/progress_pekerjaan'));
        }
    }

    public function delete($id)
    {
        $row = $this->Progress_pekerjaan_model->get_by_id($id);

        if ($row) {
            $this->Progress_pekerjaan_model->delete($id);
            $this->session->set_flashdata('message', 'Data Berhasil Dihapus');
            redirect(site_url('pengadaan/progress_pekerjaan'));
        } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
            redirect(site_url('pengadaan/progress_pekerjaan'));
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
?>
