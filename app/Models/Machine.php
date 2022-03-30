<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    protected $table = 'tcmachines';
    protected $fillable = ['name','description'];
 

}
