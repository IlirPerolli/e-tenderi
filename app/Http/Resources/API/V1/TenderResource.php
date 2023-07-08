<?php

namespace App\Http\Resources\API\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class TenderResource extends JsonResource
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
            'description',
            'image_path',
            'deadline',
            'url',
            'price',
            'props',
            'created_at',
            'updated_at',
        ])
            ->data;
    }
}
