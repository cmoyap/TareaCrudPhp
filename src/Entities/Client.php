<?php
declare(strict_types=1);

namespace App\Entities;

/** Una fila de la tabla clients. */
final class Client
{
    public function __construct(
        public ?int $id = null,
        public string $name = '',
        public ?string $address = null,
        public string $email = '',
        public ?string $phone = null,
        public ?string $born_date = null,
        public string $created_at = '',
    ) {
    }

    public static function fromArray(array $d): self
    {
        return new self(
            id: (isset($d['id']) && $d['id'] !== '' ? (int) $d['id'] : null),
            name: (string) ($d['name'] ?? ''),
            address: (isset($d['address']) && $d['address'] !== '' ? (string) $d['address'] : null),
            email: (string) ($d['email'] ?? ''),
            phone: (isset($d['phone']) && $d['phone'] !== '' ? (string) $d['phone'] : null),
            born_date: (isset($d['born_date']) && $d['born_date'] !== '' ? (string) $d['born_date'] : null),
            created_at: (string) ($d['created_at'] ?? ''),
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
            'email' => $this->email,
            'phone' => $this->phone,
            'born_date' => $this->born_date,
            'created_at' => $this->created_at,
        ];
    }
}
