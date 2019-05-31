<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Level_jabatan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Level_jabatan_model');
        $this->load->library('form_validation');
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login', 'refresh');
		} else if (!$this->ion_auth->is_admin()) {
			return show_error('You must be an administrator to view this page.');
		}
    }

    public function index()
    {
        $level_jabatan = $this->Level_jabatan_model->get_all();

        $data = array(
            'level_jabatan_data' => $level_jabatan,
			'controller' => 'Level_jabatan',
			'uri1' => 'List Level_jabatan',
			'main_view' => 'level_jabatan/level_jabatan_list'
        );

        $this->load->view('template_view', $data);
    }

    public function read($id) 
    {
        $row = $this->Level_jabatan_model->get_by_id($id);
        if ($row) {
            $data = array(
			'controller' => 'Level_jabatan',
			'uri1' => 'List Level_jabatan',
			'main_view' => 'level_jabatan/level_jabatan_read',
			
			'id_level' => $row->id_level,
			'level' => $row->level,
			'nama_level' => $row->nama_level,
	    );
            $this->load->view('template_view', $data);
        } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
            redirect(site_url('level_jabatan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Simpan',
            'action' => site_url('level_jabatan/create_action'),
			'controller' => 'Level_jabatan',
			'uri1' => 'List Level_jabatan',
			'main_view' => 'level_jabatan/level_jabatan_form',
			
			'id_level' => set_value('id_level'),
			'level' => set_value('level'),
			'nama_level' => set_value('nama_level'),
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
		'level' => $this->input->post('level',TRUE),
		'nama_level' => $this->input->post('nama_level',TRUE),
	    );

            $this->Level_jabatan_model->insert($data);
            $this->session->set_flashdata('message', 'Data Berhasil Ditambahkan');
            redirect(site_url('level_jabatan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Level_jabatan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('level_jabatan/update_action'),
				'controller' => 'Level_jabatan',
				'uri1' => 'List Level_jabatan',
				'main_view' => 'level_jabatan/level_jabatan_form',
			
			'id_level' => set_value('id_level', $row->id_level),
			'level' => set_value('level', $row->level),
			'nama_level' => set_value('nama_level', $row->nama_level),
	    );
            $this->load->view('template_view', $data);
        } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
            redirect(site_url('level_jabatan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_level', TRUE));
        } else {
            $data = array(
		'level' => $this->input->post('level',TRUE),
		'nama_level' => $this->input->post('nama_level',TRUE),
	    );

            $this->Level_jabatan_model->update($this->input->post('id_level', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Data Berhasil');
            redirect(site_url('level_jabatan'));
        }
    }
    
    public function delete($id) 
    {
        if ($this->cek_fk($id) != TRUE)
		{
			$row = $this->Level_jabatan_model->get_by_id($id);

			if ($row) {
				$this->Level_jabatan_model->delete($id);
				$this->session->set_flashdata('message', 'Data Berhasil Dihapus');
				redirect(site_url('level_jabatan'));
			} else {
				$this->session->set_flashdata('message', 'Data Tidak Ditemukan');
				redirect(site_url('level_jabatan'));
			}
		} 
		else
		{
			$this->session->set_flashdata('error', 'Data tidak bisa dihapus karena memiliki koneksi ke data lain');
			redirect(site_url('level_jabatan'));
		}		
    }

	public function cek_fk($id)
	{
		$fk = $this->Level_jabatan_model->get_fk_by_id($id);
		if ($fk > 0)
		{
			return TRUE;
		}
	}
	
    public function _rules() 
    {
	$this->form_validation->set_rules('level', 'level', 'trim|required');
	$this->form_validation->set_rules('nama_level', 'nama level', 'trim|required');

	$this->form_validation->set_rules('id_level', 'id_level', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    function pdf()
    {
        $data = array(
            'level_jabatan_data' => $this->Level_jabatan_model->get_all(),
            'start' => 0
        );
        
        ini_set('memory_limit', '32M');
		$this->load->library('pdfgenerator');
		$psize = 'folio'; //setting kertas
		$orient = 'landscape'; 	//setting orientasi		
 
	    $html = $this->load->view('level_jabatan/level_jabatan_pdf', $data, true);
	    
	    $this->pdfgenerator->generate($html,'list Level_jabatan',$psize,$orient); 
		       
    }

}

/* End of file Level_jabatan.php */
/* Location: ./application/controllers/Level_jabatan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-07-05 05:45:30 */
/* http://harviacode.com */
?>
