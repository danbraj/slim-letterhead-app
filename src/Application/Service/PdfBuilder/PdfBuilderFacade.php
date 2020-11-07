<?php

namespace App\Application\Service\PdfBuilder;

use Mpdf\Mpdf;

class PdfBuilderFacade implements PdfBuilderInterface
{
  private $pdfGenerator;

  public function __construct()
  {
    $this->pdfGenerator = new Mpdf();
    // $this->pdfGenerator = $pdfGenerator;
    // $this->pdfGenerator->SetBasePath(BASE_URL);
  }

  public function fillDocument(PdfContentInterface $pdfContentInterface)
  {
    $html = $pdfContentInterface->generateHtml();
    echo $html;
    die;
    $this->pdfGenerator->WriteHTML($html);
  }

  public function generateDocument()
  {
    // https://mpdf.github.io/reference/mpdf-functions/output.html
    // $this->Output('document.pdf', 'D');
    $this->pdfGenerator->Output();
  }
  
  public function provide(): PdfBuilderInterface
  {
    return $this;
  }
}