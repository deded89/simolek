<?php
 
class Pdfgenerator
{
   
  public function generate($html,$filename,$psize,$orient)
  {
    define('DOMPDF_ENABLE_AUTOLOAD', false);
    require_once("./vendor/dompdf/dompdf/dompdf_config.inc.php");
 
    $dompdf = new DOMPDF();
	$dompdf->set_paper($psize,$orient);
    $dompdf->load_html($html);
    $dompdf->render();
    $dompdf->stream($filename.'.pdf',array("Attachment"=>0));
	//file_put_contents($filename.'.pdf', $dompdf->output());
	
  }
}