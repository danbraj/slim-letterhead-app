<?php

declare(strict_types=1);

namespace App\Letterhead\Signature;

interface SignatureRepository
{
  /**
   * @return Signature[]
   */
  public function findAll(): array;

  /**
   * @param int $id
   * @return Signature
   * @throws SignatureNotFoundException
   */
  public function findOne(int $id): Signature;

  public function create(Signature $signature): bool;
  public function read(int $id): Signature;
  public function update(Signature $signature): bool;
  public function delete(int $id): bool;
  
  public function set(Signature $signature): bool;
}
