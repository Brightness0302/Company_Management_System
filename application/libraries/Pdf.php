<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(dirname(__FILE__) . '/dompdf/autoload.inc.php');

class Pdf
{
    function createPDF($html, $filename='', $download=TRUE, $paper='A4', $orientation='portrait'){
        $dompdf = new Dompdf\Dompdf(['isRemoteEnabled' => true]);
        $dompdf->load_html($html);
        $dompdf->set_paper($paper, $orientation);
        $dompdf->render();
        
        $f;
		$l;
		if(headers_sent($f,$l))
		{
		    echo $f,'<br/>',$l,'<br/>';
		    die('now detect line');
		}

        $dompdf->stream($filename, array('Attachment' => 0));
        exit();
        return true;
    }
};
?>
