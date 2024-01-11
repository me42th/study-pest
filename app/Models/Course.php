<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{
    Factories\HasFactory,
    Model,
    Builder
};


class Course extends Model
{
    use HasFactory;

    public function scopeReleased(Builder $query): Builder{
        return $query->whereNotNull('released_at')->orderByDesc('released_at');
    }
}
