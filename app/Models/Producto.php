<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    //otrogar la propiedad filleable que permitimos que seran manipulados
    protected $fillable = [
        'descripcion',
        'cantidad'
    ];
}