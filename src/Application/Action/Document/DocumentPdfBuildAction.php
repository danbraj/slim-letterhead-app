<?php

namespace App\Application\Action\Document;

use App\Application\Service\PdfBuilder\PdfBuilderInterface;
use App\Application\Service\PdfBuilder\PdfContent;
use App\Letterhead\Document\DocumentRepository;
use App\Letterhead\DocumentSignature\DocumentSignatureRepository;
use App\Letterhead\Layout\LayoutRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use Slim\Views\Twig;

final class DocumentPdfBuildAction extends DocumentAction
{
  private $documentSignatureRepository;
  private $layoutRepository;
  private $pdfBuilder;

  public function __construct(
    LoggerInterface $logger,
    Twig $view,
    DocumentRepository $documentRepository,
    DocumentSignatureRepository $documentSignatureRepository,
    LayoutRepository $layoutRepository,
    PdfBuilderInterface $pdfBuilder
  ) {
    parent::__construct($logger, $view, $documentRepository);
    $this->documentSignatureRepository = $documentSignatureRepository;
    $this->layoutRepository = $layoutRepository;
    $this->pdfBuilder = $pdfBuilder;
  }

  /**
   * {@inheritdoc}
   */
  protected function action(): Response
  {
    $id = intval($this->resolveArg('id'));
    // if ($id == 0) return $this->redirect('document');

    $document = $this->documentRepository->read($id);
    $layout = $this->layoutRepository->read($document->layoutId);
    $signatures = $this->documentSignatureRepository->findSignatures($document->id);
 
    $this->pdfBuilder->fillDocument(
      new PdfContent(
        $layout->template,
        $layout->styles,
        $document->header,
        $document->header,
        $document->content,
        $signatures
      )
    );
    $this->pdfBuilder->generateDocument();
    return $this->redirect('document');
  }
}
