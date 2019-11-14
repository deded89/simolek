<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kegiatan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('lkpk/Kegiatan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $kegiatan = $this->Kegiatan_model->get_all();

        $data = array(
            'kegiatan_data' => $kegiatan,
			    'controller' => 'Kegiatan',
			    'uri1' => 'List Kegiatan',
			    'main_view' => 'lkpk/kegiatan/kegiatan_list'
        );

        $this->load->view('template_view', $data);
    }

    public function read($id)
    {
        $row = $this->Kegiatan_model->get_by_id($id);
        if ($row) {
            $data = array(
			'controller' => 'Kegiatan',
			'uri1' => 'Data Kegiatan',
			'main_view' => 'lkpk/kegiatan/kegiatan_read',
			
			'id_kegiatan' => $row->id_kegiatan,
			'kode_kegiatan' => $row->kode_kegiatan,
			'nama_kegiatan' => $row->nama_kegiatan,
			'sumber_dana' => $row->sumber_dana,
			'tahun_anggaran' => $row->tahun_anggaran,
			'skpd' => $row->skpd,
	    );
            $this->load->view('template_view', $data);
        } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
            redirect(site_url('lkpk/kegiatan'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Simpan',
            'action' => site_url('lkpk/kegiatan/create_action'),
			'controller' => 'Kegiatan',
			'uri1' => 'Tambah Kegiatan',
			'main_view' => 'lkpk/kegiatan/kegiatan_form',
			
			'id_kegiatan' => set_value('id_kegiatan'),
			'kode_kegiatan' => set_value('kode_kegiatan'),
			'nama_kegiatan' => set_value('nama_kegiatan'),
			'sumber_dana' => set_value('sumber_dana'),
			'tahun_anggaran' => set_value('tahun_anggaran'),
			'skpd' => set_value('skpd'),
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
		'kode_kegiatan' => $this->input->post('kode_kegiatan',TRUE),
		'nama_kegiatan' => $this->input->post('nama_kegiatan',TRUE),
		'sumber_dana' => $this->input->post('sumber_dana',TRUE),
		'tahun_anggaran' => $this->input->post('tahun_anggaran',TRUE),
		'skpd' => $this->input->post('skpd',TRUE),
	    );

            $this->Kegiatan_model->insert($data);
            $this->session->set_flashdata('message', 'Data Berhasil Ditambahkan');
            redirect(site_url('lkpk/kegiatan'));
        }
    }

    public function update($id)
    {
        $row = $this->Kegiatan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('lkpk/kegiatan/update_action'),
				'controller' => 'Kegiatan',
				'uri1' => 'Update Kegiatan',
				'main_view' => 'lkpk/kegiatan/kegiatan_form',
			
			'id_kegiatan' => set_value('id_kegiatan', $row->id_kegiatan),
			'kode_kegiatan' => set_value('kode_kegiatan', $row->kode_kegiatan),
			'nama_kegiatan' => set_value('nama_kegiatan', $row->nama_kegiatan),
			'sumber_dana' => set_value('sumber_dana', $row->sumber_dana),
			'tahun_anggaran' => set_value('tahun_anggaran', $row->tahun_anggaran),
			'skpd' => set_value('skpd', $row->skpd),
	    );
            $this->load->view('template_view', $data);
        } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
            redirect(site_url('lkpk/kegiatan'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_kegiatan', TRUE));
        } else {
            $data = array(
		'kode_kegiatan' => $this->input->post('kode_kegiatan',TRUE),
		'nama_kegiatan' => $this->input->post('nama_kegiatan',TRUE),
		'sumber_dana' => $this->input->post('sumber_dana',TRUE),
		'tahun_anggaran' => $this->input->post('tahun_anggaran',TRUE),
		'skpd' => $this->input->post('skpd',TRUE),
	    );

            $this->Kegiatan_model->update($this->input->post('id_kegiatan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Data Berhasil');
            redirect(site_url('lkpk/kegiatan'));
        }
    }

    public function delete($id)
    {
        $row = $this->Kegiatan_model->get_by_id($id);

        if ($row) {
            $this->Kegiatan_model->delete($id);
            $this->session->set_flashdata('message', 'Data Berhasil Dihapus');
            redirect(site_url('lkpk/kegiatan'));
        } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
            redirect(site_url('lkpk/kegiatan'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('kode_kegiatan', 'kode kegiatan', 'trim|required');
	$this->form_validation->set_rules('nama_kegiatan', 'nama kegiatan', 'trim|required');
	$this->form_validation->set_rules('sumber_dana', 'sumber dana', 'trim|required');
	$this->form_validation->set_rules('tahun_anggaran', 'tahun anggaran', 'trim|required');
	$this->form_validation->set_rules('skpd', 'skpd', 'trim|required');

	$this->form_validation->set_rules('id_kegiatan', 'id_kegiatan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Kegiatan.php */
/* Location: ./application/controllers/Kegiatan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-09-02 14:39:30 */
/* http://harviacode.com */
?>
