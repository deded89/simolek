<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Tesview extends CI_Controller
{
    public function index()
    {


			$data = array(
        'controller' => 'view',
        'uri1' => 'tes',
        'main_view' => 'testview'
      );


        $this->load->view('testview',$data);
    }
}

 ?>
