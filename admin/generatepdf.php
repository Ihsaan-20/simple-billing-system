<?php

require('../admin/assets/plugins/tcpdf/tcpdf.php');

if (isset($_GET['invoice'])) {
    $invoice_no =$_GET['invoice'];


    
// Create a new TCPDF document
$pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set default header data
$pdf->SetHeaderData('','', PDF_HEADER_TITLE, PDF_HEADER_STRING);

// Set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// Set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// Set margins
$pdf->SetMargins(20, 20, 20);

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// Set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// Set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// Add a page
$pdf->AddPage();

// URL of the web page to convert
$url = 'http://127.0.0.1/usman_trader/admin/view-invoice.php?invoice='. $invoice_no;

// Fetch the HTML content from the URL
$htmlContent = file_get_contents($url);

// Include the HTML content in the PDF
$pdf->writeHTML($htmlContent, true, false, true, false, '');

// Output the PDF as a download
$pdf->Output('invoice-'.$invoice_no.'.pdf', 'D');

}
?>
