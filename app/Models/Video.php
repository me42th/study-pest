<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    public function getReadableDuration(){
        return \Str::of($this->duration_in_minutes)->append("min");
    }
}
