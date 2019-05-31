<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Skpd extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Skpd_model');
        $this->load->library('form_validation');
		if (!$this->ion_auth->logged_in())
		{ 
			redirect('auth/login', 'refresh');
		}else if (!$this->ion_auth->is_admin()) {
			return show_error('You must be an administrator to view this page.');
		}
    }

    public function index()
    {
        $skpd = $this->Skpd_model->get_all();

        $data = array(
            'skpd_data' => $skpd,
			'controller' => 'Skpd',
			'uri1' => 'List Skpd',
			'main_view' => 'skpd/skpd_list'
        );

        $this->load->view('template_view', $data);
    }

    public function read($id) 
    {
        $row = $this->Skpd_model->get_by_id($id);
        if ($row) {
            $data = array(
			'controller' => 'Skpd',
			'uri1' => 'List Skpd',
			'main_view' => 'skpd/skpd_read',
			
			'id_skpd' => $row->id_skpd,
			'nama_skpd' => $row->nama_skpd,
			'nama_klasifikasi' => $row->nama_klasifikasi,
	    );
            $this->load->view('template_view', $data);
        } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
            redirect(site_url('skpd'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Simpan',
            'action' => site_url('skpd/create_action'),
			'controller' => 'Skpd',
			'uri1' => 'List Skpd',
			'main_view' => 'skpd/skpd_form',
			
			'id_skpd' => set_value('id_skpd'),
			'nama_skpd' => set_value('nama_skpd'),
			'id_klasifikasi' => set_value('id_klasifikasi'),
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
		'nama_skpd' => $this->input->post('nama_skpd',TRUE),
		'id_klasifikasi' => $this->input->post('id_klasifikasi',TRUE),
	    );

            $this->Skpd_model->insert($data);
            $this->session->set_flashdata('message', 'Data Berhasil Ditambahkan');
            redirect(site_url('skpd'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Skpd_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('skpd/update_action'),
				'controller' => 'Skpd',
				'uri1' => 'List Skpd',
				'main_view' => 'skpd/skpd_form',
			
			'id_skpd' => set_value('id_skpd', $row->id_skpd),
			'nama_skpd' => set_value('nama_skpd', $row->nama_skpd),
			'id_klasifikasi' => set_value('id_klasifikasi', $row->id_klasifikasi),			
	    );
            $this->load->view('template_view', $data);
        } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
            redirect(site_url('skpd'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_skpd', TRUE));
        } else {
            $data = array(
		'nama_skpd' => $this->input->post('nama_skpd',TRUE),
		'id_klasifikasi' => $this->input->post('id_klasifikasi',TRUE),
	    );

            $this->Skpd_model->update($this->input->post('id_skpd', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Data Berhasil');
            redirect(site_url('skpd'));
        }
    }
    
    public function delete($id) 
    {
        if ($this->cek_fk($id) != TRUE)
		{
			$row = $this->Skpd_model->get_by_id($id);

			if ($row) {
				$this->Skpd_model->delete($id);
				$this->session->set_flashdata('message', 'Data Berhasil Dihapus');
				redirect(site_url('skpd'));
			} else {
				$this->session->set_flashdata('message', 'Data Tidak Ditemukan');
				redirect(site_url('skpd'));
			}
		} 
		else
		{
			$this->session->set_flashdata('error', 'Data tidak bisa dihapus karena memiliki koneksi ke data lain');
			redirect(site_url('skpd'));
		}
    }

	public function cek_fk($id)
	{
		$fk = $this->Skpd_model->get_fk_by_id($id);
		if ($fk > 0)
		{
			return TRUE;
		}
	}
	
    public function _rules() 
    {
	$this->form_validation->set_rules('nama_skpd', 'nama skpd', 'trim|required');

	$this->form_validation->set_rules('id_skpd', 'id_skpd', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    function pdf()
    {
        $data = array(
            'skpd_data' => $this->Skpd_model->get_all(),
            'start' => 0
        );
        
        ini_set('memory_limit', '32M');
		$this->load->library('pdfgenerator');
		$psize = 'folio'; //setting kertas
		$orient = 'landscape'; 	//setting orientasi		
 
	    $html = $this->load->view('skpd/skpd_pdf', $data, true);
	    
	    $this->pdfgenerator->generate($html,'list Skpd',$psize,$orient); 
		       
    }

}

/* End of file Skpd.php */
/* Location: ./application/controllers/Skpd.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-07-05 05:46:16 */
/* http://harviacode.com */
?>
