<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productionstop extends Model
{
    protected $table = 'tcproductionstoppages';
    protected $fillable = ['id','name','status'];

}
