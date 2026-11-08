<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Entities\Client;
use PDO;

final class ClientRepository implements ClientRepositoryInterface
{
    private const WRITABLE = ['name', 'address', 'email', 'phone', 'born_date'];

    public function __construct(private PDO $pdo)
    {
    }

    public function all(): array
    {
        $rows = $this->pdo
            ->query('SELECT * FROM "clients" ORDER BY "id" DESC')
            ->fetchAll(PDO::FETCH_ASSOC);

        return array_map(
            [Client::class, 'fromArray'],
            $rows
        );
    }

    public function find(int $id): ?Client
    {
        $st = $this->pdo->prepare(
            'SELECT * FROM "clients" WHERE "id" = :id'
        );

        $st->execute(['id' => $id]);
        $row = $st->fetch(PDO::FETCH_ASSOC);

        return $row ? Client::fromArray($row) : null;
    }

    public function create(Client $entity): int
    {
        $sql = '
            INSERT INTO "clients" ("name", "address", "email", "phone", "born_date")
            VALUES (:name, :address, :email, :phone, :born_date)
            RETURNING "id"
        ';

        $st = $this->pdo->prepare($sql);
        $st->execute($this->data($entity));

        return (int) $st->fetchColumn();
    }

    public function update(Client $entity): void
    {
        $sql = '
            UPDATE "clients"
            SET "name" = :name, "address" = :address, "email" = :email, "phone" = :phone, "born_date" = :born_date
            WHERE "id" = :__pk
        ';

        $st = $this->pdo->prepare($sql);

        $st->execute(
            $this->data($entity) + [
                '__pk' => $entity->id
            ]
        );
    }

    public function delete(int $id): void
    {
        $st = $this->pdo->prepare(
            'DELETE FROM "clients" WHERE "id" = :id'
        );

        $st->execute(['id' => $id]);
    }

    private function data(Client $entity): array
    {
        return array_intersect_key(
            $entity->toArray(),
            array_flip(self::WRITABLE)
        );
    }
}
