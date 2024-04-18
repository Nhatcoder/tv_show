<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'category';
    protected $primaryKey = 'id_category';

    public function movie()
    {
        return $this->hasMany(Movie::class, 'id_category')->orderBy('id', 'DESC');
    }

    // public function movie_page()
    // {
    //     return $this->hasMany(Movie::class, 'id_category')->orderBy('id', 'DESC')->paginate(18);
    // }
}
