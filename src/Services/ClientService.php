<?php
declare(strict_types=1);

namespace App\Services;

use App\Core\NotFoundException;
use App\Entities\Client;
use App\Repositories\ClientRepositoryInterface;

final class ClientService
{
    public function __construct(
        private ClientRepositoryInterface $repository
    ) {
    }

    public function list(): array
    {
        return $this->repository->all();
    }

    public function get(int $id): Client
    {
        return $this->repository->find($id)
            ?? throw new NotFoundException();
    }

    public function validate(Client $e): array
    {
        $errors = [];

        if (trim((string) $e->name) === '') {
            $errors['name'] = 'Name es obligatorio.';
        }
        if (mb_strlen((string) $e->name) > 120) {
            $errors['name'] = 'Name admite maximo 120 caracteres.';
        }
        if (mb_strlen((string) $e->address) > 255) {
            $errors['address'] = 'Address admite maximo 255 caracteres.';
        }
        if (trim((string) $e->email) === '') {
            $errors['email'] = 'Email es obligatorio.';
        }
        if (mb_strlen((string) $e->email) > 120) {
            $errors['email'] = 'Email admite maximo 120 caracteres.';
        }
        if ((string) $e->email !== '' && !filter_var($e->email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email no es un correo valido.';
        }
        if (mb_strlen((string) $e->phone) > 20) {
            $errors['phone'] = 'Phone admite maximo 20 caracteres.';
        }

        return $errors;
    }

    public function create(Client $e): int
    {
        return $this->repository->create($e);
    }

    public function update(Client $e): void
    {
        $this->repository->update($e);
    }

    public function delete(int $id): void
    {
        $this->repository->delete($id);
    }
}
