<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Video extends Model
{
    use HasFactory;

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function getReadableDuration(){
        return \Str::of($this->duration_in_minutes)->append("min");
    }
}
