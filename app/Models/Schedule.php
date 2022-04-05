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
        $schedules = DB::select('SELECT A.id AS productionline_id,B.id AS schedule_id,A.name AS line,A.name,GROUP_CONCAT(B.day ORDER BY B.day) AS day,B.start_time,B.end_time,B.turn FROM tcproductionline A LEFT JOIN tdschedules B ON A.id = B.productionline_id GROUP BY A.id');
 
        return $schedules;
    
    }
    public static function getScheduleById($id){
        $schedule = DB::select("SELECT A.id AS productionline_id,B.id AS schedule_id,A.name AS line,A.name,B.day,B.start_time,B.end_time,B.turn FROM tcproductionline A LEFT JOIN tdschedules B ON A.id = B.productionline_id where A.id = $id");
 
        return $schedule;
    
    }
    public static function guardarDatos($oDatos){
        
        // $id = null;
        $days = $oDatos->days;
        $id = (int)$oDatos->id;
        foreach ($days as $key => $day) {
            $ids = DB::select("SELECT id FROM tdschedules WHERE productionline_id = $id and day = $day");
            if(count($ids)>0){
                $ids = $ids[0];
                $id_schedule = $ids->id;
                DB::update('UPDATE tdschedules SET day=?,start_time = ?, end_time=? WHERE id = ?', [$day,$oDatos->start_time,$oDatos->end_time,$id_schedule]);
            }else{
                DB::insert('insert into tdschedules (productionline_id, day,start_time,end_time) values (?, ?,?,?)', [$id,$day,$oDatos->start_time,$oDatos->end_time]);
            }
        }
         return null;
    }
}
