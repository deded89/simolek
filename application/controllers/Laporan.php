<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Laporan extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    if (!$this->ion_auth->logged_in())
    {
      redirect('auth/login', 'refresh');
    }
    $this->load->model('Laporan_model');
    $this->load->model('Pelaporan_model');
    $this->load->library('form_validation');
    $this->ubah_status_otomatis();
  }

  public function index()
  {
    $laporan = $this->Laporan_model->get_all();

    $data = array(
      'laporan_data' => $laporan,
      'controller'   => 'Laporan',
      'uri1'         => 'List Laporan',
      'main_view'    => 'laporan/laporan_list'
    );

    $this->load->view('template_view', $data);
  }

  public function under_me()
  {
    $laporan = $this->Laporan_model->get_all_under_me();

    $data = array(
      'laporan_data' => $laporan,
      'controller'   => 'Laporan',
      'uri1'         => 'List Koordinir Laporan',
      'main_view'    => 'laporan/laporan_koordinir'
    );

    $this->load->view('template_view', $data);
  }

  public function read($id)
  {
    $row = $this->Laporan_model->get_by_id($id);
    if ($row) {
      $data = array(
        'action'          => site_url('laporan/tambah_pelapor/'.$id),
        'action_2'        => site_url('laporan/tambah_by_klasifikasi/'.$id),
        'controller'      => 'Laporan',
        'uri1'            => 'Data Laporan',
        'main_view'       => 'laporan/laporan_read',
        'id_lap'          => $row->id_lap,
        'nama_lap'        => $row->nama_lap,
        'batas_waktu'     => $row->batas_waktu,
        'status'          => $row->status,

        //UNTUK PENAMBAHAN PELAPOR
        'id_skpd'         => set_value('id_skpd'),
      );
      //DAPATKAN DATA PELAPORAN
      $pelaporan = $this->Pelaporan_model->get_by_idLap($row->id_lap);
      $data['pelaporan_data'] = $pelaporan;
      $this->load->view('template_view', $data);
    } else {
      $this->session->set_flashdata('error', 'Data Tidak Ditemukan');
      redirect(site_url('laporan'));
    }
  }

  public function create()
  {
    if (!$this->ion_auth->in_group('pengelola')) {
      return show_error('User Anda tidak memiliki akses untuk melakukan aksi ini, hubungi pengelola di SKPD/ Organisasi Anda');
    } else {
      $data = array(
        'button'      => 'Simpan',
        'action'      => site_url('laporan/create_action'),
        'controller'  => 'Laporan',
        'uri1'        => 'Tambah Laporan',
        'main_view'   => 'laporan/laporan_form',
        'id_lap'      => set_value('id_lap'),
        'nama_lap'    => set_value('nama_lap'),
        'batas_waktu' => set_value('batas_waktu'),
        'batas_jam'   => set_value('batas_jam','00:00:00'),
        'status'      => set_value('status'),
        'id_jab'      => set_value('id_jab'),
      );
      $this->load->view('template_view', $data);
    }
  }

  public function create_action()
  {
    $this->_rules();

    if ($this->form_validation->run() == FALSE) {
      $this->create();
    } else {
      $batas_waktu_sqlFormat = $this->date_strtosql($this->input->post('batas_waktu',TRUE));

      $data = array(
        'nama_lap'    => $this->input->post('nama_lap',TRUE),
        'status'      => $this->input->post('status',TRUE),
        'id_skpd'     => $this->session->userdata('id_skpd'),
        'id_jab'      => $this->session->userdata('id_jab'),
        'status'      => 'open',
        'batas_waktu' => $batas_waktu_sqlFormat." ".$this->input->post('batas_jam',TRUE),
      );

      $this->Laporan_model->insert($data);
      $this->session->set_flashdata('message', 'Data Berhasil Ditambahkan');
      redirect(site_url('laporan'));
    }
  }

  public function update($id)
  {
    $row = $this->Laporan_model->get_by_id($id);

    if ($row) {
      $batas_waktu_strFormat = $this->date_sqltostr($row->batas_waktu)['date'];
      $batas_jam = $this->date_sqltostr($row->batas_waktu)['jam'];

      $data = array(
        'button'      => 'Update',
        'action'      => site_url('laporan/update_action'),
        'controller'  => 'Laporan',
        'uri1'        => 'Update Laporan',
        'main_view'   => 'laporan/laporan_form',

        'id_lap'      => set_value('id_lap', $row->id_lap),
        'nama_lap'    => set_value('nama_lap', $row->nama_lap),
        'status'      => set_value('status', $row->status),
        'id_jab'      => set_value('id_jab', $row->id_jab),
        'batas_waktu' => set_value('batas_waktu', $batas_waktu_strFormat),
        'batas_jam'   => set_value('batas_jam', $batas_jam),
      );
      $this->load->view('template_view', $data);
    } else {
      $this->session->set_flashdata('error', 'Data Tidak Ditemukan');
      redirect(site_url('laporan'));
    }

  }

  public function update_action()
  {
    $this->_rules();

    if ($this->form_validation->run() == FALSE) {
      $this->update($this->input->post('id_lap', TRUE));
    } else {
      $batas_waktu_sqlFormat = $this->date_strtosql($this->input->post('batas_waktu',TRUE));

      $data = array(
        'nama_lap' => $this->input->post('nama_lap',TRUE),
        'status' => $this->input->post('status',TRUE),
        'batas_waktu' => $batas_waktu_sqlFormat." ".$this->input->post('batas_jam',TRUE),
      );

      $this->Laporan_model->update($this->input->post('id_lap', TRUE), $data);
      $this->session->set_flashdata('message', 'Update Data Berhasil');
      redirect(site_url('laporan/under_me'));
    }
  }

  public function delete($id)
  {
    if (!$this->ion_auth->in_group('pengelola')) {
      return show_error('User Anda tidak memiliki akses untuk melakukan aksi ini, hubungi pengelola di SKPD/ Organisasi Anda');
    } else {
      $row = $this->Laporan_model->get_by_id($id);

      if ($row) {
        $this->Laporan_model->delete($id);
        $this->hapus_semua_file($id);
        $this->session->set_flashdata('message', 'Data Berhasil Dihapus');
        redirect(site_url('laporan'));
      } else {
        $this->session->set_flashdata('error', 'Data Tidak Ditemukan');
        redirect(site_url('laporan'));
      }
    }
  }

  public function hapus_semua_file($id_lap)
  {
    $path = FCPATH .'/uploads/laporan_'.$id_lap.'/';
    $this->load->helper('file');
    $handle = opendir($path);
    delete_files($path,true);
    closedir($handle);
    rmdir($path);
  }

  public function _rules()
  {
    $this->form_validation->set_rules('nama_lap', 'nama lap', 'trim|required');
    $this->form_validation->set_rules('batas_waktu', 'batas waktu', 'trim|required');
    //$this->form_validation->set_rules('status', 'status', 'trim|required');

    $this->form_validation->set_rules('id_lap', 'id_lap', 'trim');
    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
  }

  function pdf()
  {
    $data = array(
      'laporan_data' => $this->Laporan_model->get_all(),
      'start' => 0
    );

    ini_set('memory_limit', '32M');
    $this->load->library('pdfgenerator');
    $psize = 'folio'; //setting kertas
    $orient = 'landscape'; 	//setting orientasi

    $html = $this->load->view('laporan/laporan_pdf', $data, true);

    $this->pdfgenerator->generate($html,'list Laporan',$psize,$orient);

  }

  public function date_sqltostr($date){
    $exp = explode(' ',$date);
    $tanggal = $exp[0];
    $jam = $exp[1];

    $exp = explode('-',$tanggal);
    if(count($exp) == 3) {
      $date = $exp[2].'-'.$exp[1].'-'.$exp[0];
    }
    return array('date' => $date,
    'jam'	=> $jam,
  );
}

public function date_strtosql($date){
  $exp = explode('-',$date);
  if(count($exp) == 3) {
    $date = $exp[2].'/'.$exp[1].'/'.$exp[0];
  }
  return $date;
}

/* public function ubah_akses($id,$status)
{
$this->Laporan_model->update_akses($id,$status);
redirect('laporan/read/'.$id);
} */

public function ubah_status_otomatis()
{
  $this->Laporan_model->update_status_otomatis();
}

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

public function tambah_pelapor($id_lap)
{
  $this->form_validation->set_rules('id_skpd', 'SKPD/Pelapor', 'trim|required');

  if ($this->form_validation->run() == FALSE) {
    $this->read($id_lap);
  } else {
    $row = $this->Laporan_model->cek_pelapor_sama($this->input->post('id_skpd',TRUE),$id_lap);
    if ($row > 0)
    {
      $this->session->set_flashdata('error', 'Pelapor sudah ditambahkan sebelumnya');
      redirect('laporan/read/'.$id_lap);
    } else
    {
      $data = array(
        'id_lap'    => $this->input->post('id_lap',TRUE),
        'id_skpd'   => $this->input->post('id_skpd',TRUE),
        'id_status' => $this->input->post('id_status',TRUE),
      );

      $this->Pelaporan_model->insert($data);
      $this->session->set_flashdata('message', 'Data Berhasil Ditambahkan');
      redirect('laporan/read/'.$id_lap);
    }
  }
}

public function tambah_by_klasifikasi($id_lap)
{
  $this->form_validation->set_rules('id_klasifikasi', 'Klasifikasi', 'trim|required');

  if ($this->form_validation->run() == FALSE) {
    $this->read($id_lap);
  } else {
    //DAPATKAN NAMA SKPD BERDASARKAN ID KLASIFIKASI
    $skpd     = $this->Laporan_model->get_skpd_by_klasifikasi($this->input->post('id_klasifikasi',TRUE))['data'];
    $num_skpd = $this->Laporan_model->get_skpd_by_klasifikasi($this->input->post('id_klasifikasi',TRUE))['num_rows'];

    $i= 0; //jumlah data gagal
    $x= 0; //jumlah data berhasil
    foreach ($skpd as $s){

      $row = $this->Laporan_model->cek_pelapor_sama($s->id_skpd,$id_lap);
      if ($row > 0)
      {
        $i++;
      } else
      {
        $x++;
        $data = array(
          'id_lap'    => $this->input->post('id_lap',TRUE),
          'id_skpd'   => $s->id_skpd,
          'id_status' => $this->input->post('id_status',TRUE),
        );
        $this->Pelaporan_model->insert($data);
      }
    }

    if($x == $num_skpd)
    {
      $this->session->set_flashdata('message', ' Semua Data Berhasil Ditambahkan');
    }
    if($i == $num_skpd)
    {
      $this->session->set_flashdata('error', ' Semua Data Sudah Pernah Ditambahkan Sebelumnya');
    }
    if($x <> $num_skpd && $i <> $num_skpd)
    {
      $this->session->set_flashdata('message', $x.' Data Berhasil Ditambahkan');
      $this->session->set_flashdata('error', $i.' Data Gagal Karena Sudah Pernah Ditambahkan Sebelumnya');
    }
    redirect('laporan/read/'.$id_lap);
  }
}

public function hapus_pelapor($id,$id_lap)
{
  $row = $this->Pelaporan_model->get_by_id($id);

  if ($row) {
    $this->hapus_file($row->id_skpd,$id_lap);
    $this->Pelaporan_model->delete($id);
    $this->session->set_flashdata('message', 'Data Berhasil Dihapus');
    redirect('laporan/read/'.$id_lap);
  } else {
    $this->session->set_flashdata('error', 'Data Tidak Ditemukan');
    redirect('laporan/read/'.$id_lap);
  }
}

public function hapus_file($id_skpd,$id_lap)
{
  $pelaporan = $this->Pelaporan_model->get_id_pelaporan($id_lap,$id_skpd);
  $this->Laporan_model->delete_data_file($pelaporan->id_pelaporan);

  $path = FCPATH .'/uploads/laporan_'.$id_lap.'/skpd_'.$id_skpd.'/';
  $this->load->helper('file');
  delete_files($path,true);
  rmdir($path);
}

public function cek_akses_upload($id_lap)
{


  //CEK APAKAH USER TERMASUK PELAPOR
  $row  = $this->Laporan_model->get_akses_upload($id_lap)['num_rows'];
  $data = $this->Laporan_model->get_akses_upload($id_lap)['data'];

  if($row > 0)
  {
    if($data->status <> 'open')
    {
      //STATUS AKSES LAPORAN CLOSED
      return show_error('Akses upload ditutup atau batas waktu upload sudah habis,,, tekan tombol kembali pada browser atau backspace di keyboard untuk ke halaman sebelumnya','','Akses Ditolak');
    } else
    {
      //STATUS AKSES LAPORAN == OPEN
      //CEK STATUS PELAPORAN SKPD
      $status_skpd = $this->Laporan_model->get_akses_upload($id_lap)['data']->id_status;
      if ($status_skpd == 4 ){
        return show_error('Laporan anda sebelumnya sudah diterima oleh koordinator, kontak Koordinator untuk memperbaiki laporan Anda','','Akses Ditolak');
      } else {

        //USER ADALAH PELAPOR, STATUS AKSES OPEN TAMPILKAN HALAMAN UNTUK UPLOAD
        redirect(site_url('upload/tampil_hal_upload/'.$id_lap));
      }
    }
  } else
  {
    //USER BUKAN PELAPOR
    return show_error('Anda Tidak Memiliki Akses untuk upload ke laporan ini,,, tekan tombol kembali pada browser atau backspace di keyboard untuk ke halaman sebelumnya','','Akses Ditolak');
  }
}
}

/* End of file Laporan.php */
/* Location: ./application/controllers/Laporan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-08-14 21:16:08 */
/* http://harviacode.com */
?>
