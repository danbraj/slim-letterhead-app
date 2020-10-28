<?php

namespace App\Application\Service\PdfBuilder;

interface PdfBuilderInterface
{
  public function writeHtmlDocument(PdfContent $pdfContent);
  public function generateDocument();
}