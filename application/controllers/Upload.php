<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
		$this->load->helper('directory');
		$this->load->library('upload');
		$this->load->model('Pelaporan_model');
		$this->load->model('Laporan_model');
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login', 'refresh');
		}
    }

    public function index()
    {		
        //index untuk upload
    }
	
	public function tampil_hal_upload($id_lap)
	{	
		//simpan data session
		$id_skpd = $this->session->userdata('id_skpd');
		//pastikan direktori upload ada, jika tidak buat
		if (!is_dir('uploads/laporan_'.$id_lap.'/skpd_'.$id_skpd))
		{
			mkdir('./uploads/laporan_'.$id_lap.'/skpd_'.$id_skpd, 0777, true);
		}
		
		//DAPATKAN ID_PELAPORAN BERDASARKAN ID LAPORAN DAN ID SKPD
		$pelaporan = $this->Pelaporan_model->get_id_pelaporan($id_lap,$id_skpd);
		$data['id_lap'] = $id_lap;
		$data['id_skpd'] = $id_skpd;		
		
		//dapatkan dan list file yang upload 
		//$data['uploaded_files'] = directory_map('./uploads/laporan_'.$id_lap.'/skpd_'.$id_skpd); 
		$data['uploaded_files'] = $this->Pelaporan_model->get_all_nama_file($pelaporan->id_pelaporan); 
		
		//ubah status ke belum lapor jika file tidak ada di tabel
		$this->cek_file_ada($id_lap,$id_skpd);
		
		if(isset($_FILES['multipleFiles'])){		
			if($this->input->post('submit') && count($_FILES['multipleFiles']['name']) > 0)
			{				
				//simpan jumlah file ke variabel
				$number_of_files = count($_FILES['multipleFiles']['name']);
				
				//simpan variabel global _FILES ke variabel lokal
				$files = $_FILES;
				$error = '';				
				//upload file satu-satu
				for ($i=0; $i < $number_of_files; $i++)
				{
					if ($files['multipleFiles']['error'][$i] <>4){
						$_FILES['multipleFiles']['name'] 		= $files['multipleFiles']['name'][$i];
						$_FILES['multipleFiles']['type'] 		= $files['multipleFiles']['type'][$i];
						$_FILES['multipleFiles']['tmp_name'] 	= $files['multipleFiles']['tmp_name'][$i];
						$_FILES['multipleFiles']['error'] 		= $files['multipleFiles']['error'][$i];
						$_FILES['multipleFiles']['size'] 		= $files['multipleFiles']['size'][$i];
						
												
						$config['upload_path'] = './uploads/laporan_'.$id_lap.'/skpd_'.$id_skpd;
						$config['allowed_types'] = 'pdf|doc|docx|zip|rar|xls|xlsx|jpg|jpeg|png|bmp';
						$config['max_size'] = '0';
						$config['max_width'] = '0';
						$config['max_height'] = '0';
						$config['overwrite'] = true;
						$config['remove_spaces'] = true;
						
						
						$this->upload->initialize($config);
						if (!$this->upload->do_upload('multipleFiles'))
						{
							//$error = array('error', $this->upload->display_errors());
							//$this->session->set_flashdata('error', $error['error']);	
							$this->session->set_flashdata( 'error', $this->upload->display_errors() );
							redirect('upload/tampil_hal_upload/'.$id_lap);
						}
						else{
							$upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
							$file_name = $upload_data['file_name'];
							
							$this->session->set_flashdata('message', 'File Berhasil Diupload');
							//CEK DI TABLE FILE UPLOAD APAKAH NAMA FILE YANG DIUPLOAD SAMA
							$file_sama = $this->Pelaporan_model->cek_nama_file($file_name,$pelaporan->id_pelaporan);					
							if(!$file_sama){ //JIKA NAMA FILE TIDAK SAMA
								//SIMPAN DATA FILE KE DATABASE 
								
								$data_file_laporan['nama_file']    = $file_name;
								$data_file_laporan['id_pelaporan'] = $pelaporan->id_pelaporan;
								$data_file_laporan['id_jab']       = $this->session->userdata('id_jab');
								$data_file_laporan['tgl_upload']   = Date('Y-m-d H:i:s');
								$this->Pelaporan_model->insert_file($data_file_laporan);			
							} else { //JIKA NAMA FILE SAMA UPDATE 
								$data_file_laporan['tgl_upload']   = Date('Y-m-d H:i:s');
								$this->Pelaporan_model->update_tgl_upload($file_sama->id_file,$data_file_laporan);
							}
						}
					}
				}
				if($error == '') //JIKA TIDAK ADA ERROR
				{	
					//UPDATE DATA PELAPORAN
					$data_pelaporan['id_jab'] = $this->session->userdata('id_jab'); //last uploader
					$data_pelaporan['tgl_upload'] = Date('Y-m-d H:i:s');
					
					//cek status pelaporan
					if ($pelaporan->id_status == 4)//jika status pelaporan sudah diterima 
					{
						$data_pelaporan['id_status'] = 5; //status jadi direvisi
					}
					else if($pelaporan->id_status == 3)//jika diminta perbaiki oleh koordinator
					{
						$data_pelaporan['id_status'] = 5; //status jadi direvisi
					}
					else if($pelaporan->id_status == 7)//jika diperiksa
					{
						$data_pelaporan['id_status'] = 5; //status jadi direvisi
					}
					else if($pelaporan->id_status == 1)
					{
						$data_pelaporan['id_status'] = 2; //status jadi sudah lapor													
					}
					$this->Pelaporan_model->update($pelaporan->id_pelaporan,$data_pelaporan);
					redirect('upload/tampil_hal_upload/'.$id_lap);
				} 
			}
		} else {
			$data['nama_lap'] = $this->Laporan_model->get_nama_laporan($id_lap)->nama_lap;			
			$data['controller'] = 'Upload';
			$data['uri1'] = 'Upload File';
			$data['main_view'] = 'upload_view';
			$data['action'] = 'upload/tampil_hal_upload/'.$id_lap;
			$this->load->view('template_view', $data);		
		}		
	}
	
	public function download($id_lap,$id_skpd,$nama_file)
	{
		$this->load->helper('download');
		force_download('uploads/laporan_'.$id_lap.'/skpd_'.$id_skpd.'/'.$nama_file,null);	
	}
	
	public function hapus($id_lap,$id_skpd,$nama_file,$id_file)
	{
		$pelaporan = $this->Pelaporan_model->get_id_pelaporan($id_lap,$id_skpd);
		if ($pelaporan->id_status <> 4){
		
			$this->Pelaporan_model->delete_file($id_file);
			unlink('uploads/laporan_'.$id_lap.'/skpd_'.$id_skpd.'/'.$nama_file);
			
			//cek apakah data file dihapus semua
			$pelaporan = $this->Pelaporan_model->get_id_pelaporan($id_lap,$id_skpd);
			$file = $this->Pelaporan_model->get_all_nama_file($pelaporan->id_pelaporan);
			//jika semua file dihapus
			if (!$file)
			{
				//if ($pelaporan->id_status == 2){ // jika status sudah lapor
					$data['id_status'] = 1; //status ubah jadi belum lapor				
				//} else {
				//	$data['id_status'] = 1; //status ubah jadi belum lapor
				//}
				//$data['ket'] = 'Tidak ada file diupload';
				$this->Pelaporan_model->update($pelaporan->id_pelaporan,$data);
			}
			
			redirect('upload/tampil_hal_upload/'.$id_lap);
		} else {
			$this->session->set_flashdata('error', 'Data Tidak bisa dihapus karena status pelaporan sudah diterima koordinator');
			redirect('upload/tampil_hal_upload/'.$id_lap);
		}
	}
	
	public function download_all($id_lap,$id_skpd)
	{		
		$laporan = $this->Laporan_model->get_by_id($id_lap);
		
		$this->load->library('zip');
		$this->load->helper('file');
		$path = './uploads/laporan_'.$id_lap.'/skpd_'.$id_skpd.'/';		
		$files = get_filenames($path);		
		
		foreach ($files as $file)
		{	
			$paths = $path.$file;
			$this->zip->add_data($file,file_get_contents($paths));
		}
		
		//++++++++++++++++++++
				$this->load->helper('text');
				$string = ellipsize($laporan->nama_lap, 50, 1,'_');
				$string = preg_replace(array('/\s/', '/\.[\.]+/', '/[^\w_\.\-]/'), array('_', '.', ''), $string);
				$string = str_replace(".", "", $string);
				$string = str_replace(",", "", $string);
				$name   = $string;
		//+++++++++++++++++++++
				
		$this->zip->download($name);
	}
	
	public function cek_file_ada($id_lap,$id_skpd)
	{
		$pelaporan = $this->Pelaporan_model->get_id_pelaporan($id_lap,$id_skpd);
		$file = $this->Pelaporan_model->get_all_nama_file($pelaporan->id_pelaporan);
		//jika tidak ada file
		if (!$file)
		{
			//if ($pelaporan->id_status == 2){ // jika status sudah lapor
				$data['id_status'] = 1; //status ubah jadi belum lapor				
				$data['ket'] = '';
			//} else {
				//$data['id_status'] = 3; //status ubah jadi belum lapor
			//}
			$this->Pelaporan_model->update($pelaporan->id_pelaporan,$data);
		}	
	}
}
?>