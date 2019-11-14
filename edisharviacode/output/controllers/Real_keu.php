<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Real_keu extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('lkpk/Real_keu_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $real_keu = $this->Real_keu_model->get_all();

        $data = array(
            'real_keu_data' => $real_keu,
			    'controller' => 'Real_keu',
			    'uri1' => 'List Real_keu',
			    'main_view' => 'lkpk/real_keu/real_keu_list'
        );

        $this->load->view('template_view', $data);
    }

    public function read($id)
    {
        $row = $this->Real_keu_model->get_by_id($id);
        if ($row) {
            $data = array(
			'controller' => 'Real_keu',
			'uri1' => 'Data Real_keu',
			'main_view' => 'lkpk/real_keu/real_keu_read',
			
			'id_real_keu' => $row->id_real_keu,
			'nilai' => $row->nilai,
			'periode' => $row->periode,
			'kegiatan' => $row->kegiatan,
	    );
            $this->load->view('template_view', $data);
        } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
            redirect(site_url('lkpk/real_keu'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Simpan',
            'action' => site_url('lkpk/real_keu/create_action'),
			'controller' => 'Real_keu',
			'uri1' => 'Tambah Real_keu',
			'main_view' => 'lkpk/real_keu/real_keu_form',
			
			'id_real_keu' => set_value('id_real_keu'),
			'nilai' => set_value('nilai'),
			'periode' => set_value('periode'),
			'kegiatan' => set_value('kegiatan'),
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
		'nilai' => $this->input->post('nilai',TRUE),
		'periode' => $this->input->post('periode',TRUE),
		'kegiatan' => $this->input->post('kegiatan',TRUE),
	    );

            $this->Real_keu_model->insert($data);
            $this->session->set_flashdata('message', 'Data Berhasil Ditambahkan');
            redirect(site_url('lkpk/real_keu'));
        }
    }

    public function update($id)
    {
        $row = $this->Real_keu_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('lkpk/real_keu/update_action'),
				'controller' => 'Real_keu',
				'uri1' => 'Update Real_keu',
				'main_view' => 'lkpk/real_keu/real_keu_form',
			
			'id_real_keu' => set_value('id_real_keu', $row->id_real_keu),
			'nilai' => set_value('nilai', $row->nilai),
			'periode' => set_value('periode', $row->periode),
			'kegiatan' => set_value('kegiatan', $row->kegiatan),
	    );
            $this->load->view('template_view', $data);
        } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
            redirect(site_url('lkpk/real_keu'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_real_keu', TRUE));
        } else {
            $data = array(
		'nilai' => $this->input->post('nilai',TRUE),
		'periode' => $this->input->post('periode',TRUE),
		'kegiatan' => $this->input->post('kegiatan',TRUE),
	    );

            $this->Real_keu_model->update($this->input->post('id_real_keu', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Data Berhasil');
            redirect(site_url('lkpk/real_keu'));
        }
    }

    public function delete($id)
    {
        $row = $this->Real_keu_model->get_by_id($id);

        if ($row) {
            $this->Real_keu_model->delete($id);
            $this->session->set_flashdata('message', 'Data Berhasil Dihapus');
            redirect(site_url('lkpk/real_keu'));
        } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
            redirect(site_url('lkpk/real_keu'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('nilai', 'nilai', 'trim|required|numeric');
	$this->form_validation->set_rules('periode', 'periode', 'trim|required');
	$this->form_validation->set_rules('kegiatan', 'kegiatan', 'trim|required');

	$this->form_validation->set_rules('id_real_keu', 'id_real_keu', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Real_keu.php */
/* Location: ./application/controllers/Real_keu.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-09-02 14:39:30 */
/* http://harviacode.com */
?>