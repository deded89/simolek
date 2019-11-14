<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;

class Nilai_pagu extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('lkpk/Kegiatan_model');
    $this->load->model('lkpk/Nilai_pagu_model');
    $this->load->library('form_validation');
  }

  public function index()
  {
    $nilai_pagu = $this->Nilai_pagu_model->get_all();

    $data = array(
      'nilai_pagu_data' => $nilai_pagu,
      'controller' => 'Nilai_pagu',
      'uri1' => 'List Nilai_pagu',
      'main_view' => 'lkpk/nilai_pagu/nilai_pagu_list'
    );

    $this->load->view('template_view', $data);
  }

  public function read($id)
  {
    $row = $this->Nilai_pagu_model->get_by_id($id);
    if ($row) {
      $data = array(
        'controller' => 'Nilai_pagu',
        'uri1' => 'Data Nilai_pagu',
        'main_view' => 'lkpk/nilai_pagu/nilai_pagu_read',

        'id_nilai_pagu' => $row->id_nilai_pagu,
        'nilai' => $row->nilai,
        'kegiatan' => $row->kegiatan,
        'periode_pagu' => $row->periode_pagu,
      );
      $this->load->view('template_view', $data);
    } else {
      $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
      redirect(site_url('lkpk/nilai_pagu'));
    }
  }

  public function create()
  {
    $data = array(
      'button' => 'Simpan',
      'action' => site_url('lkpk/nilai_pagu/create_action'),
      'controller' => 'Nilai_pagu',
      'uri1' => 'Tambah Nilai_pagu',
      'main_view' => 'lkpk/nilai_pagu/nilai_pagu_form',

      'id_nilai_pagu' => set_value('id_nilai_pagu'),
      'nilai' => set_value('nilai'),
      'kegiatan' => set_value('kegiatan'),
      'periode_pagu' => set_value('periode_pagu'),
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
        'nilai' => $this->input->post('nilai',TRUE),
        'kegiatan' => $this->input->post('kegiatan',TRUE),
        'periode_pagu' => $this->input->post('periode_pagu',TRUE),
      );

      $this->Nilai_pagu_model->insert($data);
      $this->session->set_flashdata('message', 'Data Berhasil Ditambahkan');
      redirect(site_url('lkpk/nilai_pagu'));
    }
  }

  public function update($id)
  {
    $row = $this->Nilai_pagu_model->get_by_id($id);

    if ($row) {
      $data = array(
        'button' => 'Update',
        'action' => site_url('lkpk/nilai_pagu/update_action'),
        'controller' => 'Nilai_pagu',
        'uri1' => 'Update Nilai_pagu',
        'main_view' => 'lkpk/nilai_pagu/nilai_pagu_form',

        'id_nilai_pagu' => set_value('id_nilai_pagu', $row->id_nilai_pagu),
        'nilai' => set_value('nilai', $row->nilai),
        'kegiatan' => set_value('kegiatan', $row->kegiatan),
        'periode_pagu' => set_value('periode_pagu', $row->periode_pagu),
      );
      $this->load->view('template_view', $data);
    } else {
      $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
      redirect(site_url('lkpk/nilai_pagu'));
    }
  }

  public function update_action()
  {
    $this->_rules();

    if ($this->form_validation->run() == FALSE) {
      $this->update($this->input->post('id_nilai_pagu', TRUE));
    } else {
      $data = array(
        'nilai' => $this->input->post('nilai',TRUE),
        'kegiatan' => $this->input->post('kegiatan',TRUE),
        'periode_pagu' => $this->input->post('periode_pagu',TRUE),
      );

      $this->Nilai_pagu_model->update($this->input->post('id_nilai_pagu', TRUE), $data);
      $this->session->set_flashdata('message', 'Update Data Berhasil');
      redirect(site_url('lkpk/kegiatan/read/'.$this->input->post('kegiatan',TRUE)));
    }
  }

  public function delete($id)
  {
    $row = $this->Nilai_pagu_model->get_by_id($id);

    if ($row) {
      $this->Nilai_pagu_model->delete($id);
      $this->session->set_flashdata('message', 'Data Berhasil Dihapus');
      redirect(site_url('lkpk/nilai_pagu'));
    } else {
      $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
      redirect(site_url('lkpk/nilai_pagu'));
    }
  }

  public function _rules()
  {
    $this->form_validation->set_rules('nilai', 'nilai', 'trim|required|numeric');
    $this->form_validation->set_rules('kegiatan', 'kegiatan', 'trim|required');
    $this->form_validation->set_rules('periode_pagu', 'periode pagu', 'trim|required');

    $this->form_validation->set_rules('id_nilai_pagu', 'id_nilai_pagu', 'trim');
    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
  }

  public function hal_format_pagu(){
    $data = array(
      'button' => 'Import',
      'action' => site_url('lkpk/nilai_pagu/download_format'),
      'controller' => 'Nilai Pagu',
      'uri1' => 'Format Input Nilai Pagu',
      'main_view' => 'lkpk/nilai_pagu/hal_download_format',
    );
    if (!$this->ion_auth->in_group('pengelola')){
      $data['skpd'] = set_value('skpd',$this->session->userdata('id_skpd'));
    } else {
      $data['skpd'] = set_value('skpd');
      $data['periode'] = set_value('periode');
    }
    $this->load->view('template_view', $data);
  }

  public function hal_import(){
    $data = array(
      'button' => 'Import',
      'action' => site_url('lkpk/nilai_pagu/import_data'),
      'controller' => 'Kegiatan',
      'uri1' => 'Import Nilai Pagu Kegiatan',
      'main_view' => 'lkpk/nilai_pagu/hal_import',
    );
    $this->load->view('template_view', $data);
  }

  public function download_format(){
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();


    $skpd = $this->input->post('skpd',true);
    $ta = $this->input->post('tahun_anggaran',true);
    $periode_pagu = $this->input->post('periode',true);
    $data_kegiatan = $this->Kegiatan_model->get_by_skpd($skpd,$ta);
    $data_kegiatan_nilai = $this->Kegiatan_model->get_by_skpd_pagu($skpd,$ta,$periode_pagu);

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
        'wrapText' => true,
      ],
    ];

    //write data
    $sheet->setCellValue('A1','FORMAT INPUT PAGU KEGIATAN SKPD');

    $sr = 3;
    $sheet->setCellValue('A'.($sr+0),'Kode Rekening Kegiatan');
    $sheet->setCellValue('B'.($sr+0),'Nama Kegiatan');
    $sheet->setCellValue('C'.($sr+0),'Input Pagu');
    $sheet->setCellValue('D'.($sr+0),'Sumber Dana');
    $sheet->setCellValue('E'.($sr+0),'Tahun Anggaran');
    $sheet->setCellValue('F'.($sr+0),'ID Periode Pagu');
    $sheet->setCellValue('G'.($sr+0),'ID Kegiatan');


    if($data_kegiatan_nilai){
      $i = 2;
      foreach ($data_kegiatan_nilai as $kegiatan){
        $sheet->setCellValue('A'.($sr+$i),$kegiatan->kode_kegiatan);
        $sheet->setCellValue('B'.($sr+$i),$kegiatan->nama_kegiatan);
        $sheet->setCellValue('C'.($sr+$i),$kegiatan->nilai);
        $sheet->getStyle('C'.($sr+$i))->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFCC');
        $sheet->getStyle('C'.($sr+$i))->getNumberFormat()->setFormatCode(('#,##0.00'));
        $sheet->setCellValue('D'.($sr+$i),$kegiatan->sumber_dana);
        $sheet->setCellValue('E'.($sr+$i),$kegiatan->tahun_anggaran);
        $sheet->setCellValue('F'.($sr+$i),$periode_pagu);
        $sheet->setCellValue('G'.($sr+$i),$kegiatan->id_kegiatan);
        $i++;
      }
      $sheet->getStyle('A'.($sr+1).':G'.($sr+$i-1))->applyFromArray($style_table_data);
      $sheet->setCellValue('B'.($sr+1),'TOTAL');
      $sheet->setCellValue('C'.($sr+1),'=SUM(C'.($sr+2).':C'.($sr+$i-1).')');
      $sheet->getStyle('C'.($sr+1))->getNumberFormat()->setFormatCode(('#,##0.00'));
      $sheet->setCellValue('F'.($sr+1),$periode_pagu);
      $sheet->setCellValue('G'.($sr+1),$skpd);
    } else if($data_kegiatan) {
      $i = 2;
      foreach ($data_kegiatan as $kegiatan){
        $sheet->setCellValue('A'.($sr+$i),$kegiatan->kode_kegiatan);
        $sheet->setCellValue('B'.($sr+$i),$kegiatan->nama_kegiatan);
        $sheet->setCellValue('C'.($sr+$i),0);
        $sheet->getStyle('C'.($sr+$i))->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFCC');
        $sheet->getStyle('C'.($sr+$i))->getNumberFormat()->setFormatCode(('#,##0.00'));
        $sheet->setCellValue('D'.($sr+$i),$kegiatan->sumber_dana);
        $sheet->setCellValue('E'.($sr+$i),$kegiatan->tahun_anggaran);
        $sheet->setCellValue('F'.($sr+$i),$periode_pagu);
        $sheet->setCellValue('G'.($sr+$i),$kegiatan->id_kegiatan);
        $i++;
      }
      $sheet->getStyle('A'.($sr+1).':G'.($sr+$i-1))->applyFromArray($style_table_data);
      $sheet->setCellValue('B'.($sr+1),'TOTAL');
      $sheet->setCellValue('C'.($sr+1),'=SUM(C'.($sr+2).':C'.($sr+$i-1).')');
      $sheet->getStyle('C'.($sr+1))->getNumberFormat()->setFormatCode(('#,##0.00'));
      $sheet->setCellValue('F'.($sr+1),$periode_pagu);
      $sheet->setCellValue('G'.($sr+1),$skpd);
    } else {
      $this->session->set_flashdata('error',"Kegiatan Tidak Ditemukan");
      redirect(site_url('lkpk/kegiatan'));
    }

    //styling
    $sheet->getColumnDimension('A')->setAutoSize(false);
    $sheet->getColumnDimension('A')->setWidth('22');
    $sheet->getColumnDimension('B')->setAutoSize(true);
    $sheet->getColumnDimension('C')->setAutoSize(false);
    $sheet->getColumnDimension('C')->setWidth('22');
    $sheet->getColumnDimension('D')->setAutoSize(true);
    $sheet->getColumnDimension('E')->setAutoSize(true);
    $sheet->getColumnDimension('F')->setAutoSize(true);
    $sheet->getStyle('A'.$sr.':G'.$sr)->applyFromArray($style_table_header);
    foreach (range('D', 'G') as $col) {
      $sheet->getColumnDimension($col)->setVisible(false);
    }

    //PROTECTION
    $sheet->getProtection()->setPassword('deded551989');
    $sheet->getProtection()->setSheet(true);
    $sheet->getProtection()->setInsertRows(true);
    $sheet->getProtection()->setInsertColumns(true);
    $sheet->getStyle('C'.($sr+2).':C'.($sr+$i-1))->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);

    //output
    $filename = 'Format import data pagu kegiatan';
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

            for ($row = 5; $row <= $highestRow; $row++){                  //  Read a row of data into an array
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                                NULL,
                                                TRUE,
                                                FALSE);
                //Sesuaikan sama nama kolom tabel di database
                 $data = array(
                    "nilai"=> $rowData[0][2],
                    "kegiatan"=> $rowData[0][6],
                    "periode_pagu"=> $rowData[0][5],
                );

                //sesuaikan nama dengan nama tabel
                $this->Nilai_pagu_model->insert($data);
            }

            $total_data['nilai'] = $sheet->getCell('C4')->getCalculatedValue();
            $total_data['periode_pagu'] = $sheet->getCell('F4')->getValue();
            $total_data['skpd'] = $sheet->getCell('G4')->getValue();
            $this->Nilai_pagu_model->insert_total($total_data);

            $media = $this->upload->data('full_path');
            unlink($media);
        $this->session->set_flashdata('message','Data berhasil diimport');
        redirect(site_url('lkpk/kegiatan/'));
    }
}



/* End of file Nilai_pagu.php */
/* Location: ./application/controllers/Nilai_pagu.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-09-11 09:14:19 */
/* http://harviacode.com */
?>
