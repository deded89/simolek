<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
class Ren_real extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model(array('lkpk/Ren_real_model'));
  }

  function index(){
    $data = array(
      'controller' => 'LKPK',
      'uri1' => 'Laporan RFK',
      'main_view' => 'lkpk/kegiatan/lkpk_skpd',
      'action' => site_url('lkpk/Ren_real/laporan_rfk_skpd'),
      'periode' => set_value('periode'),
    );

    $data['skpd'] = set_value('skpd');
    $this->load->view('template_view', $data);
  }

  function rfk_pemko(){
    $data = array(
      'controller' => 'LKPK',
      'uri1' => 'Laporan RFK',
      'main_view' => 'lkpk/kegiatan/lkpk_pemko',
      'action' => site_url('lkpk/Ren_real/laporan_rfk_pemko'),
      'periode' => set_value('periode'),
    );
    $this->load->view('template_view', $data);
  }

  function laporan_rfk_skpd(){
    $skpd = $this->input->post('skpd',True);
    $bulan = $this->input->post('bulan_laporan',True);
    $periode = $this->input->post('periode',True);
    $ta = $this->input->post('tahun_anggaran',True);
    $bulan_column = array('b01','b02','b03','b04','b05','b06','b07','b08','b09','b01','b11','b12');
    $nama_bulan = array('Januari','Pebruari','Maret','April','Mei','Juni','Juni','Agustus','September','Oktober','Nopember','Desember');
    $rfk = $this->Ren_real_model->get_laporan_skpd($skpd,$periode,$ta,$bulan_column[$bulan]);
    $rfk_total = $this->Ren_real_model->get_total_laporan_skpd($skpd,$periode,$ta,$bulan_column[$bulan]);
    $data = array(
      'controller' => 'LKPK',
      'uri1' => 'Laporan RFK Belanja Langsung',
      'main_view' => 'lkpk/kegiatan/laporan_rfk_skpd',
      'bulan' => $bulan,
      'nama_bulan' => $nama_bulan[$bulan],
      'ta' => $ta,
      'nama_skpd' => $rfk_total['nama_skpd'],
      'rfk_data' => $rfk,
      'rfk_total_data' => $rfk_total,
      'skpd' => $skpd,
      'periode' => $periode,
    );
    $this->load->view('template_view', $data);
  }

  function cetak_laporan_rfk_skpd($skpd,$bulan,$periode,$ta){
    $bulan_column = array('b01','b02','b03','b04','b05','b06','b07','b08','b09','b01','b11','b12');
    $nama_bulan = array('Januari','Pebruari','Maret','April','Mei','Juni','Juni','Agustus','September','Oktober','Nopember','Desember');
    $rfk = $this->Ren_real_model->get_laporan_skpd($skpd,$periode,$ta,$bulan_column[$bulan]);
    $rfk_total = $this->Ren_real_model->get_total_laporan_skpd($skpd,$periode,$ta,$bulan_column[$bulan]);
    $nama_skpd = $rfk_total['nama_skpd'];

    $style_table_header = [
      'font' => [
        'bold' => true,
      ],
      'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP,
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
          'argb' => 'D7D3D3',
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
        'wrapText' => true,
      ],
    ];

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // write data
    $sheet->setCellValue('A1','LAPORAN REALISASI FISIK DAN KEUANGAN ');
    $sheet->mergeCells('A1:S1');
    $sheet->setCellValue('A2',$nama_skpd);
    $sheet->mergeCells('A2:S2');
    $sheet->setCellValue('A3','TAHUN ANGGARAN '.$ta);
    $sheet->mergeCells('A3:S3');
    $sheet->setCellValue('A4','KONDISI '.$nama_bulan[$bulan].' '.$ta);
    $sheet->mergeCells('A4:S4');
    $sheet->setCellValue('A8','NO');
    $sheet->mergeCells('A8:A10');
    $sheet->setCellValue('B8','URAIAN KEGIATAN');
    $sheet->mergeCells('B8:B10');
    $sheet->setCellValue('C8','NILAI ANGGARAN');
    $sheet->mergeCells('C8:D8');
    $sheet->setCellValue('C9','Rp');
    $sheet->mergeCells('C9:C10');
    $sheet->setCellValue('D9','%');
    $sheet->mergeCells('D9:D10');



    //output
    $filename = 'Laporan RFK SKPD';
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"');
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');

  }

  function laporan_rfk_pemko(){
    $bulan = $this->input->post('bulan_laporan',True);
    $periode = $this->input->post('periode',True);
    $ta = $this->input->post('tahun_anggaran',True);
    $bulan_column = array('b01','b02','b03','b04','b05','b06','b07','b08','b09','b01','b11','b12');
    $nama_bulan = array('Januari','Pebruari','Maret','April','Mei','Juni','Juni','Agustus','September','Oktober','Nopember','Desember');
    $rfk = $this->Ren_real_model->get_laporan_pemko($periode,$ta,$bulan_column[$bulan]);
    $rfk_total = $this->Ren_real_model->get_total_laporan_pemko($periode,$ta,$bulan_column[$bulan]);
    $data = array(
      'controller' => 'LKPK',
      'uri1' => 'Laporan RFK Belanja Langsung',
      'main_view' => 'lkpk/kegiatan/laporan_rfk_pemko',
      'bulan' => $bulan,
      'nama_bulan' => $nama_bulan[$bulan],
      'ta' => $ta,
      'rfk_data' => $rfk,
      'rfk_total_data' => $rfk_total,
    );
    $this->load->view('template_view', $data);
  }

  function perkegiatan($id_kegiatan,$periode_pagu){
    $ren_keu_data = $this->Ren_real_model->get_rencana_keu_by_periode_pagu($id_kegiatan,$periode_pagu);
    $real_keu_data = $this->Ren_real_model->get_realisasi_keu($id_kegiatan);

    $data = array(
      'controller' => 'Kegiatan',
      'uri1' => 'Rencana dan Realisasi',
      'main_view' => 'lkpk/kegiatan/detail_ren_real',
      'keg' => $id_kegiatan,
      'pp' => $periode_pagu,
    );
    $this->load->view('template_view', $data);
  }

}
