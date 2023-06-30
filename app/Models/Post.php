<?php

namespace App\Models;

use App\Models\Concerns\Filterable;
use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
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
}
