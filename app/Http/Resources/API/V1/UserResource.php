<?php

namespace App\Http\Resources\API\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            ...$this->basicData(),
        ];
    }

    protected function basicData(): array
    {
        return $this->attributes([
            'slug',
            'name',
            'email',
            'email_verified_at',
            'role',
            'created_at',
            'updated_at',
        ])
            ->data;
    }
}
