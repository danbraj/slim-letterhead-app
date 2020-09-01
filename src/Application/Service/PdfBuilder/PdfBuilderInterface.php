<?php

namespace App\Application\Service\PdfBuilder;

interface PdfBuilderInterface
{
  public function writeHtmlDocument(string $html);
  public function generateDocument();
}