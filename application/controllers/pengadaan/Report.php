<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Report extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    if (!$this->ion_auth->logged_in())
    {
      redirect('auth/login', 'refresh');
    }else if (!$this->ion_auth->in_group('pengelola')) {
      return show_error('Anda tidak memiliki akses untuk melihat halaman ini, halaman hanya untuk Pengelola.');
    }
    $this->load->model('pengadaan/Report_model');
    $this->load->model('pengadaan/Pekerjaan_model');
  }

  function index()
  {
    $tanggal = date("Y-m-d");
    $pagu = 'all';
    $pekerjaan = $this->Report_model->tepra();
    $count = $this->Report_model->tepra_show_count($tanggal,$pagu);
    $data = array(
      'pekerjaan_data' => $pekerjaan,
      'count_data' => $count,
      'controller' => 'Report',
      'uri1' => 'TEPRA',
      'main_view' => 'pengadaan/report/tepra',
      'filter_tanggal' => $tanggal,
      'filter_pagu' => $pagu,
    );

    $this->load->view('template_view', $data);
  }

  function filter()
  {
    $tanggal = $this->input->post('filter_tanggal',true);
    $pagu = $this->input->post('pagu',true);
    $pekerjaan = $this->Report_model->tepra_filter($tanggal,$pagu);
    $count = $this->Report_model->tepra_show_count($tanggal,$pagu);
    $data = array(
      'pekerjaan_data' => $pekerjaan,
      'count_data' => $count,
      'controller' => 'Report',
      'uri1' => 'TEPRA',
      'main_view' => 'pengadaan/report/tepra',
      'filter_tanggal' => $tanggal,
      'filter_pagu' => $pagu,
      'pagu' => set_value('pagu'),
    );
    $this->load->view('template_view', $data);
  }

  function cetak($tanggal,$pagu){
    $pekerjaan_data = $this->Report_model->tepra_filter($tanggal,$pagu);
    $spreadsheet = new Spreadsheet();

    $sheet = $spreadsheet->getActiveSheet();

    //STYLE FOR TABLE HEADER
    $style_table_header = [
      'font' => [
          'bold' => true,
      ],
      'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
          'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
          'wrapText' => true,
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

    $sheet->getColumnDimension('E')->setAutoSize(true);

    $sheet->getColumnDimension('F')->setAutoSize(true);
    $sheet->getStyle('F')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    $sheet->getColumnDimension('G')->setAutoSize(false);
    $sheet->getColumnDimension('G')->setWidth(40);

    $sheet->getColumnDimension('H')->setAutoSize(true);

    $sheet->getColumnDimension('I')->setAutoSize(false);
    $sheet->getColumnDimension('I')->setWidth(15);

    $sheet->getColumnDimension('J')->setAutoSize(false);
    $sheet->getColumnDimension('J')->setWidth(10);

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
      $sheet->setCellValue('E'.$i, $pekerjaan->nama);
      $sheet->setCellValue('F'.$i, $pekerjaan->tgl_progress);
      $sheet->setCellValue('G'.$i, $pekerjaan->ket);
      $sheet->setCellValue('H'.$i, $pekerjaan->pagu);
      $sheet->setCellValue('I'.$i, $pekerjaan->real_keu);
      $sheet->setCellValue('J'.$i, $pekerjaan->real_fisik);

      //NUMBERING FORMAT
      $sheet->getStyle('H'.$i)->getNumberFormat()->setFormatCode(('#,##0'));
      $sheet->getStyle('I'.$i)->getNumberFormat()->setFormatCode(('#,##0'));

      //WRAPPING TEXT
      $sheet->getStyle('B'.$i)->getAlignment()->setWrapText(true);
      $sheet->getStyle('C'.$i)->getAlignment()->setWrapText(true);
      $sheet->getStyle('D'.$i)->getAlignment()->setWrapText(true);
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
		$sheet->setCellValue('E'.$hr, 'PROGRESS');
		$sheet->setCellValue('F'.$hr, 'TANGGAL');
		$sheet->setCellValue('G'.$hr, 'KETERANGAN');
		$sheet->setCellValue('H'.$hr, 'PAGU');
		$sheet->setCellValue('I'.$hr, 'REALISASI KEUANGAN');
		$sheet->setCellValue('J'.$hr, 'REALISASI FISIK');
    //memborder table header
    $sheet->getStyle('A'.$hr.':J'.$hr)->applyFromArray($style_table_header);

    //JUDUL LAPORAN
    $sheet->setCellValue('A1','LAPORAN KONDISI TERAKHIR PEKERJAAN');
    $sheet->getStyle('A1')->getFont()->setSize(16);
    $sheet->getStyle('A1')->getFont()->setBold(true);
    $sheet->mergeCells('A1:J1');

    $tanggal = date_create($tanggal)->format('d M Y');
    $sheet->setCellValue('A2','Kondisi s.d Tanggal '.$tanggal);
    $sheet->getStyle('A2')->getFont()->setSize(12);
    $sheet->mergeCells('A2:J2');

    if ($pagu == 'l200'){$pagu = 'Pagu bernilai > 200 Juta s.d 2,5 Milyar';}
    if ($pagu == 'l25'){$pagu = 'Pagu bernilai > 2,5 Milyar s.d 50 Milyar';}
    if ($pagu == 'l50'){$pagu = 'Pagu bernilai > 50 Milyar';}

    if ($pagu <> 'all'){
      $sheet->setCellValue('A3',$pagu);
      $sheet->getStyle('A3')->getFont()->setSize(12);
      $sheet->mergeCells('A3:H3');
    }

    //SETTING AUTO FILTER
    $sheet->setAutoFilter('A'.$hr.':J'.$i_akhir);

    //MEMBUAT COUNT PER PROGRESS ///////////////////////////////////////###############################################
    $htbl2 = $i + 2;
    $dtbl2 = $i + 3;

    //SETTING DATA TABEL 2
    $sheet->setCellValue('B'. ($dtbl2 + 0) ,'Persiapan');
    $sheet->setCellValue('B'. ($dtbl2 + 1) ,'Pemilihan Penyedia');
    $sheet->setCellValue('B'. ($dtbl2 + 2) ,'Hasil Pemilihan');
    $sheet->setCellValue('B'. ($dtbl2 + 3) ,'Kontrak');
    $sheet->setCellValue('B'. ($dtbl2 + 4) ,'Serah Terima (PHO)');
    $sheet->setCellValue('B'. ($dtbl2 + 5) ,'Serah Terima (FHO)');
    $sheet->setCellValue('B'. ($dtbl2 + 6) ,'Dibatalkan');

    $sheet->setCellValue('C'. ($dtbl2 + 0) ,'=COUNTIF(E'.$i_awal.':E'.$i_akhir.',"Persiapan")');
    $sheet->setCellValue('C'. ($dtbl2 + 1) ,'=COUNTIF(E'.$i_awal.':E'.$i_akhir.',"Pemilihan Penyedia")');
    $sheet->setCellValue('C'. ($dtbl2 + 2) ,'=COUNTIF(E'.$i_awal.':E'.$i_akhir.',"Hasil Pemilihan")');
    $sheet->setCellValue('C'. ($dtbl2 + 3) ,'=COUNTIF(E'.$i_awal.':E'.$i_akhir.',"Kontrak")');
    $sheet->setCellValue('C'. ($dtbl2 + 4) ,'=COUNTIF(E'.$i_awal.':E'.$i_akhir.',"Serah Terima (PHO)")');
    $sheet->setCellValue('C'. ($dtbl2 + 5) ,'=COUNTIF(E'.$i_awal.':E'.$i_akhir.',"Serah Terima (FHO)")');
    $sheet->setCellValue('C'. ($dtbl2 + 6) ,'=COUNTIF(E'.$i_awal.':E'.$i_akhir.',"Dibatalkan")');

    //BORDERING TABLE DATA
    $sheet->getStyle('B'.($dtbl2 + 0).':C'.($dtbl2 + 6))->applyFromArray($style_table_data);
    //STYLING TABEL 2 DATA
    $sheet->getStyle('C'.($dtbl2 + 0).':C'.($dtbl2 + 6))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    //SETTING HEADER TABEL 2
    $sheet->setCellValue('B'.$htbl2,'Progress');
    $sheet->setCellValue('C'.$htbl2,'Jumlah Pekerjaan');
    //memborder table header
    $sheet->getStyle('B'.$htbl2.':C'.$htbl2)->applyFromArray($style_table_header);



		$writer = new Xlsx($spreadsheet);

		$filename = 'Laporan Kondisi Progress Pekerjaan Update '.date('Y-m-d H:m:i');

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"');
		header('Cache-Control: max-age=0');
		$writer->save('php://output');
	}

}
