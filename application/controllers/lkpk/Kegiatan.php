<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;


class Kegiatan extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('lkpk/Kegiatan_model');
    $this->load->model('lkpk/Nilai_pagu_model');
    $this->load->model('lkpk/Periode_pagu_model');
    $this->load->model('lkpk/Periode_setting_model');
    $this->load->model('Skpd_model');
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
    $kegiatan = $this->Kegiatan_model->get_all();

    $data = array(
      'kegiatan_data' => $kegiatan,
      'controller' => 'Kegiatan',
      'uri1' => 'List Kegiatan',
      'main_view' => 'lkpk/kegiatan/kegiatan_list'
    );

    $this->load->view('template_view', $data);
  }

  public function read($id)
  {
    $row = $this->Kegiatan_model->get_by_id($id);
    $nilai_pagu = $this->Nilai_pagu_model->get_by_idkeg($id);

    if ($row) {
      $data = array(
        'controller' => 'Kegiatan',
        'uri1' => 'Data Kegiatan',
        'main_view' => 'lkpk/kegiatan/kegiatan_read',

        'id_kegiatan' => $row->id_kegiatan,
        'kode_kegiatan' => $row->kode_kegiatan,
        'nama_kegiatan' => $row->nama_kegiatan,
        'sumber_dana' => strtoupper($row->sumber_dana),
        'tahun_anggaran' => $row->tahun_anggaran,
        'nama_skpd' => $row->nama_skpd,
        'nilai_pagu_data' => $nilai_pagu,

      );
      $this->load->view('template_view', $data);
    } else {
      $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
      redirect(site_url('kegiatan'));
    }
  }

  public function create()
  {
    $data = array(
      'button' => 'Simpan',
      'action' => site_url('lkpk/kegiatan/create_action'),
      'controller' => 'Kegiatan',
      'uri1' => 'Tambah Kegiatan',
      'main_view' => 'lkpk/kegiatan/kegiatan_form',

      'id_kegiatan' => set_value('id_kegiatan'),
      'kode_kegiatan' => set_value('kode_kegiatan'),
      'nama_kegiatan' => set_value('nama_kegiatan'),
      'sumber_dana' => set_value('sumber_dana'),
      'tahun_anggaran' => set_value('tahun_anggaran'),
      'skpd' => set_value('skpd'),
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
        'kode_kegiatan' => $this->input->post('kode_kegiatan',TRUE),
        'nama_kegiatan' => $this->input->post('nama_kegiatan',TRUE),
        'sumber_dana' => $this->input->post('sumber_dana',TRUE),
        'tahun_anggaran' => $this->input->post('tahun_anggaran',TRUE),
        'skpd' => $this->input->post('skpd',TRUE),
      );

      $this->Kegiatan_model->insert($data);
      $this->session->set_flashdata('message', 'Data Berhasil Ditambahkan');
      redirect(site_url('lkpk/kegiatan'));
    }
  }

  public function update($id)
  {
    $row = $this->Kegiatan_model->get_by_id($id);

    if ($row) {
      $data = array(
        'button' => 'Update',
        'action' => site_url('lkpk/kegiatan/update_action'),
        'controller' => 'Kegiatan',
        'uri1' => 'Update Kegiatan',
        'main_view' => 'lkpk/kegiatan/kegiatan_form',

        'id_kegiatan' => set_value('id_kegiatan', $row->id_kegiatan),
        'kode_kegiatan' => set_value('kode_kegiatan', $row->kode_kegiatan),
        'nama_kegiatan' => set_value('nama_kegiatan', $row->nama_kegiatan),
        'sumber_dana' => set_value('sumber_dana', $row->sumber_dana),
        'tahun_anggaran' => set_value('tahun_anggaran', $row->tahun_anggaran),
        'skpd' => set_value('skpd', $row->skpd),
      );
      $this->load->view('template_view', $data);
    } else {
      $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
      redirect(site_url('lkpk/kegiatan'));
    }
  }

  public function update_action()
  {
    $this->_rules();

    if ($this->form_validation->run() == FALSE) {
      $this->update($this->input->post('id_kegiatan', TRUE));
    } else {
      $data = array(
        'kode_kegiatan' => $this->input->post('kode_kegiatan',TRUE),
        'nama_kegiatan' => $this->input->post('nama_kegiatan',TRUE),
        'sumber_dana' => $this->input->post('sumber_dana',TRUE),
        'tahun_anggaran' => $this->input->post('tahun_anggaran',TRUE),
        'skpd' => $this->input->post('skpd',TRUE),
      );

      $this->Kegiatan_model->update($this->input->post('id_kegiatan', TRUE), $data);
      $this->session->set_flashdata('message', 'Update Data Berhasil');
      redirect(site_url('lkpk/kegiatan'));
    }
  }

  public function delete($id)
  {
    $row = $this->Kegiatan_model->get_by_id($id);

    if ($row) {
      $this->Kegiatan_model->delete($id);
      $this->session->set_flashdata('message', 'Data Berhasil Dihapus');
      redirect(site_url('lkpk/kegiatan'));
    } else {
      $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
      redirect(site_url('lkpk/kegiatan'));
    }
  }

  public function _rules()
  {
    $this->form_validation->set_rules('kode_kegiatan', 'kode kegiatan', 'trim|required');
    $this->form_validation->set_rules('nama_kegiatan', 'nama kegiatan', 'trim|required');
    $this->form_validation->set_rules('sumber_dana', 'sumber dana', 'trim|required');
    $this->form_validation->set_rules('tahun_anggaran', 'tahun anggaran', 'trim|required');
    $this->form_validation->set_rules('skpd', 'skpd', 'trim|required');

    $this->form_validation->set_rules('id_kegiatan', 'id_kegiatan', 'trim');
    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
  }

  public function hal_download_format(){
    $data = array(
      'button' => 'Import',
      'action' => site_url('lkpk/kegiatan/download_format'),
      'controller' => 'Kegiatan',
      'uri1' => 'Download Format Import Kegiatan',
      'main_view' => 'lkpk/kegiatan/hal_download_format',
    );
    // if (!$this->ion_auth->in_group('pengelola')){
    //   $data['skpd'] = set_value('skpd',$this->session->userdata('id_skpd'));
    // } else {
      $data['skpd'] = set_value('skpd');
    // }
    $this->load->view('template_view', $data);
  }

  public function hal_import(){
    $data = array(
      'button' => 'Import',
      'action' => site_url('lkpk/kegiatan/import_data'),
      'controller' => 'Kegiatan',
      'uri1' => 'Import Kegiatan',
      'main_view' => 'lkpk/kegiatan/hal_import',
    );
    $this->load->view('template_view', $data);
  }

  public function download_format(){
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

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
            'argb' => 'D7D3D3',
        ],
      ],
    ];

    $validation = $sheet->getCell('C2')->getDataValidation();
    $validation->setType( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST );
    $validation->setErrorStyle( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION );
    $validation->setAllowBlank(false);
    $validation->setShowInputMessage(true);
    $validation->setShowErrorMessage(true);
    $validation->setShowDropDown(true);
    $validation->setErrorTitle('Input error');
    $validation->setError('Value is not in list.');
    $validation->setPromptTitle('Pick from list');
    $validation->setPrompt('Please pick a value from the drop-down list.');
    $validation->setFormula1('"apbd,dak"');

    $validation = $sheet->getCell('D2')->getDataValidation();
    $validation->setType( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST );
    $validation->setErrorStyle( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION );
    $validation->setAllowBlank(false);
    $validation->setShowInputMessage(true);
    $validation->setShowErrorMessage(true);
    $validation->setShowDropDown(true);
    $validation->setErrorTitle('Input error');
    $validation->setError('Value is not in list.');
    $validation->setPromptTitle('Pick from list');
    $validation->setPrompt('Please pick a value from the drop-down list.');
    $validation->setFormula1('"2019"');

    //write data
    $sr = 1;
    $sheet->setCellValue('A'.($sr+0),'Kode Rekening Kegiatan');
    $sheet->setCellValue('B'.($sr+0),'Nama Kegiatan');
    $sheet->setCellValue('C'.($sr+0),'Sumber Dana');
    $sheet->setCellValue('D'.($sr+0),'Tahun Anggaran');
    $sheet->setCellValue('E'.($sr+0),'Kode SKPD');
    $sheet->setCellValue('E'.($sr+1),$this->input->post('skpd',true));

    //styling
    $sheet->getColumnDimension('A')->setAutoSize(true);
    $sheet->getColumnDimension('B')->setAutoSize(true);
    $sheet->getColumnDimension('C')->setAutoSize(true);
    $sheet->getColumnDimension('D')->setAutoSize(true);
    $sheet->getColumnDimension('E')->setAutoSize(true);
    $sheet->getStyle('A'.$sr.':E'.$sr)->applyFromArray($style_table_header);

    //output
    $filename = 'Format import data kegiatan';
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"');
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
  }

  public function import_data(){
        $fileName = time().$_FILES['file']['name'];

        $config['upload_path'] = './temp/'; //buat folder dengan nama assets di root folder
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['max_size'] = 10000;

        $this->load->library('upload');
        $this->upload->initialize($config);

        if(! $this->upload->do_upload('file') ){
          $this->upload->display_errors();
        }

        $media = $this->upload->data('file_name');
        $inputFileName = './temp/'.$media;

        try {
                $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
                $objReader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
            } catch(Exception $e) {
                die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
            }

            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();

            for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                                NULL,
                                                TRUE,
                                                FALSE);
                if (!$this->ion_auth->in_group('pengelola')){
                  $skpd = $this->session->userdata('id_skpd');
                } else {
                  $skpd = $rowData[0][4];
                }
                //Sesuaikan sama nama kolom tabel di database
                 $data = array(
                    "kode_kegiatan"=> $rowData[0][0],
                    "nama_kegiatan"=> $rowData[0][1],
                    "sumber_dana"=> $rowData[0][2],
                    "tahun_anggaran"=> $rowData[0][3],
                    "skpd"=> $skpd,
                );

                //sesuaikan nama dengan nama tabel
                $this->Kegiatan_model->insert($data);
            }
            $media = $this->upload->data('full_path');
            unlink($media);
        $this->session->set_flashdata('message','Data berhasil diimport');
        redirect(site_url('lkpk/kegiatan/'));
    }


    //#######################  DATA RENCANA

//#######################  DATA RENCANA

  public function hal_format_rencana(){
    $data = array(
      'button' => 'Import',
      'action' => site_url('lkpk/kegiatan/download_format_rencana'),
      'controller' => 'Rencana Kegiatan',
      'uri1' => 'Download Format',
      'main_view' => 'lkpk/rencana/hal_format_rencana',
      'periode' => set_value('periode'),
    );
    // if (!$this->ion_auth->in_group('pengelola')){
    //   $data['skpd'] = set_value('skpd',$this->session->userdata('id_skpd'));
    // } else {
      $data['skpd'] = set_value('skpd');
    // }
    $this->load->view('template_view', $data);
  }

  public function download_format_rencana(){
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $skpd = $this->input->post('skpd',true);
    $ta = $this->input->post('tahun_anggaran',true);
    $periode_pagu = $this->input->post('periode',true);
    $periode_pagu_data = $this->Periode_pagu_model->get_by_id($periode_pagu);
    $jenis_rencana = $this->input->post('jenis_rencana',true);
    $data_kegiatan = $this->Kegiatan_model->get_by_skpd_pagu($skpd,$ta,$periode_pagu);

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
        // 'wrapText' => true,
      ],
    ];

    //write data
    $sr = 3;
    $sheet->setCellValue('A'.($sr+0),'Kode Rekening Kegiatan');
    $sheet->setCellValue('B'.($sr+0),'Nama Kegiatan');
    $sheet->setCellValue('C'.($sr+0),'Pagu');
    $sheet->setCellValue('D'.($sr+0),'Januari');
    $sheet->setCellValue('E'.($sr+0),'Februari');
    $sheet->setCellValue('F'.($sr+0),'Maret');
    $sheet->setCellValue('G'.($sr+0),'April');
    $sheet->setCellValue('H'.($sr+0),'Mei');
    $sheet->setCellValue('I'.($sr+0),'Juni');
    $sheet->setCellValue('J'.($sr+0),'Juli');
    $sheet->setCellValue('K'.($sr+0),'Agustus');
    $sheet->setCellValue('L'.($sr+0),'September');
    $sheet->setCellValue('M'.($sr+0),'Oktober');
    $sheet->setCellValue('N'.($sr+0),'Nopember');
    $sheet->setCellValue('O'.($sr+0),'Desember');
    if ($jenis_rencana === 'keuangan'){
      $sheet->setCellValue('P'.($sr+0),'Jumlah');
    }else{
      $sheet->getColumnDimension('P')->setVisible(false);
    }
    $sheet->setCellValue('Q'.($sr+0),'Selisih');
    $sheet->setCellValue('R'.($sr+0),'Kum Januari');
    $sheet->setCellValue('S'.($sr+0),'Kum Pebruari');
    $sheet->setCellValue('T'.($sr+0),'Kum Maret');
    $sheet->setCellValue('U'.($sr+0),'Kum April');
    $sheet->setCellValue('V'.($sr+0),'Kum Mei');
    $sheet->setCellValue('W'.($sr+0),'Kum Juni');
    $sheet->setCellValue('X'.($sr+0),'Kum Juli');
    $sheet->setCellValue('Y'.($sr+0),'Kum Agustus');
    $sheet->setCellValue('Z'.($sr+0),'Kum September');
    $sheet->setCellValue('AA'.($sr+0),'Kum Oktober');
    $sheet->setCellValue('AB'.($sr+0),'Kum Nopember');
    $sheet->setCellValue('AC'.($sr+0),'Kum Desember');
    $sheet->setCellValue('AD'.($sr+0),'Tahun Anggaran');
    $sheet->setCellValue('AE'.($sr+0),'ID Periode Pagu');
    $sheet->setCellValue('AF'.($sr+0),'ID Kegiatan');

    if($data_kegiatan){
      $i = 2;
      $bulan_column = array('D','E','F','G','H','I','J','K','L','M','N','O');
      foreach ($data_kegiatan as $kegiatan){
        $sheet->setCellValue('A'.($sr+$i),$kegiatan->kode_kegiatan);
        $sheet->setCellValue('B'.($sr+$i),$kegiatan->nama_kegiatan);
        $sheet->setCellValue('C'.($sr+$i),$kegiatan->nilai);
        if ($jenis_rencana === 'keuangan'){
          $sheet->setCellValue('P'.($sr+$i),'=SUM(D'.($sr+$i).':O'.($sr+$i).')');
          $sheet->setCellValue('Q'.($sr+$i),'=C'.($sr+$i).'-P'.($sr+$i).'');
          $data_rencana = $this->Kegiatan_model->get_rencana_keu($kegiatan->id_kegiatan,$periode_pagu);
        }else{
          $sheet->setCellValue('Q'.($sr+$i),'=SUM(D'.($sr+$i).':O'.($sr+$i).')-100');
          $data_rencana = $this->Kegiatan_model->get_rencana_fisik($kegiatan->id_kegiatan,$periode_pagu);
        }
        if ($data_rencana) {
          $sheet->setCellValue('D'.($sr+$i),$data_rencana->b01);
          $sheet->setCellValue('E'.($sr+$i),$data_rencana->b02);
          $sheet->setCellValue('F'.($sr+$i),$data_rencana->b03);
          $sheet->setCellValue('G'.($sr+$i),$data_rencana->b04);
          $sheet->setCellValue('H'.($sr+$i),$data_rencana->b05);
          $sheet->setCellValue('I'.($sr+$i),$data_rencana->b06);
          $sheet->setCellValue('J'.($sr+$i),$data_rencana->b07);
          $sheet->setCellValue('K'.($sr+$i),$data_rencana->b08);
          $sheet->setCellValue('L'.($sr+$i),$data_rencana->b09);
          $sheet->setCellValue('M'.($sr+$i),$data_rencana->b10);
          $sheet->setCellValue('N'.($sr+$i),$data_rencana->b11);
          $sheet->setCellValue('O'.($sr+$i),$data_rencana->b12);
        } else {
          for ($x = 0; $x < 12; $x++) {
            $sheet->setCellValue($bulan_column[$x].($sr+$i),0);
          }
        }
        $sheet->setCellValue('R'.($sr+$i),'=SUM(D'.($sr+$i).':D'.($sr+$i).')');
        $sheet->setCellValue('S'.($sr+$i),'=SUM(D'.($sr+$i).':E'.($sr+$i).')');
        $sheet->setCellValue('T'.($sr+$i),'=SUM(D'.($sr+$i).':F'.($sr+$i).')');
        $sheet->setCellValue('U'.($sr+$i),'=SUM(D'.($sr+$i).':G'.($sr+$i).')');
        $sheet->setCellValue('V'.($sr+$i),'=SUM(D'.($sr+$i).':H'.($sr+$i).')');
        $sheet->setCellValue('W'.($sr+$i),'=SUM(D'.($sr+$i).':I'.($sr+$i).')');
        $sheet->setCellValue('X'.($sr+$i),'=SUM(D'.($sr+$i).':J'.($sr+$i).')');
        $sheet->setCellValue('Y'.($sr+$i),'=SUM(D'.($sr+$i).':K'.($sr+$i).')');
        $sheet->setCellValue('Z'.($sr+$i),'=SUM(D'.($sr+$i).':L'.($sr+$i).')');
        $sheet->setCellValue('AA'.($sr+$i),'=SUM(D'.($sr+$i).':M'.($sr+$i).')');
        $sheet->setCellValue('AB'.($sr+$i),'=SUM(D'.($sr+$i).':N'.($sr+$i).')');
        $sheet->setCellValue('AC'.($sr+$i),'=SUM(D'.($sr+$i).':O'.($sr+$i).')');

        $sheet->setCellValue('AD'.($sr+$i),$kegiatan->tahun_anggaran);
        $sheet->setCellValue('AE'.($sr+$i),$periode_pagu);
        $sheet->setCellValue('AF'.($sr+$i),$kegiatan->id_kegiatan);
        $i++;
      }

      ///DATA TOTAL
      $range = array('R','S','T','U','V','W','X','Y','Z','AA','AB','AC');
      if ($jenis_rencana === 'keuangan'){
        $sheet->setCellValue('A1','FORMAT RENCANA PENYERAPAN ANGGARAN');
        foreach (range('C', 'Q') as $col) {
          $sheet->setCellValue($col.'4','=SUM('.$col.($sr+2).':'.$col.($sr+$i-1).')');
        }
        foreach ($range as $col) {
          $sheet->setCellValue($col.'4','=SUM('.$col.($sr+2).':'.$col.($sr+$i-1).')');
        }
      }else{
        $sheet->setCellValue('A1','FORMAT RENCANA PELAKSANAAN KEGIATAN');
        $sheet->setCellValue('C4','=SUM(C'.($sr+2).':C'.($sr+$i-1).')');
        $sheet->setCellValue('Q4','=SUM(Q'.($sr+2).':Q'.($sr+$i-1).')');

        $range1 = array('AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR');
        $range2 = array('D','E','F','G','H','I','J','K','L','M','N','O');
        $row= $spreadsheet->getActiveSheet()->getHighestRow();
        for ($y=5; $y<=$row; $y++){
          $x= 0;
          foreach ($range1 as $col){
            $sheet->setCellValue(''.$col.$y.'','='.$range2[$x].$y.'*($C$'.$y.'/$C$4*100)/100');
            $x++;
          }
        }
        $x=0;
        foreach (range('D', 'O') as $col) {
          $sheet->setCellValue($col.'4','=SUM('.$range1[$x].($sr+2).':'.$range1[$x].($sr+$i-1).')');
          $x++;
        }
        $x=0;
        foreach ($range as $col) {
          $sheet->setCellValue(''.$col.'4','=SUM(D4:'.$range2[$x].'4)');
          $x++;
        }
      }
      $sheet->setCellValue('B4','TOTAL');
      $sheet->setCellValue('AD4',$ta);
      $sheet->setCellValue('AE4',$periode_pagu);
      $sheet->setCellValue('AF4',$skpd);

    } else {
      $this->session->set_flashdata('error',"Kegiatan Tidak Ditemukan");
      redirect(site_url('lkpk/kegiatan'));
    }

    //styling
    $sheet->getColumnDimension('A')->setAutoSize(false);
    $sheet->getColumnDimension('A')->setWidth(19);
    $sheet->getColumnDimension('B')->setAutoSize(false);
    $sheet->getColumnDimension('B')->setWidth(50);
    $sheet->freezePane('C4');
    $sheet->getStyle('D'.($sr+2).':O'.($sr+$i-1))->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('89BAEB');
    $sheet->getStyle('C'.($sr+1).':AC'.($sr+$i-1))->getNumberFormat()->setFormatCode(('#,##0.00'));
    $sheet->getStyle('A'.($sr+1).':AF'.($sr+$i-1))->applyFromArray($style_table_data);
    $sheet->getStyle('A'.$sr.':AF'.$sr)->applyFromArray($style_table_header);
    // foreach (range('A', 'Q') as $col) {
    //     $sheet->getColumnDimension($col)->setAutoSize(true);
    // }
    foreach (range('C', 'Q') as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(false);
        if ($jenis_rencana === 'keuangan'){
          $sheet->getColumnDimension($col)->setWidth(20);
        }else{
          $sheet->getColumnDimension($col)->setWidth(12);
        }
    }
    $range = array('R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR');
    foreach ($range as $col) {
      $sheet->getColumnDimension($col)->setVisible(false);
    }

    // PROTECTION
    $sheet->getProtection()->setPassword('deded551989');
    $sheet->getProtection()->setSheet(true);
    $sheet->getProtection()->setInsertRows(true);
    $sheet->getProtection()->setInsertColumns(true);
    $sheet->getStyle('D'.($sr+2).':O'.($sr+$i-1))->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);

    //output
    $filename = 'Format import data rencana '.$jenis_rencana.' kegiatan APBD '.$periode_pagu_data->keterangan;
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"');
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
  }

  public function hal_import_rencana(){
    $data = array(
      'button' => 'Import',
      'action' => site_url('lkpk/kegiatan/import_data_rencana'),
      'controller' => 'Kegiatan',
      'uri1' => 'Import Rencana Kegiatan',
      'main_view' => 'lkpk/rencana/hal_import_rencana',
    );
    $this->load->view('template_view', $data);
  }

  public function import_data_rencana(){
    $fileName = time().$_FILES['file']['name'];

    $config['upload_path'] = './temp/'; //buat folder dengan nama assets di root folder
    $config['file_name'] = $fileName;
    $config['allowed_types'] = 'xls|xlsx|csv';
    $config['max_size'] = 10000;

    $this->load->library('upload');
    $this->upload->initialize($config);

    if(! $this->upload->do_upload('file') ){
      $this->upload->display_errors();
    }

    $media = $this->upload->data('file_name');
    $inputFileName = './temp/'.$media;

    try {
            $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
            $objReader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
        } catch(Exception $e) {
            die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
        }

        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        $jenis_rencana = $this->input->post('jenis_rencana',true);

        for ($row = 5; $row <= $highestRow; $row++){                  //  Read a row of data into an array
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                            NULL,
                                            TRUE,
                                            FALSE);
            //Sesuaikan sama nama kolom tabel di database
             $data = array(
                "kegiatan"=> $rowData[0][31],
                "periode_pagu"=> $rowData[0][30],
                "b01"=> $rowData[0][3],
                "b02"=> $rowData[0][4],
                "b03"=> $rowData[0][5],
                "b04"=> $rowData[0][6],
                "b05"=> $rowData[0][7],
                "b06"=> $rowData[0][8],
                "b07"=> $rowData[0][9],
                "b08"=> $rowData[0][10],
                "b09"=> $rowData[0][11],
                "b10"=> $rowData[0][12],
                "b11"=> $rowData[0][13],
                "b12"=> $rowData[0][14],
                "kumb01"=> $rowData[0][17],
                "kumb02"=> $rowData[0][18],
                "kumb03"=> $rowData[0][19],
                "kumb04"=> $rowData[0][20],
                "kumb05"=> $rowData[0][21],
                "kumb06"=> $rowData[0][22],
                "kumb07"=> $rowData[0][23],
                "kumb08"=> $rowData[0][24],
                "kumb09"=> $rowData[0][25],
                "kumb10"=> $rowData[0][26],
                "kumb11"=> $rowData[0][27],
                "kumb12"=> $rowData[0][28],
            );

            //sesuaikan nama dengan nama tabel
            $this->Kegiatan_model->insert_rencana($data,$jenis_rencana);
        }

        $rowDataTotal = $sheet->rangeToArray('A4:' . $highestColumn . '4',
                                        NULL,
                                        TRUE,
                                        FALSE);
        $data_total = array(
          "skpd"=>$rowDataTotal[0][31],
          "periode_pagu"=>$rowDataTotal[0][30],
          "b01"=> $rowDataTotal[0][3],
          "b02"=> $rowDataTotal[0][4],
          "b03"=> $rowDataTotal[0][5],
          "b04"=> $rowDataTotal[0][6],
          "b05"=> $rowDataTotal[0][7],
          "b06"=> $rowDataTotal[0][8],
          "b07"=> $rowDataTotal[0][9],
          "b08"=> $rowDataTotal[0][10],
          "b09"=> $rowDataTotal[0][11],
          "b10"=> $rowDataTotal[0][12],
          "b11"=> $rowDataTotal[0][13],
          "b12"=> $rowDataTotal[0][14],
          "kumb01"=> $rowDataTotal[0][17],
          "kumb02"=> $rowDataTotal[0][18],
          "kumb03"=> $rowDataTotal[0][19],
          "kumb04"=> $rowDataTotal[0][20],
          "kumb05"=> $rowDataTotal[0][21],
          "kumb06"=> $rowDataTotal[0][22],
          "kumb07"=> $rowDataTotal[0][23],
          "kumb08"=> $rowDataTotal[0][24],
          "kumb09"=> $rowDataTotal[0][25],
          "kumb10"=> $rowDataTotal[0][26],
          "kumb11"=> $rowDataTotal[0][27],
          "kumb12"=> $rowDataTotal[0][28],
        );
        $this->Kegiatan_model->insert_rencana_total($data_total,$jenis_rencana);

        $media = $this->upload->data('full_path');
        unlink($media);
    $this->session->set_flashdata('message','Data berhasil diimport');
    redirect(site_url('lkpk/kegiatan/'));
  }


//#######################  DATA REALISASI

  public function hal_format_realisasi(){
    $data = array(
      'button' => 'Import',
      'action' => site_url('lkpk/kegiatan/download_format_realisasi'),
      'controller' => 'Realisasi Kegiatan',
      'uri1' => 'Download Format',
      'main_view' => 'lkpk/realisasi/hal_format_realisasi',
      'periode' => set_value('periode'),
    );
      $data['skpd'] = set_value('skpd');
    $this->load->view('template_view', $data);
  }

  public function download_format_realisasi(){
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $skpd = $this->input->post('skpd',true);
    $ta = $this->input->post('tahun_anggaran',true);
    $periode_pagu = $this->input->post('periode',true);
    $jenis_realisasi= $this->input->post('jenis_realisasi',true);
    $bulan_realisasi= $this->input->post('bulan_realisasi',true);
    $data_kegiatan = $this->Kegiatan_model->get_by_skpd_pagu($skpd,$ta,$periode_pagu);
    $bulan = array("Januari","Pebruari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","Nopember","Desember");

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

    //write data
    if($jenis_realisasi === 'keuangan'){
      $sheet->setCellValue('A1','FORMAT REALISASI PENYERAPAN ANGGARAN');
    }else{
      $sheet->setCellValue('A1','FORMAT REALISASI PELAKSANAAN KEGIATAN');
    }
    $sr = 3;
    $sheet->setCellValue('A'.($sr+0),'Kode Rekening Kegiatan');
    $sheet->setCellValue('B'.($sr+0),'Nama Kegiatan');
    $sheet->setCellValue('B4','TOTAL');
    $sheet->setCellValue('C'.($sr+0),'Jumlah Pagu');
    $sheet->setCellValue('D'.($sr+0),'Realisasi s.d Bulan Sebelumnya');
    $sheet->setCellValue('E'.($sr+0),'Realisasi Bulan '.$bulan[$bulan_realisasi]);
    $sheet->setCellValue('F'.($sr+0),'Realisasi s.d Bulan '.$bulan[$bulan_realisasi]);
    $sheet->setCellValue('G'.($sr+0),'Keterangan');

    $sheet->setCellValue('I'.($sr+0),'Januari');
    $sheet->setCellValue('J'.($sr+0),'Februari');
    $sheet->setCellValue('K'.($sr+0),'Maret');
    $sheet->setCellValue('L'.($sr+0),'April');
    $sheet->setCellValue('M'.($sr+0),'Mei');
    $sheet->setCellValue('N'.($sr+0),'Juni');
    $sheet->setCellValue('O'.($sr+0),'Juli');
    $sheet->setCellValue('P'.($sr+0),'Agustus');
    $sheet->setCellValue('Q'.($sr+0),'September');
    $sheet->setCellValue('R'.($sr+0),'Oktober');
    $sheet->setCellValue('S'.($sr+0),'Nopember');
    $sheet->setCellValue('T'.($sr+0),'Desember');
    $sheet->setCellValue('AS'.($sr+0),'Tahun Anggaran');
    $sheet->setCellValue('AT'.($sr+0),'ID Periode Pagu');
    $sheet->setCellValue('AU'.($sr+0),'ID Kegiatan');
    $sheet->setCellValue('AV'.($sr+0),'ID Bulan');
    $bulan_column = array('I','J','K','L','M','N','O','P','Q','R','S','T');
    $range_kum = array('U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF');
    $range_ttb = array('AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR');

    $sheet->setCellValue('AS4',$ta);
    $sheet->setCellValue('AT4',$periode_pagu);
    $sheet->setCellValue('AU4',$skpd);
    $sheet->setCellValue('AV4',$bulan_realisasi);
    if($data_kegiatan){
      $i = 2;
      foreach ($data_kegiatan as $kegiatan){
        $sheet->setCellValue('A'.($sr+$i),$kegiatan->kode_kegiatan);
        $sheet->setCellValue('B'.($sr+$i),$kegiatan->nama_kegiatan);
        $sheet->setCellValue('C'.($sr+$i),$kegiatan->nilai);
        $sheet->setCellValue('D'.($sr+$i), $bulan_realisasi > 0 ? '=SUM(I'.($sr+$i).':'.$bulan_column[$bulan_realisasi-1].($sr+$i).')' : 0);
        $sheet->setCellValue('E'.($sr+$i),'='.$bulan_column[$bulan_realisasi].($sr+$i));
        $sheet->setCellValue('F'.($sr+$i),'=SUM(D'.($sr+$i).':E'.($sr+$i).')');
        $sheet->setCellValue('AS'.($sr+$i),$kegiatan->tahun_anggaran);
        $sheet->setCellValue('AT'.($sr+$i),$periode_pagu);
        $sheet->setCellValue('AU'.($sr+$i),$kegiatan->id_kegiatan);
        $sheet->setCellValue('AV'.($sr+$i),$bulan_realisasi);
        if ($jenis_realisasi === 'keuangan'){
          $sheet->setCellValue('G'.($sr+$i),'=IF(F'.($sr+$i).'>C'.($sr+$i).',"Realisasi Melebihi Pagu","-")');
          $data_realisasi = $this->Kegiatan_model->get_realisasi_keu($kegiatan->id_kegiatan);
        }else{
          $sheet->setCellValue('G'.($sr+$i),'=IF(F'.($sr+$i).'>100,"Realisasi Melebihi 100 %","-")');
          $data_realisasi = $this->Kegiatan_model->get_realisasi_fisik($kegiatan->id_kegiatan);
        }
        if ($data_realisasi) {
          $sheet->setCellValue('I'.($sr+$i),$data_realisasi->b01);
          $sheet->setCellValue('J'.($sr+$i),$data_realisasi->b02);
          $sheet->setCellValue('K'.($sr+$i),$data_realisasi->b03);
          $sheet->setCellValue('L'.($sr+$i),$data_realisasi->b04);
          $sheet->setCellValue('M'.($sr+$i),$data_realisasi->b05);
          $sheet->setCellValue('N'.($sr+$i),$data_realisasi->b06);
          $sheet->setCellValue('O'.($sr+$i),$data_realisasi->b07);
          $sheet->setCellValue('P'.($sr+$i),$data_realisasi->b08);
          $sheet->setCellValue('Q'.($sr+$i),$data_realisasi->b09);
          $sheet->setCellValue('R'.($sr+$i),$data_realisasi->b10);
          $sheet->setCellValue('S'.($sr+$i),$data_realisasi->b11);
          $sheet->setCellValue('T'.($sr+$i),$data_realisasi->b12);
        } else {
          for ($x = 0; $x < 12; $x++) {
            $sheet->setCellValue($bulan_column[$x].($sr+$i),0);
          }
        }
        $x=0;
        foreach ($range_kum as $col) {
          $sheet->setCellValue(''.$col.($sr+$i).'','=SUM(I'.($sr+$i).':'.$bulan_column[$x].($sr+$i).')');
          $x++;
        }
        if($jenis_realisasi === 'fisik'){
          $x=0;
          foreach ($bulan_column as $col) {
            $sheet->setCellValue(''.$col.'4','='.$range_ttb[$x].'4');
            $x++;
          }
          $x=0;
          foreach ($range_kum as $col) {
            $sheet->setCellValue(''.$col.'4','=SUM(I4:'.$bulan_column[$x].'4)');
            $x++;
          }
          $x=0;
          foreach ($range_ttb as $col) {
            $sheet->setCellValue(''.$col.($sr+$i).'','='.$bulan_column[$x].''.($sr+$i).'*($C$'.($sr+$i).'/$C$4*100)/100');
            $sheet->setCellValue(''.$col.'4','=SUM('.$col.'5:'.$col.($sr+$i).')');
            $x++;
          }
        }else{
          foreach ($bulan_column as $col) {
            $sheet->setCellValue(''.$col.'4','=SUM('.$col.'5:'.$col.($sr+$i).')');
          }
          $x=0;
          foreach ($range_kum as $col) {
            $sheet->setCellValue(''.$col.'4','=SUM(I4:'.$bulan_column[$x].'4)');
            $x++;
          }
        }
        $sheet->setCellValue('D4','=SUM(I4:'.$bulan_column[$bulan_realisasi-1].'4)');
        $sheet->setCellValue('E4','='.$bulan_column[$bulan_realisasi].'4');
        $sheet->setCellValue('F4','=SUM(D4:E4)');
        $sheet->setCellValue('G4','=IF(F4>C4,"Realisasi Melebihi Pagu","-")');
        $i++;
      }
      //DATA TOTAL
      $sheet->setCellValue('C4','=SUM(C5:C'.($sr+$i-1).')');

      $sheet->getStyle($bulan_column[$bulan_realisasi].($sr+2).':'.$bulan_column[$bulan_realisasi].($sr+$i-1))->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('89BAEB');
      $sheet->getStyle('C'.($sr+1).':F'.($sr+$i-1))->getNumberFormat()->setFormatCode(('#,##0.00'));
      $sheet->getStyle('I'.($sr+1).':T'.($sr+$i-1))->getNumberFormat()->setFormatCode(('#,##0.00'));
      $sheet->getStyle('A'.($sr+1).':T'.($sr+$i-1))->applyFromArray($style_table_data);
    } else {
      $this->session->set_flashdata('error',"Kegiatan Tidak Ditemukan");
      redirect(site_url('lkpk/kegiatan'));
    }

    //styling
    $sheet->getStyle('A'.$sr.':T'.$sr)->applyFromArray($style_table_header);
    $sheet->getColumnDimension('A')->setWidth(19);
    $sheet->getColumnDimension('C')->setWidth(20);
    $sheet->getColumnDimension('G')->setWidth(30);
    $sheet->getColumnDimension('H')->setWidth(3);
    foreach (range('A', $sheet->getHighestColumn()) as $col) {
      $sheet->getColumnDimension($col)->setAutoSize(true);
    }
    foreach (range('I', 'T') as $col) {
      $sheet->getColumnDimension($col)->setAutoSize(false);
      if ($jenis_realisasi === 'keuangan'){
        $sheet->getColumnDimension($col)->setWidth(20);
      }else{
        $sheet->getColumnDimension($col)->setWidth(12);
      }
    }
    foreach (range('D', 'F') as $col) {
      $sheet->getColumnDimension($col)->setAutoSize(false);
      $sheet->getColumnDimension($col)->setWidth(20);
    }
    $range = array('U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV');
    foreach ($range as $col) {
      $sheet->getColumnDimension($col)->setVisible(false);
    }
    $sheet->getRowDimension($sr)->setRowHeight('30');
    $sheet->freezePane('C4');
    $sheet->getColumnDimension('B')->setAutoSize(false);
    $sheet->getColumnDimension('B')->setWidth(50);

    //PROTECTION
    $sheet->getProtection()->setPassword('deded551989');
    $sheet->getProtection()->setSheet(true);
    $sheet->getProtection()->setInsertRows(true);
    $sheet->getProtection()->setInsertColumns(true);
    $sheet->getStyle($bulan_column[$bulan_realisasi].($sr+2).':'.$bulan_column[$bulan_realisasi].($sr+$i-1))->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);

    //output
    $filename = 'Format import data realisasi '.$jenis_realisasi.' kegiatan bulan '.$bulan[$bulan_realisasi].' tahun '.$ta;
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"');
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
  }

  public function hal_import_realisasi(){
    $data = array(
      'button' => 'Import',
      'action' => site_url('lkpk/kegiatan/import_data_realisasi'),
      'controller' => 'Kegiatan',
      'uri1' => 'Import Realisasi Kegiatan',
      'main_view' => 'lkpk/realisasi/hal_import_realisasi',
    );
    $this->load->view('template_view', $data);
  }

  public function import_data_realisasi(){
    $fileName = time().$_FILES['file']['name'];

    $config['upload_path'] = './temp/'; //buat folder dengan nama assets di root folder
    $config['file_name'] = $fileName;
    $config['allowed_types'] = 'xls|xlsx|csv';
    $config['max_size'] = 10000;

    $this->load->library('upload');
    $this->upload->initialize($config);

    if(! $this->upload->do_upload('file') ){
      $this->upload->display_errors();
    }

    $media = $this->upload->data('file_name');
    $inputFileName = './temp/'.$media;

    try {
            $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
            $objReader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
        } catch(Exception $e) {
            die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
        }

        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        $jenis_realisasi = $this->input->post('jenis_realisasi',true);

        for ($row = 5; $row <= $highestRow; $row++){                  //  Read a row of data into an array
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                            NULL,
                                            TRUE,
                                            FALSE);
            //Sesuaikan sama nama kolom tabel di database
             $data = array(
                "kegiatan"=> $rowData[0][46],
                "periode_pagu"=> $rowData[0][45],
                "b01"=> $rowData[0][8],
                "b02"=> $rowData[0][9],
                "b03"=> $rowData[0][10],
                "b04"=> $rowData[0][11],
                "b05"=> $rowData[0][12],
                "b06"=> $rowData[0][13],
                "b07"=> $rowData[0][14],
                "b08"=> $rowData[0][15],
                "b09"=> $rowData[0][16],
                "b10"=> $rowData[0][17],
                "b11"=> $rowData[0][18],
                "b12"=> $rowData[0][19],
                "kumb01"=> $rowData[0][20],
                "kumb02"=> $rowData[0][21],
                "kumb03"=> $rowData[0][22],
                "kumb04"=> $rowData[0][23],
                "kumb05"=> $rowData[0][24],
                "kumb06"=> $rowData[0][25],
                "kumb07"=> $rowData[0][26],
                "kumb08"=> $rowData[0][27],
                "kumb09"=> $rowData[0][28],
                "kumb10"=> $rowData[0][29],
                "kumb11"=> $rowData[0][30],
                "kumb12"=> $rowData[0][31],
            );

            //sesuaikan nama dengan nama tabel
            $this->Kegiatan_model->insert_realisasi($data,$jenis_realisasi);
        }
        $rowDataTotal = $sheet->rangeToArray('A4:' . $highestColumn . '4',
                                        NULL,
                                        TRUE,
                                        FALSE);
        $data_total = array(
          "skpd"=> $rowDataTotal[0][46],
          "periode_pagu"=> $rowDataTotal[0][45],
          "b01"=> $rowDataTotal[0][8],
          "b02"=> $rowDataTotal[0][9],
          "b03"=> $rowDataTotal[0][10],
          "b04"=> $rowDataTotal[0][11],
          "b05"=> $rowDataTotal[0][12],
          "b06"=> $rowDataTotal[0][13],
          "b07"=> $rowDataTotal[0][14],
          "b08"=> $rowDataTotal[0][15],
          "b09"=> $rowDataTotal[0][16],
          "b10"=> $rowDataTotal[0][17],
          "b11"=> $rowDataTotal[0][18],
          "b12"=> $rowDataTotal[0][19],
          "kumb01"=> $rowDataTotal[0][20],
          "kumb02"=> $rowDataTotal[0][21],
          "kumb03"=> $rowDataTotal[0][22],
          "kumb04"=> $rowDataTotal[0][23],
          "kumb05"=> $rowDataTotal[0][24],
          "kumb06"=> $rowDataTotal[0][25],
          "kumb07"=> $rowDataTotal[0][26],
          "kumb08"=> $rowDataTotal[0][27],
          "kumb09"=> $rowDataTotal[0][28],
          "kumb10"=> $rowDataTotal[0][29],
          "kumb11"=> $rowDataTotal[0][30],
          "kumb12"=> $rowDataTotal[0][31],
        );
        $this->Kegiatan_model->insert_realisasi_total($data_total,$jenis_realisasi);

        $media = $this->upload->data('full_path');
        unlink($media);
    $this->session->set_flashdata('message','Data berhasil diimport');
    redirect(site_url('lkpk/kegiatan/'));
  }


//######################### GRAFIK

  public function grafik_pemko_keu() {
    $data = array(
      'controller' => 'Grafik',
      'uri1' => 'Rencana Realisasi',
      'main_view' => 'lkpk/grafik/pemko_keu',
    );
    $this->load->view('template_view',$data);
  }

  public function grafik_pemko_fisik() {
    $data = array(
      'controller' => 'Grafik',
      'uri1' => 'Rencana Realisasi',
      'main_view' => 'lkpk/grafik/pemko_fisik',
    );
    $this->load->view('template_view',$data);
  }


//######################## TPP
public function download_hit_tpp(){
  $spreadsheet = new Spreadsheet();
  $sheet = $spreadsheet->getActiveSheet();

  $data_skpd = $this->Skpd_model->get_all();
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

  //write data
  $sr = 4;
  foreach($data_skpd as $skpd){
    $data_ren_all = $this->Kegiatan_model->sum_ren_keu($skpd->id_skpd,'09');

    $sheet->setCellValue('A'.$sr,$skpd->nama_skpd);
    $sheet->setCellValue('B'.$sr,$data_ren_all->ren_keu_all);
    $sr++;
  }


  //PROTECTION
  // $sheet->getProtection()->setPassword('deded551989');
  // $sheet->getProtection()->setSheet(true);
  // $sheet->getProtection()->setInsertRows(true);
  // $sheet->getProtection()->setInsertColumns(true);
  // $sheet->getStyle($bulan_column[$bulan_realisasi].($sr+2).':'.$bulan_column[$bulan_realisasi].($sr+$i-1))->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);

  //output
  $filename = 'Perhitungan TPP';
  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"');
  header('Cache-Control: max-age=0');

  $writer = new Xlsx($spreadsheet);
  $writer->save('php://output');
}


}




/* End of file Kegiatan.php */
/* Location: ./application/controllers/Kegiatan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-09-02 09:54:30 */
/* http://harviacode.com */
?>
