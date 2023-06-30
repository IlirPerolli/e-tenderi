<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait Sluggable
{
    protected static string $generateSlugFromField = 'name';

    public static function bootSluggable(): void
    {
        static::creating(function (Model $model) {
            $model->generateAndSetSlug();
        });

        static::updating(function (Model $model) {
            $model->generateAndSetSlug();
        });
    }

    private function generateAndSetSlug(): void
    {
        $slug = Str::slug($this->{self::$generateSlugFromField});
        $key = 1;

        while (self::query()->where('slug', $slug)->where('id', '<>', $this->id)->exists()) {
            $slug = Str::slug($this->{self::$generateSlugFromField}).'-'.$key;
            $key++;
        }

        $this->slug = $slug;
    }
}
