<?php

declare(strict_types=1);

namespace App\Letterhead\Layout;

interface LayoutRepository
{
  /**
   * @return Layout[]
   */
  public function findAll(): array;

  /**
   * @param int $id
   * @return Layout
   * @throws LayoutNotFoundException
   */
  public function findOne(int $id): ?Layout;

  public function create(Layout $layout): bool;
  public function read(int $id): ?Layout;
  public function update(Layout $layout): bool;
  public function delete(int $id): bool;
  
  public function set(Layout $layout): bool;
}
