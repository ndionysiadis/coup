<?php

namespace App\Data;

use App\Models\User;
use Spatie\LaravelData\Data;

/** @typescript */
class UserData extends Data
{
    public function __construct(
        public int    $id,
        public string $name,
        public string $email,
    )
    {
    }

    public function fromModel(User $user): self
    {
        return new self(
            id: $user->id,
            name: $user->name,
            email: $user->email,
        );
    }
}
