<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_pekerjaan extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('pengadaan/User_pekerjaan_model');
    if (!$this->ion_auth->logged_in())
    {
      redirect('auth/login', 'refresh');
    }else if (!$this->ion_auth->in_group('admin')) {
      return show_error('You must be an admin to view this page.');
    }
  }

  function list_user_pekerjaan($id_p=null)
  {
    $user_pekerjaan = $this->User_pekerjaan_model->get_user_pekerjaan();
    $data = array(
      'user_pekerjaan_data' => $user_pekerjaan,
      'controller' => 'Set User Pekerjaan',
      'uri1' => 'List Pekerjaan per User',
      'main_view' => 'pengadaan/pekerjaan/user_pekerjaan_list',
      'form_action' => site_url('pengadaan/user_pekerjaan/set_user'),
      'id_p' => set_value('id_p'),
    );
    if ($id_p){
      $data['id_p'] = set_value('id_p',$id_p);
    }
    $this->load->view('template_view', $data);
  }

  function set_user(){
    $this->User_pekerjaan_model->update_user_pekerjaan();
    redirect(site_url('pengadaan/user_pekerjaan/list_user_pekerjaan'));
  }

  function unset_user($id_p){
    $this->User_pekerjaan_model->remove_user_pekerjaan($id_p);
    redirect(site_url('pengadaan/user_pekerjaan/list_user_pekerjaan'));
  }

}
