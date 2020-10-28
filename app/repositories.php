<?php

use App\Infrastructure\Persistence\Pdo\PdoDocumentRepository;
use App\Infrastructure\Persistence\Pdo\PdoDocumentSignatureRepository;
use App\Infrastructure\Persistence\Pdo\PdoLayoutRepository;
use App\Infrastructure\Persistence\Pdo\PdoSignatureRepository;
use App\Letterhead\Document\DocumentRepository;
use App\Letterhead\DocumentSignature\DocumentSignatureRepository;
use App\Letterhead\Layout\LayoutRepository;
use App\Letterhead\Signature\SignatureRepository;
use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
  $containerBuilder->addDefinitions([
    LayoutRepository::class             => \DI\autowire(PdoLayoutRepository::class),
    DocumentRepository::class           => \DI\autowire(PdoDocumentRepository::class),
    SignatureRepository::class          => \DI\autowire(PdoSignatureRepository::class),
    DocumentSignatureRepository::class  => \DI\autowire(PdoDocumentSignatureRepository::class),
  ]);
};