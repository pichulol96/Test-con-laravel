<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class zona extends Model
{
    use HasFactory;
     protected $fillable = [
        'nombre_zona',
        
    ];
}
