<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'producto';
    protected $fillable = ['mes','empleado','vendedor','categoria_id','producto','cantidad','precio','cliente'];

 public function categoria()
{
    return $this->belongsTo(Categoria::class, 'categoria_id');
}
}
