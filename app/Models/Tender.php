<?php

namespace App\Models;

use App\Models\Concerns\Filterable;
use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tender extends Model
{
    use HasFactory, Sluggable, Filterable;

    protected $casts = [
        'props' => 'json',
    ];

    protected $guarded = [];

    protected static string $generateSlugFromField = 'name';

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
