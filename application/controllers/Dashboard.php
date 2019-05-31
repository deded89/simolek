<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('Dashboard_model');
		$this->load->model('Pelaporan_model');
		$this->load->model('Laporan_model');		
		$this->load->model('Skpd_model');		
    }
	
	public function index()
	{	
		$data['pelaporan_data'] = array();
		$data['nama_lap'] = '';
		$data['action'] = site_url('dashboard/lihat_status_lap');
		$data['controller'] = 'Dashboard';
		$data['uri1'] = 'Status Pelaporan';
		$data['main_view'] = 'dashboard_view';
		$data['jml_belum_lapor'] = 0;					
		$data['jml_sudah_lapor'] = 0;					
		$data['jml_oke'] = 0;			
		$data['jml_pelapor'] = 0;					
		$data['id_lap'] = '';
		$data['filter'] = '(No Data)';
		$data['collapsed'] = 'collapsed-box';
		
        $this->load->view('template_view', $data);		
	}
	
	public function lihat_status_lap()
	{
		$id = $this->input->post('id_lap',TRUE);
		redirect(site_url('dashboard/lihat_status/'.$id));
	}
	
	public function lihat_status($id)
	{		
		$row = $this->Pelaporan_model->get_by_idLap($id);
		$laporan = $this->Laporan_model->get_nama_laporan($id);
		$jumlah = $this->Dashboard_model->get_jumlah_status($id);
		
		$data['nama_lap'] = $laporan->nama_lap;
		$data['laporan'] = $laporan;
        if ($row) {            
			$data['pelaporan_data'] = $row;	
			$data['action'] = site_url('dashboard/lihat_status_lap');
			$data['controller'] = 'Dashboard';
			$data['uri1'] = 'Status Pelaporan';
			$data['main_view'] = 'dashboard_view';			
			$data['jml_belum_lapor'] = $jumlah['jml_belum_lapor'];					
			$data['jml_sudah_lapor'] = $jumlah['jml_sudah_lapor'];					
			$data['jml_oke'] = $jumlah['jml_oke'];			
			$data['jml_pelapor'] = $jumlah['jml_pelapor'];					
			$data['id_lap'] = $id;
			$data['filter'] = '(All Data)';
			$data['collapsed'] = '';
						
			$this->load->view('template_view', $data);
		} else {
			$this->session->set_flashdata('error', 'Pelapor belum ditambahkan..');
			redirect(site_url('dashboard'));
		}
	}
	
	public function lihat_status_belum_lapor($id_lap)
	{		
		$row = $this->Dashboard_model->get_jumlah_status($id_lap)['data_belum_lapor'];
		$laporan = $this->Laporan_model->get_nama_laporan($id_lap);
		$jumlah = $this->Dashboard_model->get_jumlah_status($id_lap);
		
		$data['nama_lap'] = $laporan->nama_lap;
		$data['laporan'] = $laporan;
        if ($row) {            
			$data['pelaporan_data'] = $row;	
			$data['action'] = site_url('dashboard/lihat_status_lap');
			$data['controller'] = 'Dashboard';
			$data['uri1'] = 'Status Pelaporan';
			$data['main_view'] = 'dashboard_view';			
			$data['jml_belum_lapor'] = $jumlah['jml_belum_lapor'];					
			$data['jml_sudah_lapor'] = $jumlah['jml_sudah_lapor'];					
			$data['jml_oke'] = $jumlah['jml_oke'];			
			$data['jml_pelapor'] = $jumlah['jml_pelapor'];					
			$data['id_lap'] = $id_lap;
			$data['filter'] = '(Data Belum Lapor)';
			$data['collapsed'] = 'collapsed-box';
						
			$this->load->view('template_view', $data);
		} else {
			$this->session->set_flashdata('error', 'Data Tidak Ditemukan.. Menampilkan Semua Data');
			redirect(site_url('dashboard/lihat_status/'.$id_lap));
		}
	}
	
	public function lihat_status_sudah_lapor($id_lap)
	{		
		$row = $this->Dashboard_model->get_jumlah_status($id_lap)['data_sudah_lapor'];
		$laporan = $this->Laporan_model->get_nama_laporan($id_lap);
		$jumlah = $this->Dashboard_model->get_jumlah_status($id_lap);
		
		$data['nama_lap'] = $laporan->nama_lap;
		$data['laporan'] = $laporan;
        if ($row) {            
			$data['pelaporan_data'] = $row;	
			$data['action'] = site_url('dashboard/lihat_status_lap');
			$data['controller'] = 'Dashboard';
			$data['uri1'] = 'Status Pelaporan';
			$data['main_view'] = 'dashboard_view';			
			$data['jml_belum_lapor'] = $jumlah['jml_belum_lapor'];					
			$data['jml_sudah_lapor'] = $jumlah['jml_sudah_lapor'];					
			$data['jml_oke'] = $jumlah['jml_oke'];			
			$data['jml_pelapor'] = $jumlah['jml_pelapor'];					
			$data['id_lap'] = $id_lap;
			$data['filter'] = '(Data Sudah Lapor/ Diminta Perbaiki/ Direvisi)';
			$data['collapsed'] = 'collapsed-box';
						
			$this->load->view('template_view', $data);
		} else {
			$this->session->set_flashdata('error', 'Data Tidak Ditemukan... Menampilkan Semua Data');
			redirect(site_url('dashboard/lihat_status/'.$id_lap));
		}
	}
	
	public function lihat_status_oke($id_lap)
	{		
		$row = $this->Dashboard_model->get_jumlah_status($id_lap)['data_oke'];
		$laporan = $this->Laporan_model->get_nama_laporan($id_lap);
		$jumlah = $this->Dashboard_model->get_jumlah_status($id_lap);
		
		$data['nama_lap'] = $laporan->nama_lap;
		$data['laporan'] = $laporan;
        if ($row) {            
			$data['pelaporan_data'] = $row;	
			$data['action'] = site_url('dashboard/lihat_status_lap');
			$data['controller'] = 'Dashboard';
			$data['uri1'] = 'Status Pelaporan';
			$data['main_view'] = 'dashboard_view';			
			$data['jml_belum_lapor'] = $jumlah['jml_belum_lapor'];					
			$data['jml_sudah_lapor'] = $jumlah['jml_sudah_lapor'];					
			$data['jml_oke'] = $jumlah['jml_oke'];			
			$data['jml_pelapor'] = $jumlah['jml_pelapor'];					
			$data['id_lap'] = $id_lap;
			$data['filter'] = '(Data Laporan Oke)';
			$data['collapsed'] = 'collapsed-box';
						
			$this->load->view('template_view', $data);
		} else {
			$this->session->set_flashdata('error', 'Data Tidak Ditemukan... Menampilkan Semua Data');
			redirect(site_url('dashboard/lihat_status/'.$id_lap));
		}
	}
	
	public function lihat_status_by_koordinator($id_lap)
	{
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login', 'refresh');
		}
		$row = $this->Pelaporan_model->get_by_idLap($id_lap);
		$laporan = $this->Laporan_model->get_nama_laporan($id_lap);
		$jumlah = $this->Dashboard_model->get_jumlah_status($id_lap);
		$data['nama_lap'] = $laporan->nama_lap;
		$data['laporan'] = $laporan;
        if ($row) {            
			$data['pelaporan_data'] = $row;	
			$data['action'] = site_url('dashboard/lihat_status_lap');
			$data['controller'] = 'Dashboard';
			$data['uri1'] = 'Status Pelaporan';
			$data['main_view'] = 'dashboard_view';	
			$data['jml_belum_lapor'] = $jumlah['jml_belum_lapor'];					
			$data['jml_sudah_lapor'] = $jumlah['jml_sudah_lapor'];					
			$data['jml_oke'] = $jumlah['jml_oke'];			
			$data['jml_pelapor'] = $jumlah['jml_pelapor'];					
			$data['id_lap'] = $id_lap;		
			$data['filter'] = '(All Data)';
			$data['collapsed'] = '';
			
			$this->load->view('template_view', $data);
		} else {
			$this->session->set_flashdata('error', 'Pelapor belum ditambahkan.');
			redirect(site_url('dashboard'));
		}
	}
	
	public function hal_download($id_pelaporan,$id_lap,$id_skpd)
	{
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login', 'refresh');
		}
		$skpd = $this->Skpd_model->get_by_id($id_skpd);
		$laporan = $this->Laporan_model->get_nama_laporan($id_lap);
		
		
		$data['nama_skpd'] = $skpd->nama_skpd;
		$data['id_lap'] = $id_lap;
		$data['id_skpd'] = $id_skpd;	
		$data['nama_lap'] = $this->Laporan_model->get_nama_laporan($id_lap)->nama_lap;
		$data['uploaded_files'] = $this->Pelaporan_model->get_all_nama_file($id_pelaporan); 
		$data['controller'] = 'Download';
		$data['uri1'] = 'Download File';
		$data['main_view'] = 'download_view';
		$data['id_pelaporan'] = $id_pelaporan; //untuk download all
		if($id_skpd == $this->session->userdata('id_skpd')||$laporan->id_skpd == $this->session->userdata('id_skpd')){
			if($laporan->id_skpd == $this->session->userdata('id_skpd')){
				$data_pelaporan['id_status'] = 7; 
				$this->Pelaporan_model->update($id_pelaporan, $data_pelaporan);
			}
			$this->load->view('template_view', $data);		
		}else{
			return show_error('Anda Tidak Memiliki Akses Download');
		}
	}
	
	public function terima_laporan($id_pelaporan,$id_lap)
	{
		$data['id_status'] = 4; //diterima
		$data['ket'] = ''; //kosongkan kolom keterangan	
		$this->Pelaporan_model->update($id_pelaporan,$data);		
		redirect('laporan/read/'.$id_lap);
	}
	
	public function minta_perbaikan($id_pelaporan,$id_lap)
	{
		$data['id_status'] = 3; //minta_perbaikan
		$this->Pelaporan_model->update($id_pelaporan,$data);
		redirect('laporan/read/'.$id_lap);
	}
}

