<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $primaryKey = 'id';
    public $table = "episode";

    public function movie()
    {
        return $this->belongsTo(Movie::class, 'id_movie');
    }
}
