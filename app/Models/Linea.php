<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Linea extends Model
{
    protected $table = 'lineas';
    protected $fillable = ['nombre'];

    public function producto() {
        
        return $this->hasOne(Producto::class, 'linea_id');
      }



  
}
