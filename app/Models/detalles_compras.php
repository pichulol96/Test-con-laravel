<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detalles_compras extends Model
{
    use HasFactory;
     protected $fillable = [
        'id_folio_compras',
        'id_de_articulos',
        'cantidad',
        
        
    ];
}
