<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kontrak extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Kontrak_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $kontrak = $this->Kontrak_model->get_all();

        $data = array(
            'kontrak_data' => $kontrak,
			'controller' => 'Kontrak',
			'uri1' => 'List Kontrak',
			'main_view' => 'kontrak/kontrak_list'
        );

        $this->load->view('template_view', $data);
    }

    public function read($id) 
    {
        $row = $this->Kontrak_model->get_by_id($id);
        if ($row) {
            $data = array(
			'controller' => 'Kontrak',
			'uri1' => 'Data Kontrak',
			'main_view' => 'kontrak/kontrak_read',
			
			'id' => $row->id,
			'nomor' => $row->nomor,
			'tanggal' => $row->tanggal,
			'penyedia' => $row->penyedia,
			'lama' => $row->lama,
			'awal' => $row->awal,
			'akhir' => $row->akhir,
			'ket' => $row->ket,
	    );
            $this->load->view('template_view', $data);
        } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
            redirect(site_url('kontrak'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Simpan',
            'action' => site_url('kontrak/create_action'),
			'controller' => 'Kontrak',
			'uri1' => 'Tambah Kontrak',
			'main_view' => 'kontrak/kontrak_form',
			
			'id' => set_value('id'),
			'nomor' => set_value('nomor'),
			'tanggal' => set_value('tanggal'),
			'penyedia' => set_value('penyedia'),
			'lama' => set_value('lama'),
			'awal' => set_value('awal'),
			'akhir' => set_value('akhir'),
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
		'nomor' => $this->input->post('nomor',TRUE),
		'tanggal' => $this->input->post('tanggal',TRUE),
		'penyedia' => $this->input->post('penyedia',TRUE),
		'lama' => $this->input->post('lama',TRUE),
		'awal' => $this->input->post('awal',TRUE),
		'akhir' => $this->input->post('akhir',TRUE),
		'ket' => $this->input->post('ket',TRUE),
	    );

            $this->Kontrak_model->insert($data);
            $this->session->set_flashdata('message', 'Data Berhasil Ditambahkan');
            redirect(site_url('kontrak'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Kontrak_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('kontrak/update_action'),
				'controller' => 'Kontrak',
				'uri1' => 'Update Kontrak',
				'main_view' => 'kontrak/kontrak_form',
			
			'id' => set_value('id', $row->id),
			'nomor' => set_value('nomor', $row->nomor),
			'tanggal' => set_value('tanggal', $row->tanggal),
			'penyedia' => set_value('penyedia', $row->penyedia),
			'lama' => set_value('lama', $row->lama),
			'awal' => set_value('awal', $row->awal),
			'akhir' => set_value('akhir', $row->akhir),
			'ket' => set_value('ket', $row->ket),
	    );
            $this->load->view('template_view', $data);
        } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
            redirect(site_url('kontrak'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'nomor' => $this->input->post('nomor',TRUE),
		'tanggal' => $this->input->post('tanggal',TRUE),
		'penyedia' => $this->input->post('penyedia',TRUE),
		'lama' => $this->input->post('lama',TRUE),
		'awal' => $this->input->post('awal',TRUE),
		'akhir' => $this->input->post('akhir',TRUE),
		'ket' => $this->input->post('ket',TRUE),
	    );

            $this->Kontrak_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Data Berhasil');
            redirect(site_url('kontrak'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Kontrak_model->get_by_id($id);

        if ($row) {
            $this->Kontrak_model->delete($id);
            $this->session->set_flashdata('message', 'Data Berhasil Dihapus');
            redirect(site_url('kontrak'));
        } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
            redirect(site_url('kontrak'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nomor', 'nomor', 'trim|required');
	$this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');
	$this->form_validation->set_rules('penyedia', 'penyedia', 'trim|required');
	$this->form_validation->set_rules('lama', 'lama', 'trim|required');
	$this->form_validation->set_rules('awal', 'awal', 'trim|required');
	$this->form_validation->set_rules('akhir', 'akhir', 'trim|required');
	$this->form_validation->set_rules('ket', 'ket', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    function pdf()
    {
        $data = array(
            'kontrak_data' => $this->Kontrak_model->get_all(),
            'start' => 0
        );
        
        ini_set('memory_limit', '32M');
		$this->load->library('pdfgenerator');
		$psize = 'folio'; //setting kertas
		$orient = 'landscape'; 	//setting orientasi		
 
	    $html = $this->load->view('kontrak/kontrak_pdf', $data, true);
	    
	    $this->pdfgenerator->generate($html,'list Kontrak',$psize,$orient); 
		       
    }

}

/* End of file Kontrak.php */
/* Location: ./application/controllers/Kontrak.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-05-27 14:32:28 */
/* http://harviacode.com */
?>
