<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    public $casts = [
        'learnings' => 'array'
    ];

    public function scopeReleased(Builder $query): Builder
    {
        return $query->whereNotNull('released_at')->orderByDesc('released_at');
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }
}
