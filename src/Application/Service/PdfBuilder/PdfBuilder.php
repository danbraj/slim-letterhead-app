<?php

namespace App\Application\Service\PdfBuilder;

use Mpdf\Mpdf;

class PdfBuilder extends Mpdf implements PdfBuilderInterface
{
  public function __construct($settings)
  {
    parent::__construct($settings);
  }

  public function writeHtmlDocument(PdfContent $pdfContent)
  {
    $html = $pdfContent->generateHtml();
    // echo $html;
    // die;
    $this->WriteHTML($html);
  }

  public function generateDocument()
  {
    // https://mpdf.github.io/reference/mpdf-functions/output.html
    // $this->Output('document.pdf', 'D');
    $this->Output();
  }
  
  public function provide(): PdfBuilderInterface
  {
    return $this;
  }
}