<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengendalian extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('pengadaan/Pengendalian_model');
    $this->load->model('pengadaan/Pekerjaan_model');
    if (!$this->ion_auth->logged_in())
    {
      redirect('auth/login', 'refresh');
    } else if ($this->ion_auth->in_group('user_biasa')) {
      return show_error('You must be an pengelola to view this page.');
    }
  }

  function index()
  {
    $data_jenis = $this->Pengendalian_model->count_pekerjaan_jenis();
    $data_metode = $this->Pengendalian_model->count_pekerjaan_metode();
    $data_pekerjaan_skpd =  $this->Pengendalian_model->count_pekerjaan_skpd();
    $pagu_bl = 1094077580263;
    $pagu_pekerjaan = $this->Pengendalian_model->total_pagu_pekerjaan();
    $persen_pagu_pekerjaan = $pagu_pekerjaan / $pagu_bl *100;
    $data = array(
      'total_pekerjaan' => $this->Pengendalian_model->total_pekerjaan(),
      'count_jenis' => $data_jenis,
      'count_metode' => $data_metode,
      'count_skpd' => $data_pekerjaan_skpd,
      'ck200' => $this->Pengendalian_model->count_k200(),
      'c200' => $this->Pengendalian_model->count_200(),
      'c25' => $this->Pengendalian_model->count_25(),
      'c50' => $this->Pengendalian_model->count_50(),
      'tahapan_200' => $this->Pengendalian_model->count_200_tahapan(),
      'tahapan_25' => $this->Pengendalian_model->count_25_tahapan(),
      'tahapan_50' => $this->Pengendalian_model->count_50_tahapan(),
      'pagu_bl' => $pagu_bl,
      'pagu_pekerjaan' => $pagu_pekerjaan,
      'persen_pagu_pekerjaan' => $persen_pagu_pekerjaan,
      'controller' => 'Pengendalian',
      'uri1' => 'Dashboard',
      'main_view' => 'pengadaan/pengendalian/dashboard'
    );
    $this->load->view('template_view', $data);
  }

  function filter_skpd($filter){
    $pekerjaan = $this->Pekerjaan_model->filter_skpd($filter);
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

  function filter_pagu($filter1,$filter2){
    $pekerjaan = $this->Pekerjaan_model->filter_pagu($filter1,$filter2);
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

  function filter_jenis_metode($filter1,$filter2){
    $pekerjaan = $this->Pekerjaan_model->filter_jenis_metode($filter1,$filter2);
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

  function filter_pagu_progress($filter1,$filter2,$filter3){
    $pekerjaan = $this->Pekerjaan_model->filter_pagu_progress($filter1,$filter2,$filter3);
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
}
