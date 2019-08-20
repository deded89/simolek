<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Pekerjaan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('pengadaan/Pekerjaan_model');
        $this->load->model('pengadaan/Kontrak_model');
        $this->load->model('pengadaan/Serah_terima_model');
        $this->load->model('pengadaan/Progress_pekerjaan_model');
        $this->load->model('pengadaan/Pic_model');
        $this->load->library('form_validation');
        if (!$this->ion_auth->logged_in())
        {
          redirect('auth/login', 'refresh');
        }else if ($this->ion_auth->in_group('user_biasa')) {
          return show_error('You must be an pptk to view this page.');
        }
    }

    public function index()
    {
      $pekerjaan = $this->Pekerjaan_model->get_all();
      $data = array(
        'pekerjaan_data' => $pekerjaan,
        'controller' => 'Pekerjaan',
        'uri1' => 'List Pekerjaan',
        'main_view' => 'pengadaan/pekerjaan/pekerjaan_list',
      );
      $data['hidden_attr'] = '';
      if (!$this->ion_auth->in_group('pengelola')){
        $data['hidden_attr'] = 'hidden';
      }
      $this->load->view('template_view', $data);
    }

    public function read($id)
    {
      // CEK AKSES
      $row = $this->Pekerjaan_model->get_by_id($id);
      if (!$row){
        $this->session->set_flashdata('error', 'Akses Dilarang (error 403 Prohibited)');
        redirect(site_url('pengadaan/pekerjaan'));
      } else {
        // SHOW INFO KELENGKAPAN DATA FOR PPTK
        $kontrak_data = $this->Kontrak_model->get_by_id_p($id);
        $st_data = $this->Serah_terima_model->get_by_id_p($id);
        $pic_data = $this->Pic_model->get_by_id_p($id);
        $pp_data = $this->Progress_pekerjaan_model->get_by_id_p($id);
        $total_kontrak = $this->Kontrak_model->get_last_kontrak($id);
        $now_real_keu = $this->Progress_pekerjaan_model->get_max_real_keu($id)->real_keu;
        $now_real_fisik = $this->Progress_pekerjaan_model->get_max_real_fisik($id)->real_fisik;
        $persen_real_keu = $this->Progress_pekerjaan_model->get_persen_real_keu($id);
        $proyeksi_data = $this->Pekerjaan_model->get_proyeksi($id)['proyeksi_today'];
        $hari_terlaksana = $this->Pekerjaan_model->get_proyeksi($id)['hari_terlaksana'];

        if ($row) {
          $data = array(
            'controller' => 'Pekerjaan',
            'uri1' => 'Data Pekerjaan',
            'main_view' => 'pengadaan/pekerjaan/pekerjaan_read',

            'id_p' => $row->id_p,
            'nama' => $row->nama,
            'kegiatan' => $row->kegiatan,
            'deskripsi' => $row->deskripsi,
            'skpd' => $row->nama_skpd,
            'jenis' => $row->jenis,
            'metode' => $row->metode,
            'pagu' => $row->pagu,
            'progress_now' => $row->pr_now,
            'id_rup' => $row->id_rup,
            'id_lpse' => $row->id_lpse,
            'link_rup' => $row->link_rup,
            'link_lpse' => $row->link_lpse,

            'kontrak_data'=>$kontrak_data,
            'st_data'=>$st_data,
            'pp_data'=>$pp_data,
            'pic_data'=>$pic_data,
            'nilai_kontrak'=>$total_kontrak,
            'now_real_keu'=>$now_real_keu,
            'now_real_fisik'=>$now_real_fisik,
            'persen_real_keu'=>$persen_real_keu,
            'proyeksi_data'=>$proyeksi_data,
            'hari_terlaksana'=>$hari_terlaksana,
          );
          $data['hidden_attr'] = '';
          if (!$this->ion_auth->in_group('pptk') AND !$this->ion_auth->in_group('pengelola')){
            $data['hidden_attr'] = 'hidden';
          }
          $data['pengelola_only'] = '';
          if (!$this->ion_auth->in_group('pengelola')){
            $data['pengelola_only'] = 'hidden';
          }
          $this->load->view('template_view', $data);
        } else {
          $this->session->set_flashdata('error', 'Data Tidak Ditemukan');
          redirect(site_url('pengadaan/pekerjaan'));
        }
      }
    }

    public function create()
    { if (!$this->ion_auth->in_group('pengelola')) {
      return show_error('You must be an pengelola to view this page.');
     }
      $data = array(
        'button' => 'Simpan',
        'action' => site_url('pengadaan/pekerjaan/create_action'),
        'controller' => 'Pekerjaan',
        'uri1' => 'Tambah Pekerjaan',
        'main_view' => 'pengadaan/pekerjaan/pekerjaan_form',

        'id_p' => set_value('id_p'),
        'nama' => set_value('nama'),
        'kegiatan' => set_value('kegiatan'),
        'skpd' => set_value('skpd'),
        'jenis' => set_value('jenis'),
        'metode' => set_value('metode'),
        'pagu' => set_value('pagu'),
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
        );

        $this->Pekerjaan_model->insert($data);
        $this->session->set_flashdata('message', 'Data Berhasil Ditambahkan');
        redirect(site_url('pengadaan/pekerjaan'));
      }
    }

    public function update($id)
    {
      if (!$this->ion_auth->in_group('pengelola')) {
        return show_error('You must be an pengelola to view this page.');
      }
      $row = $this->Pekerjaan_model->get_by_id($id);

      if ($row) {
        $data = array(
          'button' => 'Update',
          'action' => site_url('pengadaan/pekerjaan/update_action'),
          'controller' => 'Pekerjaan',
          'uri1' => 'Update Pekerjaan',
          'main_view' => 'pengadaan/pekerjaan/pekerjaan_form',

          'id_p' => set_value('id', $id),
          'nama' => set_value('nama', $row->nama),
          'kegiatan' => set_value('kegiatan', $row->kegiatan),
          'skpd' => set_value('skpd', $row->id_skpd),
          'jenis' => set_value('jenis', $row->id_j),
          'metode' => set_value('metode', $row->id_m),
          'pagu' => set_value('pagu', $row->pagu),
        );
        $this->load->view('template_view', $data);
      } else {
        $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
        redirect(site_url('pengadaan/pekerjaan'));
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
        );

        $this->Pekerjaan_model->update($this->input->post('id', TRUE), $data);
        $this->session->set_flashdata('message', 'Update Data Berhasil');
        redirect(site_url('pengadaan/pekerjaan'));
      }
    }

    public function update_id_pengadaan($id)
    {
      if (!$this->ion_auth->in_group('pengelola') AND !$this->ion_auth->in_group('pptk')) {
        return show_error('You must be an pengelola or pptk to view this page.');
      }
      $row = $this->Pekerjaan_model->get_by_id($id);

      if ($row) {
        $data = array(
          'button' => 'Update',
          'action' => site_url('pengadaan/pekerjaan/update_action_id_pengadaan'),
          'controller' => 'Pekerjaan',
          'uri1' => 'Update Deskripsi dan ID Pengadaan',
          'main_view' => 'pengadaan/pekerjaan/edit_id_rup_lpse_form',

          'id_p' => set_value('id', $id),
          'deskripsi' => set_value('deskripsi', $row->deskripsi),
          'id_rup' => set_value('id_rup', $row->id_rup),
          'id_lpse' => set_value('id_lpse', $row->id_lpse),
        );
        $this->load->view('template_view', $data);
      } else {
        $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
        redirect(site_url('pengadaan/pekerjaan/read/'.$id));
      }
    }

    public function update_action_id_pengadaan()
    {
      $this->_rules_id_pengadaan();

      if ($this->form_validation->run() == FALSE) {
        $this->update_id_pengadaan($this->input->post('id', TRUE));
      } else {
        $data = array(
          'deskripsi' => $this->input->post('deskripsi',TRUE),
          'id_rup' => $this->input->post('id_rup',TRUE),
          'id_lpse' => $this->input->post('id_lpse',TRUE),
        );

        $this->Pekerjaan_model->update_id_pengadaan($this->input->post('id', TRUE), $data);
        $this->session->set_flashdata('message', 'Update Data Berhasil');
        redirect(site_url('pengadaan/pekerjaan/read/'.$this->input->post('id',true)));
      }
    }


    public function delete($id)
    { if (!$this->ion_auth->in_group('pengelola')) {
      return show_error('You must be an pengelola to view this page.');
      }
        $row = $this->Pekerjaan_model->get_by_id($id);

        if ($row) {
            $this->Pekerjaan_model->delete($id);
            $this->session->set_flashdata('message', 'Data Berhasil Dihapus');
            redirect(site_url('pengadaan/pekerjaan'));
        } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
            redirect(site_url('pengadaan/pekerjaan'));
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

      $this->form_validation->set_rules('id', 'id', 'trim');
      $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function _rules_id_pengadaan()
    {
      $this->form_validation->set_rules('id_rup', 'ID RUP', 'trim|numeric');
      $this->form_validation->set_rules('id_lpse', 'ID LPSE', 'trim|numeric');

      $this->form_validation->set_rules('id', 'id', 'trim');
      $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function cetak(){
      $pekerjaan_data = $this->Pekerjaan_model->cetak();
      $spreadsheet = new Spreadsheet();

      $sheet = $spreadsheet->getActiveSheet();

      //STYLE FOR TABLE HEADER
      $style_table_header = [
        'font' => [
            'bold' => true,
        ],
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        ],
        'borders' => [
          'allBorders' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
        ],
        'fill' => [
          'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
          'startColor' => [
              'argb' => 'FFA0A0A0',
          ],
        ],
      ];

      // STYLING TABLE DATA
      $style_table_data = [
        'borders' => [
          'outline' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
          'vertical' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          ],
          'horizontal' => [
              'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOTTED,
          ],
        ],
        'alignment' => [
          'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP,
        ],
      ];

      //SETTING KOLOM
      $sheet->getColumnDimension('A')->setAutoSize(true);
      $sheet->getStyle('A')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

      $sheet->getColumnDimension('B')->setAutoSize(false);
      $sheet->getColumnDimension('B')->setWidth(40);

      $sheet->getColumnDimension('C')->setAutoSize(false);
      $sheet->getColumnDimension('C')->setWidth(30);

      $sheet->getColumnDimension('D')->setAutoSize(false);
      $sheet->getColumnDimension('D')->setWidth(20);

      $sheet->getColumnDimension('E')->setAutoSize(false);
      $sheet->getColumnDimension('E')->setWidth(20);

      $sheet->getColumnDimension('F')->setAutoSize(false);
      $sheet->getColumnDimension('F')->setWidth(20);

      $sheet->getColumnDimension('G')->setAutoSize(true);

      $sheet->getColumnDimension('H')->setAutoSize(true);
      $sheet->getColumnDimension('I')->setAutoSize(true);
      $sheet->getColumnDimension('J')->setAutoSize(true);

      // TABLE DATA
      $i=6;
      $i_awal = $i;
      $nomor=1;
      foreach($pekerjaan_data as $pekerjaan) {
        //WRITE DATA
        $sheet->setCellValue('A'.$i, $nomor);
        $sheet->setCellValue('B'.$i, $pekerjaan->nama_pekerjaan);
        $sheet->setCellValue('C'.$i, $pekerjaan->kegiatan);
        $sheet->setCellValue('D'.$i, $pekerjaan->nama_skpd);
        $sheet->setCellValue('E'.$i, $pekerjaan->jenis);
        $sheet->setCellValue('F'.$i, $pekerjaan->metode);
        $sheet->setCellValue('G'.$i, $pekerjaan->progress);
        $sheet->setCellValue('H'.$i, $pekerjaan->pagu);
        $sheet->setCellValue('I'.$i, $pekerjaan->nama_pic);
        $sheet->setCellValue('J'.$i, $pekerjaan->kontak);

        //NUMBERING FORMAT
        $sheet->getStyle('H'.$i)->getNumberFormat()->setFormatCode(('#,##0'));

        //WRAPPING TEXT
        $sheet->getStyle('B'.$i)->getAlignment()->setWrapText(true);
        $sheet->getStyle('C'.$i)->getAlignment()->setWrapText(true);
        $sheet->getStyle('D'.$i)->getAlignment()->setWrapText(true);
        $sheet->getStyle('E'.$i)->getAlignment()->setWrapText(true);
        $sheet->getStyle('F'.$i)->getAlignment()->setWrapText(true);
        $sheet->getStyle('G'.$i)->getAlignment()->setWrapText(true);

        $i++;
        $nomor++;
      }

      $i_akhir = $i-1;
      //BORDERING TABLE DATA
      $sheet->getStyle('A'.$i_awal.':J'.$i_akhir)->applyFromArray($style_table_data);

      // SETTING HEADER TABLE VALUE
      $hr = 5;
  		$sheet->setCellValue('A'.$hr, 'NO');
  		$sheet->setCellValue('B'.$hr, 'NAMA PEKERJAAN');
  		$sheet->setCellValue('C'.$hr, 'NAMA KEGIATAN');
  		$sheet->setCellValue('D'.$hr, 'SKPD PELAKSANA');
  		$sheet->setCellValue('E'.$hr, 'JENIS');
  		$sheet->setCellValue('F'.$hr, 'METODE');
  		$sheet->setCellValue('G'.$hr, 'PROGRESS');
  		$sheet->setCellValue('H'.$hr, 'PAGU');
  		$sheet->setCellValue('I'.$hr, 'NAMA PPTK');
  		$sheet->setCellValue('J'.$hr, 'KONTAK');
      //memborder table header
      $sheet->getStyle('A'.$hr.':J'.$hr)->applyFromArray($style_table_header);

      //JUDUL LAPORAN
      $sheet->setCellValue('A1','LAPORAN DAFTAR PEKERJAAN');
      $sheet->getStyle('A1')->getFont()->setSize(16);
      $sheet->getStyle('A1')->getFont()->setBold(true);
      $sheet->mergeCells('A1:J1');

      $tanggal = date('d M Y');
      $sheet->setCellValue('A2','Kondisi s.d Tanggal '.$tanggal);
      $sheet->getStyle('A2')->getFont()->setSize(12);
      $sheet->mergeCells('A2:J2');

      //SETTING AUTO FILTER
      $sheet->setAutoFilter('A'.$hr.':J'.$i_akhir);

      //MEMBUAT COUNT PER PROGRESS ///////////////////////////////////////###############################################
      $htbl2 = $i + 2;
      $dtbl2 = $i + 4;

      //SETTING DATA TABEL 2
      $sheet->setCellValue('B'. ($dtbl2 + 0) ,'Persiapan');
      $sheet->setCellValue('B'. ($dtbl2 + 1) ,'Pemilihan Penyedia');
      $sheet->setCellValue('B'. ($dtbl2 + 2) ,'Hasil Pemilihan');
      $sheet->setCellValue('B'. ($dtbl2 + 3) ,'Kontrak');
      $sheet->setCellValue('B'. ($dtbl2 + 4) ,'Serah Terima (PHO)');
      $sheet->setCellValue('B'. ($dtbl2 + 5) ,'Serah Terima Akhir (FHO)');
      $sheet->setCellValue('B'. ($dtbl2 + 6) ,'Selesai');
      $sheet->setCellValue('B'. ($dtbl2 + 7) ,'Dibatalkan');
      $sheet->setCellValue('B'. ($dtbl2 + 8) ,'Belum Ada Progress');

      $sheet->setCellValue('C'. ($dtbl2 + 0) ,"=COUNTIFS(G".$i_awal.":G".$i_akhir.",\"Persiapan\",H".$i_awal.":H".$i_akhir.",\">200000000\",H".$i_awal.":H".$i_akhir.",\"<=2500000000\")");
      $sheet->setCellValue("C". ($dtbl2 + 1) ,"=COUNTIFS(G".$i_awal.":G".$i_akhir.",\"Pemilihan Penyedia\",H".$i_awal.":H".$i_akhir.",\">200000000\",H".$i_awal.":H".$i_akhir.",\"<=2500000000\")");
      $sheet->setCellValue("C". ($dtbl2 + 2) ,"=COUNTIFS(G".$i_awal.":G".$i_akhir.",\"Hasil Pemilihan\",H".$i_awal.":H".$i_akhir.",\">200000000\",H".$i_awal.":H".$i_akhir.",\"<=2500000000\")");
      $sheet->setCellValue("C". ($dtbl2 + 3) ,"=COUNTIFS(G".$i_awal.":G".$i_akhir.",\"Kontrak\",H".$i_awal.":H".$i_akhir.",\">200000000\",H".$i_awal.":H".$i_akhir.",\"<=2500000000\")");
      $sheet->setCellValue("C". ($dtbl2 + 4) ,"=COUNTIFS(G".$i_awal.":G".$i_akhir.",\"Serah Terima (PHO)\",H".$i_awal.":H".$i_akhir.",\">200000000\",H".$i_awal.":H".$i_akhir.",\"<=2500000000\")");
      $sheet->setCellValue("C". ($dtbl2 + 5) ,"=COUNTIFS(G".$i_awal.":G".$i_akhir.",\"Serah Terima Akhir (FHO)\",H".$i_awal.":H".$i_akhir.",\">200000000\",H".$i_awal.":H".$i_akhir.",\"<=2500000000\")");
      $sheet->setCellValue("C". ($dtbl2 + 6) ,"=COUNTIFS(G".$i_awal.":G".$i_akhir.",\"Selesai\",H".$i_awal.":H".$i_akhir.",\">200000000\",H".$i_awal.":H".$i_akhir.",\"<=2500000000\")");
      $sheet->setCellValue("C". ($dtbl2 + 7) ,"=COUNTIFS(G".$i_awal.":G".$i_akhir.",\"Dibatalkan\",H".$i_awal.":H".$i_akhir.",\">200000000\",H".$i_awal.":H".$i_akhir.",\"<=2500000000\")");
      $sheet->setCellValue("C". ($dtbl2 + 8) ,"=COUNTIFS(G".$i_awal.":G".$i_akhir.",\"Belum Ada Progress\",H".$i_awal.":H".$i_akhir.",\">200000000\",H".$i_awal.":H".$i_akhir.",\"<=2500000000\")");

      $sheet->setCellValue("D". ($dtbl2 + 0) ,"=COUNTIFS(G".$i_awal.":G".$i_akhir.",\"Persiapan\",H".$i_awal.":H".$i_akhir.",\">2500000000\",H".$i_awal.":H".$i_akhir.",\"<=50000000000\")");
      $sheet->setCellValue("D". ($dtbl2 + 1) ,"=COUNTIFS(G".$i_awal.":G".$i_akhir.",\"Pemilihan Penyedia\",H".$i_awal.":H".$i_akhir.",\">2500000000\",H".$i_awal.":H".$i_akhir.",\"<=50000000000\")");
      $sheet->setCellValue("D". ($dtbl2 + 2) ,"=COUNTIFS(G".$i_awal.":G".$i_akhir.",\"Hasil Pemilihan\",H".$i_awal.":H".$i_akhir.",\">2500000000\",H".$i_awal.":H".$i_akhir.",\"<=50000000000\")");
      $sheet->setCellValue("D". ($dtbl2 + 3) ,"=COUNTIFS(G".$i_awal.":G".$i_akhir.",\"Kontrak\",H".$i_awal.":H".$i_akhir.",\">2500000000\",H".$i_awal.":H".$i_akhir.",\"<=50000000000\")");
      $sheet->setCellValue("D". ($dtbl2 + 4) ,"=COUNTIFS(G".$i_awal.":G".$i_akhir.",\"Serah Terima (PHO)\",H".$i_awal.":H".$i_akhir.",\">2500000000\",H".$i_awal.":H".$i_akhir.",\"<=50000000000\")");
      $sheet->setCellValue("D". ($dtbl2 + 5) ,"=COUNTIFS(G".$i_awal.":G".$i_akhir.",\"Serah Terima Akhir (FHO)\",H".$i_awal.":H".$i_akhir.",\">2500000000\",H".$i_awal.":H".$i_akhir.",\"<=50000000000\")");
      $sheet->setCellValue("D". ($dtbl2 + 6) ,"=COUNTIFS(G".$i_awal.":G".$i_akhir.",\"Selesai\",H".$i_awal.":H".$i_akhir.",\">2500000000\",H".$i_awal.":H".$i_akhir.",\"<=50000000000\")");
      $sheet->setCellValue("D". ($dtbl2 + 7) ,"=COUNTIFS(G".$i_awal.":G".$i_akhir.",\"Dibatalkan\",H".$i_awal.":H".$i_akhir.",\">2500000000\",H".$i_awal.":H".$i_akhir.",\"<=50000000000\")");
      $sheet->setCellValue("D". ($dtbl2 + 8) ,"=COUNTIFS(G".$i_awal.":G".$i_akhir.",\"Belum Ada Progress\",H".$i_awal.":H".$i_akhir.",\">2500000000\",H".$i_awal.":H".$i_akhir.",\"<=50000000000\")");

      $sheet->setCellValue("E". ($dtbl2 + 0) ,"=COUNTIFS(G".$i_awal.":G".$i_akhir.",\"Persiapan\",H".$i_awal.":H".$i_akhir.",\">50000000000\")");
      $sheet->setCellValue("E". ($dtbl2 + 1) ,"=COUNTIFS(G".$i_awal.":G".$i_akhir.",\"Pemilihan Penyedia\",H".$i_awal.":H".$i_akhir.",\">50000000000\")");
      $sheet->setCellValue("E". ($dtbl2 + 2) ,"=COUNTIFS(G".$i_awal.":G".$i_akhir.",\"Hasil Pemilihan\",H".$i_awal.":H".$i_akhir.",\">50000000000\")");
      $sheet->setCellValue("E". ($dtbl2 + 3) ,"=COUNTIFS(G".$i_awal.":G".$i_akhir.",\"Kontrak\",H".$i_awal.":H".$i_akhir.",\">50000000000\")");
      $sheet->setCellValue("E". ($dtbl2 + 4) ,"=COUNTIFS(G".$i_awal.":G".$i_akhir.",\"Serah Terima (PHO)\",H".$i_awal.":H".$i_akhir.",\">50000000000\")");
      $sheet->setCellValue("E". ($dtbl2 + 5) ,"=COUNTIFS(G".$i_awal.":G".$i_akhir.",\"Serah Terima Akhir (FHO)\",H".$i_awal.":H".$i_akhir.",\">50000000000\")");
      $sheet->setCellValue("E". ($dtbl2 + 6) ,"=COUNTIFS(G".$i_awal.":G".$i_akhir.",\"Selesai\",H".$i_awal.":H".$i_akhir.",\">50000000000\")");
      $sheet->setCellValue("E". ($dtbl2 + 7) ,"=COUNTIFS(G".$i_awal.":G".$i_akhir.",\"Dibatalkan\",H".$i_awal.":H".$i_akhir.",\">50000000000\")");
      $sheet->setCellValue("E". ($dtbl2 + 8) ,"=COUNTIFS(G".$i_awal.":G".$i_akhir.",\"Belum Ada Progress\",H".$i_awal.":H".$i_akhir.",\">50000000000\")");

      //create comment
      $sheet->getComment('C'.$htbl2)->setAuthor('Dedy Setiawan');
      $commentRichText = $sheet->getComment('C'.$htbl2)->getText()->createTextRun('Simolek:');
      $commentRichText->getFont()->setBold(true);
      $sheet->getComment('C'.$htbl2)->getText()->createTextRun("\r\n");
      $sheet->getComment('C'.$htbl2)->getText()->createTextRun('Tekan CTRL+ALT+F9 Jika Jumlah Pekerjaan Tidak Muncul');


      //BORDERING TABLE 2 DATA
      $sheet->getStyle('B'.($dtbl2 + 0).':E'.($dtbl2 + 8))->applyFromArray($style_table_data);
      //STYLING TABEL 2 DATA
      $sheet->getStyle('C'.($dtbl2 + 0).':E'.($dtbl2 + 8))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

      //SETTING HEADER TABEL 2
      $sheet->setCellValue('B'.$htbl2,'Progress');
      $sheet->setCellValue('C'.$htbl2,'Jumlah Pekerjaan');
      $sheet->setCellValue('C'.($htbl2+1),' > 200 JT s.d 2,5 Milyar');
      $sheet->setCellValue('D'.($htbl2+1),' > 2,5 M s.d 50 M');
      $sheet->setCellValue('E'.($htbl2+1),' > 50 Milyar');

      $sheet->mergeCells('B'.($htbl2+0).':B'.($htbl2+1));
      $sheet->mergeCells('C'.$htbl2.':E'.$htbl2);
      //memborder table header
      $sheet->getStyle('B'.$htbl2.':E'.($htbl2+1))->applyFromArray($style_table_header);

  		$filename = 'Laporan Daftar Pekerjaan '.date('Y-m-d H:m:i');
  		header('Content-Type: application/vnd.ms-excel');
  		header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"');
  		header('Cache-Control: max-age=0');

      $writer = new Xlsx($spreadsheet);
      $writer->save('php://output');
    }

    // public function cetak_detail(){
    //   $pekerjaan_data = $this->Pekerjaan_model->cetak();
    //   $spreadsheet = new Spreadsheet();
    //   $sheet = $spreadsheet->getActiveSheet();
    //
    //   //WRITING DATA
    //
    //
    //
    //   //STYLING
    //
    //
    //   $filename = 'Laporan Detail Pekerjaan '.date('Y-m-d H:m:i');
    //   header('Content-Type: application/vnd.ms-excel');
    //   header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"');
    //   header('Cache-Control: max-age=0');
    //
    //   $writer = new Xlsx($spreadsheet);
    //   $writer->save('php://output');
    // }
}

/* End of file Pekerjaan.php */
/* Location: ./application/controllers/Pekerjaan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-05-27 13:30:41 */
/* http://harviacode.com */
?>
