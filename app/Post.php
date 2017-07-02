<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public static function create(array $attributes = [])
    {
        $attributes['title']        = "Test Title";
        $attributes['description']  = "Test Description";

        return static::query()->create($attributes);
    }
}
