<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'tcproducts';
    protected $fillable = ['part_number','description','cost','cycle','unit','productionline_id'];
 

 public function line()
{
    return $this->belongsTo(Line::class, 'productionline_id');
}

 
}
