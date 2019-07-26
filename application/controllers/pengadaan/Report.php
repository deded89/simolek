<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('pengadaan/Report_model');
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
      'pagu' => set_value('pagu'),
    );
    $this->load->view('template_view', $data);
  }

}
