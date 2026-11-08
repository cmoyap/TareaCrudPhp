<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Entities\Client;
use App\Repositories\ClientRepository;
use App\Services\ClientService;
use PDOException;

final class ClientsController extends Controller
{
    private ClientService $service;

    public function __construct(?ClientService $service = null)
    {
        parent::__construct();

        $this->service = $service
            ?? new ClientService(
                new ClientRepository(Database::connection())
            );
    }

    public function index(): void
    {
        $this->render(
            'clients/index',
            ['items' => $this->service->list()],
            'Clients'
        );
    }

    public function create(): void
    {
        $this->form(new Client(), [], 'clients/store', 'Nuevo Client');
    }

    public function store(): void
    {
        $this->requirePost();

        $entity = Client::fromArray($this->request->allPost());
        $errors = $this->service->validate($entity);

        if ($errors) {
            $this->form($entity, $errors, 'clients/store', 'Nuevo Client');
            return;
        }

        $this->service->create($entity);

        $this->redirect('clients', 'Registro creado correctamente.');
    }

    public function edit(?int $id = null): void
    {
        $entity = $this->service->get((int) $id);

        $this->form(
            $entity,
            [],
            'clients/update/' . $entity->id,
            'Editar Client'
        );
    }

    public function update(?int $id = null): void
    {
        $this->requirePost();

        $this->service->get((int) $id);

        $entity = Client::fromArray($this->request->allPost());
        $entity->id = (int) $id;

        $errors = $this->service->validate($entity);

        if ($errors) {
            $this->form(
                $entity,
                $errors,
                'clients/update/' . $id,
                'Editar Client'
            );
            return;
        }

        $this->service->update($entity);

        $this->redirect('clients', 'Registro actualizado correctamente.');
    }

    public function delete(?int $id = null): void
    {
        $this->requirePost();

        $this->service->get((int) $id);

        try {
            $this->service->delete((int) $id);
        } catch (PDOException) {
            $this->redirect(
                'clients',
                'No se pudo eliminar: el registro esta en uso.',
                'error'
            );
        }

        $this->redirect('clients', 'Registro eliminado.');
    }

    private function form(
        Client $entity,
        array $errors,
        string $action,
        string $title
    ): void {
        $this->render(
            'clients/form',
            compact('entity', 'errors', 'action'),
            $title
        );
    }
}
