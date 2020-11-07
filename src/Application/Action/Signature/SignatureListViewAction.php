<?php

namespace App\Application\Action\Signature;

use Psr\Http\Message\ResponseInterface as Response;

final class SignatureListViewAction extends SignatureAction
{
  /**
   * {@inheritdoc}
   */
  protected function action(): Response
  {
    $signatures = $this->signatureRepository->findAll();
    return $this->render('list/signatures.twig', compact('signatures'));
  }
}