<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Schedule extends Model
{
    use HasFactory;

    protected $table = 'tdschedules';
    protected $fillable = ['productionline_id','day','start_time','end_time'];


    public static function getSchedules(){
        $schedules = DB::select('SELECT A.id AS productionline_id,B.id AS schedule_id,A.name AS line,A.name,B.day,B.start_time,B.end_time FROM tcproductionline A LEFT JOIN tdschedules B ON A.id = B.productionline_id');
 
        return $schedules;
    
    }
    public static function getScheduleById($id){
        $schedule = DB::select("SELECT A.id AS productionline_id,B.id AS schedule_id,A.name AS line,A.name,B.day,B.start_time,B.end_time FROM tcproductionline A LEFT JOIN tdschedules B ON A.id = B.productionline_id where A.id = $id");
 
        return $schedule;
    
    }
}
