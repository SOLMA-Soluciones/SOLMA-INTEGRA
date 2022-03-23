<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
    protected $fillable = ['numero','costo','max_hora','unidad','linea_id'];



 public function linea()
{
    return $this->belongsTo(Linea::class, 'linea_id');
}

 
}
