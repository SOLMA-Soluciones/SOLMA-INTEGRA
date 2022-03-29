<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Line extends Model
{
    protected $table = 'tcproductionline';
    protected $fillable = ['name'];

    public function product() {
        
        return $this->hasOne(Product::class, 'productionline_id');
      }



  
}
