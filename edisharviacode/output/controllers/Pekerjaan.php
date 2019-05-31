<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pekerjaan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Pekerjaan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $pekerjaan = $this->Pekerjaan_model->get_all();

        $data = array(
            'pekerjaan_data' => $pekerjaan,
			'controller' => 'Pekerjaan',
			'uri1' => 'List Pekerjaan',
			'main_view' => 'pekerjaan/pekerjaan_list'
        );

        $this->load->view('template_view', $data);
    }

    public function read($id) 
    {
        $row = $this->Pekerjaan_model->get_by_id($id);
        if ($row) {
            $data = array(
			'controller' => 'Pekerjaan',
			'uri1' => 'Data Pekerjaan',
			'main_view' => 'pekerjaan/pekerjaan_read',
			
			'id' => $row->id,
			'nama' => $row->nama,
			'kegiatan' => $row->kegiatan,
			'skpd' => $row->skpd,
			'jenis' => $row->jenis,
			'metode' => $row->metode,
			'pagu' => $row->pagu,
			'realisasi' => $row->realisasi,
			'kontrak' => $row->kontrak,
			'serah_terima' => $row->serah_terima,
	    );
            $this->load->view('template_view', $data);
        } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
            redirect(site_url('pekerjaan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Simpan',
            'action' => site_url('pekerjaan/create_action'),
			'controller' => 'Pekerjaan',
			'uri1' => 'Tambah Pekerjaan',
			'main_view' => 'pekerjaan/pekerjaan_form',
			
			'id' => set_value('id'),
			'nama' => set_value('nama'),
			'kegiatan' => set_value('kegiatan'),
			'skpd' => set_value('skpd'),
			'jenis' => set_value('jenis'),
			'metode' => set_value('metode'),
			'pagu' => set_value('pagu'),
			'realisasi' => set_value('realisasi'),
			'kontrak' => set_value('kontrak'),
			'serah_terima' => set_value('serah_terima'),
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
		'realisasi' => $this->input->post('realisasi',TRUE),
		'kontrak' => $this->input->post('kontrak',TRUE),
		'serah_terima' => $this->input->post('serah_terima',TRUE),
	    );

            $this->Pekerjaan_model->insert($data);
            $this->session->set_flashdata('message', 'Data Berhasil Ditambahkan');
            redirect(site_url('pekerjaan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Pekerjaan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('pekerjaan/update_action'),
				'controller' => 'Pekerjaan',
				'uri1' => 'Update Pekerjaan',
				'main_view' => 'pekerjaan/pekerjaan_form',
			
			'id' => set_value('id', $row->id),
			'nama' => set_value('nama', $row->nama),
			'kegiatan' => set_value('kegiatan', $row->kegiatan),
			'skpd' => set_value('skpd', $row->skpd),
			'jenis' => set_value('jenis', $row->jenis),
			'metode' => set_value('metode', $row->metode),
			'pagu' => set_value('pagu', $row->pagu),
			'realisasi' => set_value('realisasi', $row->realisasi),
			'kontrak' => set_value('kontrak', $row->kontrak),
			'serah_terima' => set_value('serah_terima', $row->serah_terima),
	    );
            $this->load->view('template_view', $data);
        } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
            redirect(site_url('pekerjaan'));
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
		'realisasi' => $this->input->post('realisasi',TRUE),
		'kontrak' => $this->input->post('kontrak',TRUE),
		'serah_terima' => $this->input->post('serah_terima',TRUE),
	    );

            $this->Pekerjaan_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Data Berhasil');
            redirect(site_url('pekerjaan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Pekerjaan_model->get_by_id($id);

        if ($row) {
            $this->Pekerjaan_model->delete($id);
            $this->session->set_flashdata('message', 'Data Berhasil Dihapus');
            redirect(site_url('pekerjaan'));
        } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
            redirect(site_url('pekerjaan'));
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
	$this->form_validation->set_rules('realisasi', 'realisasi', 'trim|required|numeric');
	$this->form_validation->set_rules('kontrak', 'kontrak', 'trim|required');
	$this->form_validation->set_rules('serah_terima', 'serah terima', 'trim|required');

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
