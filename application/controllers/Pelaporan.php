<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pelaporan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Pelaporan_model');
        $this->load->library('form_validation');
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login', 'refresh');
		}else if (!$this->ion_auth->in_group('pengelola')) {
			return show_error('You must be an pengelola to view this page.');
		}
    }

    public function index()
    {
        /* $pelaporan = $this->Pelaporan_model->get_all();

        $data = array(
            'pelaporan_data' => $pelaporan,
			'controller' => 'Pelaporan',
			'uri1' => 'List Pelaporan',
			'main_view' => 'pelaporan/pelaporan_list'
        );

        $this->load->view('template_view', $data); */
			
		redirect(site_url('dashboard'));
    }

  /*   public function read($id) 
    {
        $row = $this->Pelaporan_model->get_by_id($id);
        if ($row) {
            $data = array(
			'controller' => 'Pelaporan',
			'uri1' => 'Data Pelaporan',
			'main_view' => 'pelaporan/pelaporan_read',
			
			'id_pelaporan' => $row->id_pelaporan,
			'id_lap' => $row->id_lap,
			'id_skpd' => $row->id_skpd,
			'id_status' => $row->id_status,
			'id_jab' => $row->id_jab,
			'tgl_upload' => $row->tgl_upload,
	    );
            $this->load->view('template_view', $data);
        } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
            redirect(site_url('pelaporan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Simpan',
            'action' => site_url('pelaporan/create_action'),
			'controller' => 'Pelaporan',
			'uri1' => 'Tambah Pelaporan',
			'main_view' => 'pelaporan/pelaporan_form',
			
			'id_pelaporan' => set_value('id_pelaporan'),
			'id_lap' => set_value('id_lap'),
			'id_skpd' => set_value('id_skpd'),
			'id_status' => set_value('id_status'),
			'id_jab' => set_value('id_jab'),
			'tgl_upload' => set_value('tgl_upload'),
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
				'id_lap' => $this->input->post('id_lap',TRUE),
				'id_skpd' => $this->input->post('id_skpd',TRUE),
				'id_status' => $this->input->post('id_status',TRUE),
				'id_jab' => $this->input->post('id_jab',TRUE),
				'tgl_upload' => $this->input->post('tgl_upload',TRUE),
			);

            $this->Pelaporan_model->insert($data);
            $this->session->set_flashdata('message', 'Data Berhasil Ditambahkan');
            redirect(site_url('pelaporan'));
        }
    } */
    
    public function update($id_pelaporan,$id_lap) 
    {
        $row = $this->Pelaporan_model->get_by_id($id_pelaporan);

        if ($row) {
            $data = array(
                'button' => 'Simpan',
                'action' => site_url('pelaporan/update_action/'.$id_pelaporan.'/'.$id_lap),
				'controller' => 'Pelaporan',
				'uri1' => 'Keterangan Permintaan Perbaikan',
				'main_view' => 'pelaporan/pelaporan_form',
			
				'id_pelaporan' => set_value('id_pelaporan', $row->id_pelaporan),
				/* 'id_lap' => set_value('id_lap', $row->id_lap),
				'id_skpd' => set_value('id_skpd', $row->id_skpd),
				'id_status' => set_value('id_status', $row->id_status),
				'id_jab' => set_value('id_jab', $row->id_jab),
				'tgl_upload' => set_value('tgl_upload', $row->tgl_upload), */
				'ket' => set_value('ket', $row->ket),
	    );
            $this->load->view('template_view', $data);
        } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
            redirect(site_url('dashboard'));
        }
    }
    
    public function update_action($id_pelaporan,$id_lap) 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_pelaporan', TRUE));
        } else {
            $data = array(
				/* 'id_lap' => $this->input->post('id_lap',TRUE),
				'id_skpd' => $this->input->post('id_skpd',TRUE),
				'id_status' => $this->input->post('id_status',TRUE),
				'id_jab' => $this->input->post('id_jab',TRUE),
				'tgl_upload' => $this->input->post('tgl_upload',TRUE), */
				'ket' => $this->input->post('ket',TRUE), 
			);

            $this->Pelaporan_model->update($this->input->post('id_pelaporan', TRUE), $data);
			$this->session->set_flashdata('message', 'Permintaan Perbaikan Berhasil');
			redirect(site_url('dashboard/minta_perbaikan/'.$id_pelaporan.'/'.$id_lap));   
        }
    }
    
  /*   public function delete($id) 
    {
        $row = $this->Pelaporan_model->get_by_id($id);

        if ($row) {
            $this->Pelaporan_model->delete($id);
            $this->session->set_flashdata('message', 'Data Berhasil Dihapus');
            redirect(site_url('pelaporan'));
        } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
            redirect(site_url('pelaporan'));
        }
    } */

    public function _rules() 
    {
	/* $this->form_validation->set_rules('id_lap', 'id lap', 'trim|required');
	$this->form_validation->set_rules('id_skpd', 'id skpd', 'trim|required');
	$this->form_validation->set_rules('id_status', 'id status', 'trim|required');
	$this->form_validation->set_rules('id_jab', 'id jab', 'trim|required');
	$this->form_validation->set_rules('tgl_upload', 'tgl upload', 'trim|required'); */
	$this->form_validation->set_rules('ket', 'keterangan', 'trim|required'); 

	$this->form_validation->set_rules('id_pelaporan', 'id_pelaporan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

  /*   function pdf()
    {
        $data = array(
            'pelaporan_data' => $this->Pelaporan_model->get_all(),
            'start' => 0
        );
        
        ini_set('memory_limit', '32M');
		$this->load->library('pdfgenerator');
		$psize = 'folio'; //setting kertas
		$orient = 'landscape'; 	//setting orientasi		
 
	    $html = $this->load->view('pelaporan/pelaporan_pdf', $data, true);
	    
	    $this->pdfgenerator->generate($html,'list Pelaporan',$psize,$orient); 
		       
    }
 */
}

/* End of file Pelaporan.php */
/* Location: ./application/controllers/Pelaporan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-08-15 09:44:22 */
/* http://harviacode.com */
?>
