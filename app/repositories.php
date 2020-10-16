<?php

use App\Infrastructure\Persistence\Pdo\PdoDocumentRepository;
use App\Infrastructure\Persistence\Pdo\PdoLayoutRepository;
use App\Infrastructure\Persistence\Pdo\PdoSignatureRepository;
use App\Letterhead\Document\DocumentRepository;
use App\Letterhead\Layout\LayoutRepository;
use App\Letterhead\Signature\SignatureRepository;
use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
  $containerBuilder->addDefinitions([
    DocumentRepository::class   => \DI\autowire(PdoDocumentRepository::class),
    SignatureRepository::class  => \DI\autowire(PdoSignatureRepository::class),
    LayoutRepository::class     => \DI\autowire(PdoLayoutRepository::class),
  ]);
};