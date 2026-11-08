<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Entities\Client;

interface ClientRepositoryInterface
{
    /** @return Client[] */
    public function all(): array;

    public function find(int $id): ?Client;

    public function create(Client $entity): int;

    public function update(Client $entity): void;

    public function delete(int $id): void;
}
