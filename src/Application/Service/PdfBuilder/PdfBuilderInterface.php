<?php

namespace App\Application\Service\PdfBuilder;

interface PdfBuilderInterface
{
  public function fillDocument(PdfContentInterface $pci);
  public function generateDocument();
}