<?php
  $pagina = file_get_contents($_GET['pagina']);
  define('MPDF_PATH', 'mpdf/');
  include(MPDF_PATH.'mpdf.php');
  $mpdf=new mPDF();
  $mpdf->WriteHTML($pagina);
  $mpdf->Output();
  exit();
?>  