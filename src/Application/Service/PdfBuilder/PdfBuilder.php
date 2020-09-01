<?php

namespace App\Application\Service\PdfBuilder;

use Mpdf\Mpdf;

class PdfBuilder extends Mpdf implements PdfBuilderInterface
{
  public function __construct($settings)
  {
    parent::__construct($settings);
  }

  public function writeHtmlDocument($html)
  {
    $this->WriteHTML($html);
  }

  public function generateDocument()
  {
    // https://mpdf.github.io/reference/mpdf-functions/output.html
    $this->Output('test.pdf', 'D');
  }
  
  public function provide(): PdfBuilderInterface
  {
    return $this;
  }
}