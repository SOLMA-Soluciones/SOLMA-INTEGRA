<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Schedule extends Model
{
    use HasFactory;

    protected $table = 'tdschedules';
    protected $fillable = ['productionline_id', 'day', 'start_time', 'end_time'];


    public static function getSchedules()
    {
        $schedules = DB::select('SELECT A.id AS productionline_id,B.id AS schedule_id,A.name AS line,A.name,GROUP_CONCAT(B.day ORDER BY B.day) AS day,B.start_time,B.end_time,B.turn FROM tcproductionline A inner JOIN tdschedules B ON A.id = B.productionline_id GROUP BY A.id,B.turn');

        return $schedules;
    }
    public static function getScheduleById($id, $turn)
    {
        $schedule = DB::select("SELECT A.id AS productionline_id,B.id AS schedule_id,A.name AS line,A.name,B.day,B.start_time,B.end_time,B.turn,B.fulltime FROM tcproductionline A LEFT JOIN tdschedules B ON A.id = B.productionline_id where A.id = $id AND B.turn = $turn");

        return $schedule;
    }

    public static function deleteScheduleById($id, $turn)
    {
        try {
            DB::select("DELETE FROM tdschedules where productionline_id = $id AND turn = $turn");
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    public static function guardarDatos($oDatos)
    {
        try {
            $fulltime=0;
            $days = $oDatos->days;
            $id = (int)$oDatos->productionline_id;
            $turn  = (int)$oDatos->turn;
            if($oDatos->fulltime){
                $oDatos->start_time = "00:00:00";
                $oDatos->end_time = "24:00:00";
                $fulltime = 1;
            }
            foreach ($days as $key => $day) {
                $ids = DB::select("SELECT id FROM tdschedules WHERE productionline_id = $id and day = $day and turn = $turn");
                if (count($ids) > 0) {
                    $ids = $ids[0];
                    $schedule_id = $ids->id;
                    DB::update('UPDATE tdschedules SET day=?,start_time = ?, end_time=?,fulltime=? WHERE id = ?', [$day, $oDatos->start_time, $oDatos->end_time,$fulltime, $schedule_id]);
                } else {
                    DB::insert('insert into tdschedules (productionline_id, day,start_time,end_time,turn,fulltime) values (?, ?,?,?,?,?)', [$id, $day, $oDatos->start_time, $oDatos->end_time, $turn,$fulltime]);
                }
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    public static function insertarDatos($oDatos)
    {
        try {
            $fulltime=0;
            $days = $oDatos->days;
            $id = (int)$oDatos->productionline_id;
            $turns = DB::select("SELECT max(turn) as max_turn FROM tdschedules WHERE productionline_id = $id");
            if (count($turns) > 0) {
                $turns = $turns[0];
                $turn = $turns->max_turn;
                $turn = $turn + 1;
            } else {
                $turn = 1;
            }
            if($oDatos->fulltime){
                $oDatos->start_time = "00:00:00";
                $oDatos->end_time = "24:00:00";
                $fulltime = 1;
            }
            foreach ($days as $key => $day) {
                DB::insert('insert into tdschedules (productionline_id, day,start_time,end_time,turn,fulltime) values (?, ?,?,?,?,?)', [$id, $day, $oDatos->start_time, $oDatos->end_time, $turn,$fulltime]);
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
